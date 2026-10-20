<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;
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

class TrackingController extends Controller{
public function tracking(Request $request)
{
    $request->validate([
        'grn' => 'required'
    ]);

    $grn = $request->grn;

    // GreenTrans API URL
    // $clientId = 'B8lC+5zm4M4=';
    $clientId=env('CLIENT_ID', '');
    $url = "https://greentrans.in:444/API/Tracking/GRTracking?ClientId=wWlFtfEQZI8WEfGL7vPJHA=="."&GRNo={$grn}";
   // return $url;

    // =========================
    // CURL CALL
    // =========================
    $ch = curl_init();
    curl_setopt_array($ch, [
    CURLOPT_URL => "https://greentrans.in:444/API/Tracking/GRTracking?ClientId=wWlFtfEQZI8WEfGL7vPJHA==&GRNo=294470000124%22",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_CONNECTTIMEOUT => 10,
    CURLOPT_TIMEOUT => 30,
]);

   

    $response = curl_exec($ch);
    $error = curl_error($ch);
    curl_close($ch);
    // dd($response);
    if ($error) {
        return response()->json([
            'status' => 0,
            'message' => 'Tracking API Error',
            'error' => $error
        ], 500);
    }

    if (!$response) {
        return response()->json([
            'status' => 0,
            'message' => 'Empty response from tracking server'
        ], 500);
    }

    // =========================
    // Convert XML to JSON
    // =========================
    // libxml_use_internal_errors(true);
    // $xml = simplexml_load_string($response, "SimpleXMLElement", LIBXML_NOCDATA);
    //  return $xml;
    // if (!$xml) {
    //     return response()->json([
    //         'status' => 0,
    //         'message' => 'Invalid XML response'
    //     ], 500);
    // }
      return $response;
   
}
// public function tracking(Request $request)
// {
//     $request->validate([
//         'grn' => 'required'
//     ]);

//     try {
//         $response = Http::withoutVerifying()
//             ->timeout(30)
//             ->accept('application/xml')
//             ->get(
//                 'https://greentrans.in:444/API/Tracking/GRTracking',
//                 [
//                     'ClientId' => 'wWlFtfEQZI8WEfGL7vPJHA==',
//                     'GRNo' => $request->grn,
//                 ]
//             );

//         if (!$response->successful()) {
//             return response()->json([
//                 'status' => 0,
//                 'message' => 'Tracking API request failed',
//                 'http_code' => $response->status(),
//                 'response' => $response->body()
//             ], 500);
//         }

//         $xmlString = $response->body();

//         if (empty($xmlString)) {
//             return response()->json([
//                 'status' => 0,
//                 'message' => 'Empty response from tracking server'
//             ], 500);
//         }

//         // Return raw XML
//         return response($xmlString, 200)
//             ->header('Content-Type', 'application/xml');


//     } catch (\Exception $e) {
//         return response()->json([
//             'status' => 0,
//             'message' => 'Tracking API Error',
//             'error' => $e->getMessage()
//         ], 500);
//     }
// }
}