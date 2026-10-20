<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Auth;
use App\Slider;
use App\Slidertwo;
use App\HomepageSetting;
use App\Categorie;
use App\ProductVideo;
use App\Models\Settings;
use App\Models\Contact;
use App\ProductBestSeller;
use App\Deal;
use App\ManageCategory;
use App\ProductReview;
use App\ProductListView;
use App\Product;
use App\User;

use Hash;
use CommonHelper;

class ServiceController extends Controller{
    public function Services(Request $request)
{
    $perPage = $request->get('per_page', 10); // default 10 per page

    $services = DB::table('services')
        ->where('status', 1)
        ->select('services.id','services.title','services.image','services.icon','services.text')
        ->orderBy('id', 'desc')
        ->paginate($perPage);
    $elements = [];

    return response()->json([
        'status' => 1,
        'responseText' => 'Services Fetch Successful',
        'responseData' => [
            'services' => $services->items(), // actual data
            'pagination' => [
                'current_page' => $services->currentPage(),
                'last_page' => $services->lastPage(),
                'per_page' => $services->perPage(),
                'total' => $services->total(),
                'next_page_url' => $services->nextPageUrl(),
                'prev_page_url' => $services->previousPageUrl(),
            ],
            'elements' => $elements,
        ]
    ]);
}
public function Banner(Request $request)
{
    $slug = $request->input('slug');

    $slugMap = [
        "home" => 1,
        "footer" => 2,
        "service" => 3,
        "network" => 4,
        "tracking" => 5,
        "about" => 6,
        "career" => 7,
        "privacypolicy"=>9,
        "location" => 8,
    ];

    if (!isset($slugMap[$slug])) {
        return response()->json([
            'status' => 0,
            'responseText' => 'Invalid slug provided',
            'responseData' => []
        ], 400);
    }

    $banner = DB::table('banner_images')
        ->where("type", $slugMap[$slug])
        ->where('status',"1")
        ->get();

    return response()->json([
        'status' => 1,
        'responseText' => 'Banner Fetch Successful',
        'responseData' => [
            'banner' => $banner
        ]
    ]);
}
}