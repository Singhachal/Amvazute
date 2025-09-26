<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{

public function comment()
{
    $comments = Comment::orderBy('created_at', 'desc') // latest first
                       ->get();

    return view('admin.comment.comment', compact('comments'));
}

public function toggleStatus($id)
{
    $comment = Comment::findOrFail($id);
    $comment->status = $comment->status == 1 ? 0 : 1;
    $comment->save();

    return redirect()->back()->with('success', 'Comment status updated successfully.');
}


}
