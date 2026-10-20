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

class NetworkController extends Controller{
public function Branches(Request $request)
{
    $perPage = $request->get('per_page', 10);
    $search = $request->get('search');
    $sort = $request->get('sort', 'desc'); // asc / desc

    $query = DB::table('branch as b')
        ->leftJoin('states as s', 'b.state', '=', 's.id')
        ->where('b.status', 1)
        ->select('b.*', 's.name as state_name');

    // Filter by state name (route param)
    if ($request->filled('name')) {
        $query->where('s.name', 'like', '%' . $request->name . '%');
    }

    // 🔍 Search by branch name / address
    if ($search) {
        $query->where(function ($q) use ($search) {
            $q->where('b.branch_name', 'like', "%$search%")
              ->orWhere('b.address', 'like', "%$search%");
        });
    }

    // 🔄 Sorting
    $query->orderBy('b.branch_name', $sort);

    $branches = $query->paginate($perPage);

    $banner = DB::table('states')->where('name', $request->name)->first();

    return response()->json([
        'status' => 1,
        'responseText' => 'Branches Fetch Successful',
        'responseData' => [
            'branches' => $branches->items(),
            'banner' => [
                'image' => $banner ? $banner->image : null,
                'title' => $banner ? $banner->name : null,
            ],
            'pagination' => [
                'current_page'  => $branches->currentPage(),
                'last_page'     => $branches->lastPage(),
                'per_page'      => $branches->perPage(),
                'total'         => $branches->total(),
                'next_page_url' => $branches->nextPageUrl(),
                'prev_page_url' => $branches->previousPageUrl(),
            ],
        ]
    ]);
}

public function getBranches(Request $request)
{
    $sort = strtolower($request->input('sort', 'desc'));
    $sort = in_array($sort, ['asc', 'desc']) ? $sort : 'desc';

    $search = trim($request->input('search', ''));

    $branches = DB::table('branch as b')
        ->leftJoin('states as s', 'b.state', '=', 's.id')
        ->where('b.status', 1)
        ->where(function ($query) use ($search) {
            $query->where('b.branch_name', 'like', '%' . $search . '%')
                  ->orWhere('b.address', 'like', '%' . $search . '%')
                  ->orWhere('s.name', 'like', '%' . $search . '%');
        })
        ->select([
            'b.id','b.branch_name as name','b.google_link','b.contact_person','b.address','b.phone',
            's.name as state_name',
        ])
        ->orderBy('b.branch_name', $sort)
        ->get();

    if ($branches->isEmpty()) {
        return response()->json([
            'status' => 0,
            'responseText' => 'No branches found',
            'responseData' => [
                'branches' => [],
            ],
        ]);
    }

    return response()->json([
        'status' => 1,
        'responseText' => 'Branches Fetch Successful',
        'responseData' => [
            'branches' => $branches,
        ],
    ]);
}
}