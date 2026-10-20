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

class ClientlistsController extends Controller{
public function clientlist(Request $request)
{
    $clients = DB::table('client')
        ->select('id','title','image')
        ->where('status', 1)
        ->orderBy('id','desc')
        ->get();

    return response()->json([
        'status' => 1,
        'message' => 'Client list fetched successfully',
        'data' => $clients
    ]);
}

}