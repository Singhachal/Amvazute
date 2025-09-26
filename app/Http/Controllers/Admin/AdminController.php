<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Admin;


class AdminController extends Controller
{
    public function login(Request $request)
{
    if ($request->isMethod('post')) {
        $data = $request->all();

        $rules = [
            'email' => 'required|email',
            'password' => 'required',
        ];

        $customMessages = [
            'email.required' => 'Email is required',
            'email.email' => 'Valid Email is required',
            'password.required' => 'Password is required',
        ];

        $this->validate($request, $rules, $customMessages);

        $remember = !empty($data['remember']);

        if (Auth::guard('admin')->attempt([
            'email' => $data['email'],
            'password' => $data['password']
        ], $remember)) {
            return redirect('admin/dashboard');
        } else {
            return redirect()->back()->with('error_message', 'Invalid email or password. Please try again.');
        }
    }

    return view('admin.login');
}


    public function index()
    {
        return view('admin.dashboard');
    }


    public function logout()
    {
        Auth::guard('admin')->logout();
        Session::flush();
        return redirect('admin/login')->with('success_message', 'You have been logged out successfully.');
    }


    public function showForgotForm()
{
    return view('admin.auth.forgot');
}

public function submitForgotForm(Request $request)
{
    $request->validate([
        'email' => 'required|email|exists:admin,email',
    ]);

    $token = Str::random(64);

    DB::table('password_resets')->updateOrInsert(
        ['email' => $request->email],
        ['token' => $token, 'created_at' => now()]
    );

    $resetLink = route('admin.reset.password', $token);

    Mail::raw("Reset your password: $resetLink", function ($message) use ($request) {
        $message->to($request->email)
            ->subject('Admin Password Reset Link');
    });

    return back()->with('success', 'Password reset link sent to your email.');
}

public function showResetForm($token)
{
    return view('admin.auth.reset', compact('token'));
}

public function submitResetForm(Request $request)
{
    $request->validate([
        'email' => 'required|email|exists:admin,email',
        'password' => 'required|confirmed|min:6',
        'token' => 'required',
    ]);

    $check = DB::table('password_resets')->where([
        'email' => $request->email,
        'token' => $request->token,
    ])->first();

    if (!$check) {
        return back()->withErrors(['email' => 'Invalid or expired token.']);
    }

    Admin::where('email', $request->email)->update([
        'password' => Hash::make($request->password)
    ]);

    DB::table('password_resets')->where(['email' => $request->email])->delete();

    return redirect()->route('admin.login')->with('success', 'Your password has been reset.');
}

// public  function profile()
// {
//     return view('admin.profile.profile');
// }

public function profile()
{
    $admin = auth('admin')->user(); // or Auth::guard('admin')->user();
    return view('admin.profile.profile', compact('admin'));
}


public function changePassword(Request $request)
{
    $request->validate([
        'current_password' => 'required',
        'new_password' => 'required|min:6|confirmed',
    ]);

    $admin = Auth::guard('admin')->user();

    if (!Hash::check($request->current_password, $admin->password)) {
        return back()->withErrors(['current_password' => 'Current password is incorrect.']);
    }

    $admin->password = Hash::make($request->new_password);
    $admin->save();

    return back()->with('success', 'Password updated successfully.');
}

public function editProfile()
{
    $admin = auth('admin')->user();
    return view('admin.profile.edit', compact('admin'));
}

public function updateProfile(Request $request)
{
    $admin = auth('admin')->user();

    $request->validate([
        'name' => 'required|string|max:255',
        'number' => 'nullable|string',
        'profile_picture' => 'nullable|image',
        'bio' => 'nullable|string',
    ]);

    $admin->name = $request->name;
    $admin->number = $request->number;
    $admin->bio = $request->bio;
    $admin->post_gallery = $request->post_gallery;

    if ($request->hasFile('profile_picture')) {
        $file = $request->file('profile_picture');
        $filename = time() . '.' . $file->getClientOriginalExtension();

        $file->move(public_path('admin/uploads'), $filename);

        $admin->profile_picture = $filename;
    }

    $admin->save();

    return redirect()->route('admin.profile.edit')->with('success', 'Profile updated!');
}

// public function UserManagement()
// {

//     return view('admin.userManagement.user-management');
// }

// public function UserManagement()
// {
//     $admins = Admin::orderBy('id', 'desc')->get(); // or use 'created_at'

//     return view('admin.userManagement.user-management', compact('admins'));
// }

public function userManagement()
{
    $query = Admin::query();

    if (request('role')) {
        $query->where('role', request('role'));
    }

    if (request('name')) {
        $query->where('name', 'LIKE', '%' . request('name') . '%');
    }

    if (request('email')) {
        $query->where('email', 'LIKE', '%' . request('email') . '%');
    }

    if (request('number')) {
        $query->where('number', 'LIKE', '%' . request('number') . '%'); // Make sure 'number' column exists
    }

    $admins = $query->orderByDesc('id')->get();

    return view('admin.userManagement.user-management', compact('admins'));
}



public function toggleStatus($id)
{
    $admin = Admin::findOrFail($id);

    $admin->status = $admin->status === 'active' ? 'inactive' : 'active';
    $admin->save();

    return redirect()->back()->with('success', 'Status updated successfully.');
}



public function edit($id)
{
    $admin = Admin::findOrFail($id);
    return view('admin.userManagement.edit', compact('admin'));
}

public function update(Request $request, $id)
{
    $admin = Admin::findOrFail($id);

    $validated = $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:admin,email,' . $id,
        'password' => 'nullable|min:6',
        'status' => 'required|in:active,inactive',
        'number' => 'nullable',
        'bio' => 'nullable',
        'role' => 'required|in:admin,user',
        'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    if ($request->hasFile('profile_picture')) {
        $filename = time() . '.' . $request->profile_picture->extension();
        $request->profile_picture->move(public_path('admin/uploads'), $filename);
        $validated['profile_picture'] = $filename;
    } else {
        $validated['profile_picture'] = $admin->profile_picture;
    }

    if ($request->filled('password')) {
        $validated['password'] = bcrypt($request->password);
    } else {
        unset($validated['password']);
    }

    $admin->update($validated);

    return redirect()->route('admin.user.edit', $admin->id)->with('success', 'User updated successfully.');
}


public function destroy($id)
{
    $admin = Admin::findOrFail($id);

    // Optional: Delete profile picture from public folder
    if ($admin->profile_picture && file_exists(public_path('admin/uploads/' . $admin->profile_picture))) {
        unlink(public_path('admin/uploads/' . $admin->profile_picture));
    }

    $admin->delete();

    return redirect()->back()->with('success', 'User deleted successfully.');
}


public function create()
{
    return view('admin.userManagement.create');
}


public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:admin,email',
        'password' => 'required|min:6',
        'status' => 'required|in:active,inactive',
        'number' => 'nullable',
        'role' => 'required|in:admin,user',
        'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'bio' => 'nullable|string'
    ]);

    $data = $request->all();
    $data['password'] = bcrypt($data['password']);

    if ($request->hasFile('profile_picture')) {
        $image = $request->file('profile_picture');
        $name = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('admin/uploads'), $name);
        $data['profile_picture'] = $name;
    }

    Admin::create($data);

    return redirect('admin/user-management')->with('success', 'User created successfully.');
}




}
