<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;
use App\Models\Enquiry;
use App\Models\Blog;
use Stichoza\GoogleTranslate\GoogleTranslate;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{

    public function index(Request $request)
    {
        $events = Event::orderBy('created_at', 'desc')->withCount('comments')->get();
        $locale = session('locale', 'en');

        $userLat = $request->input('latitude', null);
        $userLng = $request->input('longitude', null);


        foreach ($events as $event) {
            if ($locale != 'en') {
                $tr = new GoogleTranslate($locale);
                $event->title = $tr->translate($event->title);
                $event->description = $tr->translate($event->description);
            }
        }

        // Calculate distance via Google Maps API
        if ($userLat && $userLng) {

            // Prepare destinations for Distance Matrix API
            $destinations = $events->map(function ($e) {
                return $e->latitude . ',' . $e->longitude;
            })->implode('|');

            $apiKey = env('GOOGLE_MAPS_KEY');

            $url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins={$userLat},{$userLng}&destinations={$destinations}&mode=driving&key={$apiKey}";

            $response = Http::get($url)->json();
            // dd($response);

            // Check API response
            if (isset($response['rows'][0]['elements'])) {
                foreach ($events as $index => $event) {
                    $element = $response['rows'][0]['elements'][$index];

                    if (isset($element['status']) && $element['status'] == 'OK') {
                        $event->distance_text = $element['distance']['text'];
                        $event->distance_value = $element['distance']['value'];
                    } else {
                        $event->distance_text = 'N/A';
                        $event->distance_value = null;
                    }
                }
            }
        } else {
            foreach ($events as $event) {
                $event->distance_text = 'N/A';
            }
        }

        $blogs = Blog::with('blogCategories')
            ->where('blog_status', 1)
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();

        return view('front.home.index', compact('events', 'blogs'));
    }


    public function homeDistance(Request $request)
    {
        $userLat = $request->lat;
        $userLng = $request->lng;

        $apiKey = env('GOOGLE_MAPS_KEY');

        $events = Event::select('id', 'latitude', 'longitude')->get();

        $result = [];

        foreach ($events as $event) {

            $origin = $userLat . ',' . $userLng;
            $destination = $event->latitude . ',' . $event->longitude;

            $url = "https://maps.googleapis.com/maps/api/distancematrix/json?units=metric&origins=$origin&destinations=$destination&mode=driving&key=$apiKey";

            $response = file_get_contents($url);
            $data = json_decode($response, true);

            if (isset($data['rows'][0]['elements'][0]['distance']['value'])) {
                $km = round($data['rows'][0]['elements'][0]['distance']['value'] / 1000, 1);
                $result[$event->id] = ['distance' => $km . " Km"];
            } else {
                $result[$event->id] = ['distance' => "N/A"];
            }
        }

        return response()->json($result);
    }






    public function contact()
    {
        return view('front.contact.contact');
    }
    public function createpost()
    {
        return view('front.createpost.createpost');
    }


    public function event(Request $request)
    {
        // ✅ Get current locale (default to English)
        $locale = session('locale', 'en');

        // ✅ Build base query
        $query = Event::query();

        // ✅ Search by keyword
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'LIKE', '%' . $request->search . '%')
                    ->orWhere('description', 'LIKE', '%' . $request->search . '%')
                    ->orWhere('location', 'LIKE', '%' . $request->search . '%');
            });
        }

        // ✅ Filter by date range
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('created_at', [
                Carbon::parse($request->start_date)->startOfDay(),
                Carbon::parse($request->end_date)->endOfDay()
            ]);
        } elseif ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', Carbon::parse($request->start_date)->startOfDay());
        } elseif ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', Carbon::parse($request->end_date)->endOfDay());
        }

        // ✅ Filter by label
        if ($request->filled('label')) {
            $query->where('label', $request->label);
        }

        // ✅ Sorting
        if ($request->filled('sort_by')) {
            if ($request->sort_by == 'latest') {
                $query->orderBy('created_at', 'desc');
            } elseif ($request->sort_by == 'oldest') {
                $query->orderBy('created_at', 'asc');
            }
            // 'nearest' removed
        } else {
            $query->orderBy('created_at', 'desc'); // default
        }

        // ✅ Paginate results
        $events = $query->paginate(10)->appends($request->all());

        // ✅ Transform results (time ago, translation only)
        $events->getCollection()->transform(function ($event) use ($locale) {
            // Distance removed

            // Time ago
            $event->time_ago = Carbon::parse($event->created_at)->diffForHumans();

            // Translate title & description if locale is not English
            if ($locale != 'en') {
                $tr = new GoogleTranslate($locale);
                $event->title = $tr->translate($event->title);
                $event->description = $tr->translate($event->description);
            }

            return $event;
        });

        // ✅ Fetch all unique labels for filter dropdown
        $labels = Event::distinct()->pluck('label');

        // ✅ Return view
        return view('front.event.event', compact('events', 'labels'));
    }

    public function calculateDistance(Request $request)
{
    $userLat = $request->latitude;
    $userLng = $request->longitude;
    $eventId = $request->event_id;

    $event = Event::findOrFail($eventId);

    $eventLat = $event->latitude; // make sure your event table has lat/lng
    $eventLng = $event->longitude;

    $apiKey = env('GOOGLE_MAPS_KEY');

    $response = Http::get('https://maps.googleapis.com/maps/api/distancematrix/json', [
        'origins' => $userLat . ',' . $userLng,
        'destinations' => $eventLat . ',' . $eventLng,
        'key' => $apiKey,
        'units' => 'metric',
    ]);

    $data = $response->json();

    if (isset($data['rows'][0]['elements'][0]['status']) && $data['rows'][0]['elements'][0]['status'] == 'OK') {
        $distance = $data['rows'][0]['elements'][0]['distance']['text'];
        $duration = $data['rows'][0]['elements'][0]['duration']['text'];

        return response()->json([
            'success' => true,
            'distance' => $distance,
            'duration' => $duration,
        ]);
    }

    return response()->json(['success' => false]);
}







    //    public function eventdetail()
    //    {
    //       return view('front.event.eventdetail');
    //    }

    // public function eventdetail($id)
    // {
    //     // Fetch event with all associated media
    //     $event = Event::with('media')->findOrFail($id);
    //     // dd($event);

    //     return view('front.event.eventdetail', compact('event'));
    // }

    // public function eventdetail($id)
    // {
    //     // Your current location (you must pass it to the controller via request)
    //     $userLat = request()->get('lat');  // Example: from ?lat=...
    //     $userLng = request()->get('lng');  // Example: from ?lng=...

    //     // Fetch event with all associated media
    //     $event = Event::with('media')->findOrFail($id);

    //     // Calculate distance if both sets of coordinates exist
    //     if ($userLat && $userLng && $event->latitude && $event->longitude) {
    //         $event->distance_text = $this->calculateDistance($userLat, $userLng, $event->latitude, $event->longitude);
    //     } else {
    //         $event->distance_text = 'Distance N/A';
    //     }

    //     // Time difference (assuming reported_at exists, fallback to created_at)
    //     $event->time_ago = ($event->reported_at ?? $event->created_at)?->diffForHumans() ?? 'N/A';

    //     return view('front.event.eventdetail', compact('event'));
    // }


    // public function eventdetail($id)
    // {
    //     // Your current location (optional)
    //     $userLat = request()->get('lat');  // Example: from ?lat=...
    //     $userLng = request()->get('lng');  // Example: from ?lng=...

    //     // Fetch event with all associated media
    //     $event = Event::with('media')->findOrFail($id);

    //     // Calculate distance if coordinates exist
    //     if ($userLat && $userLng && $event->latitude && $event->longitude) {
    //         $event->distance_text = $this->calculateDistance($userLat, $userLng, $event->latitude, $event->longitude);
    //     } else {
    //         $event->distance_text = 'Distance N/A';
    //     }

    //     // Time difference (reported_at or created_at)
    //     $event->time_ago = ($event->reported_at ?? $event->created_at)?->diffForHumans() ?? 'N/A';

    //     // Fetch approved comments for this event
    //     $comments = Comment::with('user') // eager load user for name
    //                 ->where('post_id', $id)
    //                 ->where('status', 1) // only approved comments
    //                 ->latest() // show newest first
    //                 ->get();
    //                 // dd($comments);

    //     return view('front.event.eventdetail', compact('event', 'comments'));
    // }


    // /**
    //  * Calculate distance between two coordinates using Haversine formula
    //  */
    // private function calculateDistance($lat1, $lon1, $lat2, $lon2)
    // {
    //     $earthRadius = 6371000; // meters

    //     $latFrom = deg2rad($lat1);
    //     $lonFrom = deg2rad($lon1);
    //     $latTo = deg2rad($lat2);
    //     $lonTo = deg2rad($lon2);

    //     $latDelta = $latTo - $latFrom;
    //     $lonDelta = $lonTo - $lonFrom;

    //     $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
    //         cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));

    //     $distance = $earthRadius * $angle;

    //     return $distance < 1000
    //         ? round($distance) . 'm away'
    //         : round($distance / 1000, 2) . 'km away';
    // }

    // public function eventdetail(Request $request, $id)
    // {
    //     // Get user's location from query params or fallback default (same as index)
    //     $userLat = $request->input('lat', 28.6139); // Default New Delhi
    //     $userLng = $request->input('lng', 77.2090); // Default New Delhi

    //     // Fetch event
    //     $event = Event::with('media')->findOrFail($id);

    //     // Calculate distance using same Haversine formula as index
    //     $distance = 6371000 * 2 * asin(sqrt(
    //         pow(sin(deg2rad($event->latitude - $userLat) / 2), 2) +
    //         cos(deg2rad($userLat)) * cos(deg2rad($event->latitude)) *
    //         pow(sin(deg2rad($event->longitude - $userLng) / 2), 2)
    //     ));

    //     $event->distance_text = $distance >= 1000
    //         ? round($distance / 1000, 2) . ' km away'
    //         : round($distance) . ' m away';

    //     // Time ago
    //     $event->time_ago = ($event->reported_at ?? $event->created_at)?->diffForHumans() ?? 'N/A';

    //     $liked = false;
    //     if (auth()->check()) {
    //         $liked = $event->likedByUser(auth()->id());
    //     }

    //     $totalLikes = $event->likes->count();

    //     // Approved comments
    //     $comments = Comment::with('user')
    //         ->where('post_id', $id)
    //         ->where('status', 1)
    //         ->latest()
    //         ->get();

    //     return view('front.event.eventdetail', compact('event', 'comments', 'liked', 'totalLikes'));
    // }

    public function eventdetail(Request $request, $id)
    {
        // Get current locale (default to English)
        $locale = session('locale', 'en');

        // User location
        $userLat = $request->input('lat', 28.6139);
        $userLng = $request->input('lng', 77.2090);

        // Fetch event
        $event = Event::with('media', 'user')->findOrFail($id);

        // Distance calculation
        $distance = 6371000 * 2 * asin(sqrt(
            pow(sin(deg2rad($event->latitude - $userLat) / 2), 2) +
                cos(deg2rad($userLat)) * cos(deg2rad($event->latitude)) *
                pow(sin(deg2rad($event->longitude - $userLng) / 2), 2)
        ));

        $event->distance_text = $distance >= 1000
            ? round($distance / 1000, 2) . ' km away'
            : round($distance) . ' m away';

        // Time ago
        $event->time_ago = ($event->reported_at ?? $event->created_at)?->diffForHumans() ?? 'N/A';

        // Translate only text fields if locale is not English
        if ($locale != 'en') {
            $tr = new GoogleTranslate($locale);
            $event->title = $tr->translate($event->title);
            $event->description = $tr->translate($event->description);
        }

        // Likes
        $liked = auth()->check() ? $event->likedByUser(auth()->id()) : false;
        $totalLikes = $event->likes->count();

        // Approved comments
        $comments = Comment::with('user')
            ->where('post_id', $id)
            ->where('status', 1)
            ->latest()
            ->get();

        $commentCount = $comments->count();

        return view('front.event.eventdetail', compact('event', 'comments', 'commentCount', 'liked', 'totalLikes'));
    }


    // public function eventdetail(Request $request, $id)
    // {
    //     $userLat = $request->input('lat', 28.6139); // default/fallback
    //     $userLng = $request->input('lng', 77.2090);

    //     $event = Event::select('*')
    //         ->selectRaw("
    //             (6371000 * acos(
    //                 cos(radians(?)) * cos(radians(latitude)) *
    //                 cos(radians(longitude) - radians(?)) +
    //                 sin(radians(?)) * sin(radians(latitude))
    //             )) AS distance
    //         ", [$userLat, $userLng, $userLat])
    //         ->findOrFail($id);

    //     // Format distance text
    //     if ($event->distance >= 1000) {
    //         $event->distance_text = round($event->distance / 1000, 1) . ' km away';
    //     } else {
    //         $event->distance_text = round($event->distance) . ' m away';
    //     }

    //     return view('front.event.eventdetail', compact('event'));
    // }


    // public function eventdetail(Request $request, $id)
    // {
    //     $userLat = $request->input('lat', 28.6139); // fallback default lat
    //     $userLng = $request->input('lng', 77.2090); // fallback default lng

    //     $event = Event::with('media') // eager load media
    //         ->select('*')
    //         ->selectRaw("
    //             (6371000 * acos(
    //                 cos(radians(?)) * cos(radians(latitude)) *
    //                 cos(radians(longitude) - radians(?)) +
    //                 sin(radians(?)) * sin(radians(latitude))
    //             )) AS distance
    //         ", [$userLat, $userLng, $userLat])
    //         ->where('id', $id)
    //         ->firstOrFail();

    //     // Format distance text
    //     if (!is_null($event->distance)) {
    //         if ($event->distance >= 1000) {
    //             $event->distance_text = round($event->distance / 1000, 1) . ' km away';
    //         } else {
    //             $event->distance_text = round($event->distance) . ' m away';
    //         }
    //     } else {
    //         $event->distance_text = 'Location not available';
    //     }

    //     return view('front.event.eventdetail', compact('event'));
    // }

    //    public function about()
    //    {
    //       return view('front.about.about');
    //    }

    public function about()
    {
        // Fetch only published blogs (you can use blog_status = 1 for published)
        $blogs = Blog::where('blog_status', 1)
            ->orderBy('id', 'desc')
            ->take(6) // latest 6 blogs (you can change this)
            ->get();

        return view('front.about.about', compact('blogs'));
    }


    public function term()
    {
        return view('front.term.termcondition');
    }
    public function privacy()
    {
        return view('front.privacypolicy.privacypolicy');
    }
    public function community()
    {
        return view('front.community.community');
    }
    public function login()
    {
        return view('front.login.login');
    }
    public function register()
    {
        return view('front.register.register');
    }
    //    public function map()
    //    {
    //     return view('front.map.map-view');
    //    }

    // public function map()
    // {
    //     // Get the latest event (based on reported_at or created_at)
    //     $latestEvent = Event::with('media')
    //         ->orderBy('reported_at', 'desc')
    //         ->orderBy('created_at', 'desc')
    //         ->first();

    //     // Get all other events except the latest one
    //    $otherEvents = Event::with('media')
    //     ->where('id', '!=', optional($latestEvent)->id)
    //     ->orderBy('reported_at', 'desc')
    //     ->orderBy('created_at', 'desc')
    //     ->take(4)   // ✅ Limit to 4 posts
    //     ->get();


    //     return view('front.map.map-view', compact('latestEvent', 'otherEvents'));
    // }

    // public function map(Request $request)
    // {
    //     $userLat = $request->lat;
    //     $userLng = $request->lng;

    //     // Latest Event
    //     $latestEvent = Event::with('media')
    //         ->orderBy('reported_at', 'desc')
    //         ->orderBy('created_at', 'desc')
    //         ->first();

    //     // Calculate distance for latest event
    //     $latestDistance = null;
    //     if ($latestEvent && $userLat && $userLng) {
    //         $latestDistance = Event::calculateDistance(
    //             $userLat, $userLng,
    //             $latestEvent->latitude, $latestEvent->longitude
    //         );
    //         $latestEvent->distance_text = $latestDistance >= 1000
    //             ? round($latestDistance/1000, 1).' km'
    //             : $latestDistance.' m';
    //     }

    //     // Other Events
    //     $otherEvents = Event::with('media')
    //         ->where('id', '!=', optional($latestEvent)->id)
    //         ->orderBy('reported_at', 'desc')
    //         ->orderBy('created_at', 'desc')
    //         ->take(4)
    //         ->get();

    //     // Calculate distance for each other event
    //     if ($userLat && $userLng) {
    //         foreach ($otherEvents as $event) {
    //             $distance = Event::calculateDistance(
    //                 $userLat, $userLng,
    //                 $event->latitude, $event->longitude
    //             );
    //             $event->distance_text = $distance >= 1000
    //                 ? round($distance/1000, 1).' km'
    //                 : $distance.' m';
    //         }
    //     }

    //     return view('front.map.map-view', compact('latestEvent', 'otherEvents'));
    // }

    // public function map(Request $request)
    // {
    //     $userLat = $request->lat;
    //     $userLng = $request->lng;

    //     // Latest Event
    //     $latestEvent = Event::with('media')
    //         ->orderBy('reported_at', 'desc')
    //         ->orderBy('created_at', 'desc')
    //         ->first();

    //     // Calculate distance for latest event
    //     if ($latestEvent && $userLat && $userLng) {
    //         $latestDistance = Event::calculateDistance(
    //             $userLat, $userLng,
    //             $latestEvent->latitude, $latestEvent->longitude
    //         );
    //         $latestEvent->distance_text = $latestDistance >= 1000
    //             ? round($latestDistance/1000, 1).' km'
    //             : $latestDistance.' m';
    //     }

    //     // Other Events
    //     $otherEvents = Event::with('media')
    //         ->where('id', '!=', optional($latestEvent)->id)
    //         ->orderBy('reported_at', 'desc')
    //         ->orderBy('created_at', 'desc')
    //         ->take(4)
    //         ->get();

    //     // Calculate distance for each other event
    //     if ($userLat && $userLng) {
    //         foreach ($otherEvents as $event) {
    //             $distance = Event::calculateDistance(
    //                 $userLat, $userLng,
    //                 $event->latitude, $event->longitude
    //             );
    //             $event->distance_text = $distance >= 1000
    //                 ? round($distance/1000, 1).' km'
    //                 : $distance.' m';
    //         }
    //     }



    //     // Pass userLat and userLng to view
    //     return view('front.map.map-view', compact('latestEvent', 'otherEvents', 'userLat', 'userLng'));
    // }



    // public function map(Request $request)
    // {
    //     $userLat = $request->lat;
    //     $userLng = $request->lng;

    //     $locale = session('locale', config('app.locale')); // get current language

    //     // Latest Event
    //     $latestEvent = Event::with('media')
    //         ->orderBy('reported_at', 'desc')
    //         ->orderBy('created_at', 'desc')
    //         ->first();

    //     // Translate latest event
    //     if ($latestEvent) {
    //         if ($locale != 'en') {
    //             $tr = new GoogleTranslate($locale);
    //             $latestEvent->title = $tr->translate($latestEvent->title);
    //             $latestEvent->description = $tr->translate($latestEvent->description);
    //         }

    //         if ($userLat && $userLng) {
    //             $latestDistance = Event::calculateDistance(
    //                 $userLat, $userLng,
    //                 $latestEvent->latitude, $latestEvent->longitude
    //             );
    //             $latestEvent->distance_text = $latestDistance >= 1000
    //                 ? round($latestDistance/1000, 1).' km'
    //                 : $latestDistance.' m';
    //         }
    //     }

    //     // Other Events
    //     $otherEvents = Event::with('media')
    //         ->where('id', '!=', optional($latestEvent)->id)
    //         ->orderBy('reported_at', 'desc')
    //         ->orderBy('created_at', 'desc')
    //         ->take(4)
    //         ->get();

    //     // Translate and calculate distance for each other event
    //     if ($userLat && $userLng) {
    //         foreach ($otherEvents as $event) {
    //             if ($locale != 'en') {
    //                 $tr = new GoogleTranslate($locale);
    //                 $event->title = $tr->translate($event->title);
    //                 $event->description = $tr->translate($event->description);
    //             }

    //             $distance = Event::calculateDistance(
    //                 $userLat, $userLng,
    //                 $event->latitude, $event->longitude
    //             );
    //             $event->distance_text = $distance >= 1000
    //                 ? round($distance/1000, 1).' km'
    //                 : $distance.' m';
    //         }
    //     }

    //     return view('front.map.map-view', compact('latestEvent', 'otherEvents', 'userLat', 'userLng'));
    // }


    public function map(Request $request)
    {
        $userLat = $request->lat;
        $userLng = $request->lng;
        $locale  = session('locale', config('app.locale'));

        // Distance filter (meters)
        $distance = $request->get('distance');
        // Post type filter
        $type = $request->get('type');
        // Sort filter
        $sort = $request->get('sort', 'latest'); // default latest

        // Latest Event
        $latestEvent = Event::with('media')
            ->when($type, fn($q) => $q->where('label', $type))
            ->orderBy($sort === 'oldest' ? 'created_at' : 'created_at', $sort === 'oldest' ? 'asc' : 'desc')
            ->first();

        if ($latestEvent) {
            if ($locale != 'en') {
                $tr = new GoogleTranslate($locale);
                $latestEvent->title       = $tr->translate($latestEvent->title);
                $latestEvent->description = $tr->translate($latestEvent->description);
            }

            if ($userLat && $userLng) {
                $latestDistance = Event::calculateDistance(
                    $userLat,
                    $userLng,
                    $latestEvent->latitude,
                    $latestEvent->longitude
                );

                if (!$distance || $latestDistance <= $distance) {
                    $latestEvent->distance_text = $latestDistance >= 1000
                        ? round($latestDistance / 1000, 1) . ' km'
                        : $latestDistance . ' m';
                } else {
                    $latestEvent = null; // exclude if outside filter
                }
            }
        }

        // Other Events
        $otherEvents = Event::with('media')
            ->when($type, fn($q) => $q->where('label', $type))
            ->where('id', '!=', optional($latestEvent)->id)
            ->orderBy($sort === 'oldest' ? 'created_at' : 'created_at', $sort === 'oldest' ? 'asc' : 'desc')
            ->take(10)
            ->get();

        if ($userLat && $userLng) {
            $otherEvents = $otherEvents->filter(function ($event) use ($userLat, $userLng, $locale, $distance) {
                if ($locale != 'en') {
                    $tr = new GoogleTranslate(app()->getLocale());
                    $event->title       = $tr->translate($event->title);
                    $event->description = $tr->translate($event->description);
                }

                $d = Event::calculateDistance($userLat, $userLng, $event->latitude, $event->longitude);
                $event->distance_text = $d >= 1000 ? round($d / 1000, 1) . ' km' : $d . ' m';

                // Filter by distance if given
                return !$distance || $d <= $distance;
            });
        }

        return view('front.map.map-view', [
            'latestEvent' => $latestEvent,
            'otherEvents' => $otherEvents,
            'userLat'     => $userLat,
            'userLng'     => $userLng,
            'filters'     => compact('distance', 'type', 'sort')
        ]);
    }





    public function store(Request $request, $post_id)
    {
        if (!Auth::check()) {
            // Redirect to login page with current URL to return back
            return redirect()->route('login', ['redirect' => url()->current()])
                ->with('error', 'You must login to comment.');
        }

        $request->validate([
            'comment' => 'required|string|max:1000',
        ]);

        Comment::create([
            'user_id' => Auth::id(),
            'post_id' => $post_id,
            'comment' => $request->comment,
            'status' => 0,
        ]);

        return back()->with('success', 'Comment posted successfully!');
    }



    public function storeEnquiryForm(Request $request)
    {
        $request->validate([
            'name'       => 'required|string|max:255',
            'email'      => 'required|email|max:255',
            'subject'    => 'required|string|max:255',
            'message'    => 'required|string',
            'attachment' => 'nullable|file|mimes:jpg,jpeg,png,pdf,mp4|max:10240', // optional
        ]);

        $data = $request->only('name', 'email', 'subject', 'message');

        // Handle attachment if uploaded
        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/enquiry'), $filename);
            // Store relative path to asset folder
            $data['attachment'] = 'uploads/enquiry/' . $filename;
        }

        $data['status'] = 0; // pending

        Enquiry::create($data);

        return response()->json(['status' => 'success', 'message' => 'Enquiry submitted successfully!']);
    }



    // public function showEventMap($id, Request $request)
    //     {
    //         // 1. Get the event
    //         $eventMap = Event::findOrFail($id);
    //         // 4. Pass data to view
    //         return view('front.map.map', ['event' => $eventMap]);
    //     }

    // public function showEventMap($id, Request $request)
    // {
    //     $eventMap = Event::with('media')->findOrFail($id); // load related media if exists
    //     return view('front.map.map', ['event' => $eventMap]);
    // }

    // public function showEventMap($id, Request $request)
    // {
    //     $eventMap = Event::with('media')->findOrFail($id);

    //     // Example: get 3 other events for related posts
    //     $relatedPosts = Event::with('media')
    //         ->where('id', '!=', $id)
    //         ->latest()
    //         ->take(3)
    //         ->get();

    //     return view('front.map.map', [
    //         'event' => $eventMap,
    //         'relatedPosts' => $relatedPosts
    //     ]);
    // }

    // public function showEventMap($id, Request $request)
    // {
    //     $eventMap = Event::with('media')->findOrFail($id);

    //     $userLat = $request->input('lat');
    //     $userLng = $request->input('lng');

    //     $distance = null;

    //     if ($userLat && $userLng) {
    //         $distance = $this->calculateDistances(
    //             $userLat, $userLng,
    //             $eventMap->latitude, $eventMap->longitude
    //         );
    //     }

    //     $relatedPosts = Event::with('media')
    //         ->where('id', '!=', $id)
    //         ->latest()
    //         ->take(3)
    //         ->get();

    //     return view('front.map.map', [
    //         'event' => $eventMap,
    //         'relatedPosts' => $relatedPosts,
    //         'distance' => $distance
    //     ]);
    // }




    // public function showEventMap($id, Request $request)
    // {
    //     $eventMap = Event::with('media')->findOrFail($id);

    //     $userLat = $request->input('lat');
    //     $userLng = $request->input('lng');

    //     $distance = null;

    //     if ($userLat && $userLng) {
    //         $distance = $this->calculateDistances(
    //             $userLat, $userLng,
    //             $eventMap->latitude, $eventMap->longitude
    //         );
    //     }

    //     $relatedPosts = Event::with('media')
    //         ->where('id', '!=', $id)
    //         ->latest()
    //         ->take(3)
    //         ->get();

    //     // Add distance to each related post
    //     if ($userLat && $userLng) {
    //         foreach ($relatedPosts as $related) {
    //             $related->distance = $this->calculateDistances(
    //                 $userLat, $userLng,
    //                 $related->latitude, $related->longitude
    //             );
    //         }
    //     }

    //     return view('front.map.map', [
    //         'event' => $eventMap,
    //         'relatedPosts' => $relatedPosts,
    //         'distance' => $distance
    //     ]);
    // }

    // private function calculateDistances($lat1, $lon1, $lat2, $lon2)
    // {
    //     $earthRadius = 6371; // km

    //     $dLat = deg2rad($lat2 - $lat1);
    //     $dLon = deg2rad($lon2 - $lon1);

    //     $a = sin($dLat / 2) * sin($dLat / 2) +
    //          cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
    //          sin($dLon / 2) * sin($dLon / 2);

    //     $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

    //     $distance = $earthRadius * $c;

    //     return round($distance, 2); // km
    // }


    public function showEventMap($id, Request $request)
    {
        $eventMap = Event::with('media')->findOrFail($id);
        // dd($eventMap);

        $userLat = $request->input('lat', 28.6139);
        $userLng = $request->input('lng', 77.2090);



        $distance_text = $this->calculateDistance(
            $userLat,
            $userLng,
            $eventMap->latitude,
            $eventMap->longitude
        );

        $relatedPosts = Event::with('media')
            ->where('id', '!=', $id)
            ->latest()
            ->take(3)
            ->get();

        foreach ($relatedPosts as $related) {
            $related->distance_text = $this->calculateDistance(
                $userLat,
                $userLng,
                $related->latitude,
                $related->longitude
            );
        }

        return view('front.map.map', compact('eventMap',  'relatedPosts', 'distance_text', 'userLat', 'userLng'));
    }

    private function calculateDistances($lat1, $lon1, $lat2, $lon2)
    {
        $earthRadius = 6371000; // meters

        $latFrom = deg2rad($lat1);
        $lonFrom = deg2rad($lon1);
        $latTo   = deg2rad($lat2);
        $lonTo   = deg2rad($lon2);

        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;

        $angle = 2 * asin(sqrt(
            pow(sin($latDelta / 2), 2) +
                cos($latFrom) * cos($latTo) *
                pow(sin($lonDelta / 2), 2)
        ));

        $distance = $earthRadius * $angle;

        return $distance < 1000
            ? round($distance) . ' m away'
            : round($distance / 1000, 2) . ' km away';
    }



    //  public function storePost(Request $request)
    //     {
    //         $request->validate([
    //             'title'     => 'required|string|max:255',
    //             'caption'   => 'nullable|string',
    //             'latitude'  => 'required|numeric',
    //             'longitude' => 'required|numeric',
    //             'postType'  => 'required|string',
    //             'terms'     => 'accepted',
    //             'file'      => 'nullable|file|mimes:jpg,jpeg,png,mp4|max:20480'
    //         ]);

    //         $event = new Event();
    //         $event->title       = $request->title;
    //         $event->description = $request->caption;
    //         $event->latitude    = $request->latitude;
    //         $event->longitude   = $request->longitude;
    //         $event->media_type  = $request->postType;

    //         // Save media if uploaded
    //         if ($request->hasFile('file')) {
    //             $fileName = time().'_'.$request->file('file')->getClientOriginalName();
    //             $request->file('file')->move(public_path('uploads/events'), $fileName);
    //             $event->media_path = 'uploads/events/' . $fileName;
    //         }

    //         $event->status      = 'active';
    //         $event->reported_at = now();
    //         $event->save();


    //         return response()->json(['status'=>'success', 'message'=>'Event posted successfully!']);

    //     }





    public function storePost(Request $request)
    {
        // 1️⃣ Check if user is logged in
        if (!auth()->check()) {
            // Redirect to login page if not authenticated
            return redirect()->route('login')->with('error', 'Please login to create a post.');
        }

        // 2️⃣ Validate the request
        $request->validate([
            'title'     => 'required|string|max:255',
            'caption'   => 'nullable|string',
            'latitude'  => 'required|numeric',
            'longitude' => 'required|numeric',
            'postType'  => 'required|string',
            'terms'     => 'accepted',
        ]);

        // 3️⃣ Create new event
        $event = new Event();
        $event->user_id     = auth()->id(); // Logged-in user's ID
        $event->title       = $request->title;
        $event->description = $request->caption;
        $event->latitude    = $request->latitude;
        $event->longitude   = $request->longitude;
        $event->media_type  = $request->postType;

        // 4️⃣ Handle file upload if exists
        if ($request->hasFile('file')) {
            $fileName = time() . '_' . $request->file('file')->getClientOriginalName();
            $request->file('file')->move(public_path('admin/uploads/event'), $fileName);
            $event->media_path = $fileName;
        }

        $event->status      = 'active';
        $event->reported_at = now();
        $event->save();

        return redirect()->route('thankyou')->with('success', 'Event posted successfully!');
    }



    public function toggleLike($id)
    {
        $event = Event::findOrFail($id);
        $user = auth()->user();

        $like = $event->likes()->where('user_id', $user->id)->first();

        if ($like) {
            $like->delete();
            $liked = false;
        } else {
            $event->likes()->create([
                'user_id' => $user->id
            ]);
            $liked = true;
        }

        return response()->json([
            'liked' => $liked,
            'total_likes' => $event->likes()->count()
        ]);
    }
}
