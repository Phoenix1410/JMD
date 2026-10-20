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

class JoblistsController extends Controller{
public function joblists(Request $request)
{
    try {

        $search = $request->search;
        $location = $request->location;
        $min_experience = $request->min_experience;
        $max_experience = $request->max_experience;

        $query = DB::table('job_listings')->where('status', 1);

        // Search by title, designation, or location
        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'LIKE', "%$search%")
                  ->orWhere('designation', 'LIKE', "%$search%")
                  ->orWhere('location', 'LIKE', "%$search%");
            });
        }

        // Filter by location
        if (!empty($location)) {
            $query->where('location', 'LIKE', "%$location%");
        }

        // Filter by minimum experience
        if (!empty($min_experience)) {
            $query->where('min_experience', '>=', $min_experience);
        }

        // Filter by maximum experience
        if (!empty($max_experience)) {
            $query->where('max_experience', '<=', $max_experience);
        }

        $jobs = $query->orderBy('created_at', 'DESC')->get();

        return response()->json([
            'status' => true,
            'message' => 'Job list fetched successfully',
            'data' => $jobs
        ]);

    } catch (\Exception $e) {

        return response()->json([
            'status' => false,
            'message' => 'Something went wrong',
            'error' => $e->getMessage()
        ]);
    }
}
public function jobpost(Request $request)
{
    try {

        $validator = Validator::make($request->all(), [
            'job_id' => 'required|exists:job_listings,id',
            'applicant_name' => 'required|string|max:255',
            'phone_number' => 'nullable|string|max:20',
            'email' => 'required|email|max:255',
            'description' => 'nullable|string',
            'cv' => 'nullable|mimes:pdf,doc,docx|max:5000'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first()
            ]);
        }

        $cv_path = null;

        // Upload CV
        if ($request->hasFile('cv')) {

            $file = $request->file('cv');
            $filename = 'cv_'.time().'.'.$file->getClientOriginalExtension();
            $destinationPath = public_path('uploads/cv/');

            $file->move($destinationPath, $filename);

            $cv_path = 'uploads/cv/'.$filename;
        }

        DB::table('job_applications')->insert([
            'job_id' => $request->job_id,
            'applicant_name' => $request->applicant_name,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'description' => $request->description,
            'cv' => $cv_path,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Application submitted successfully'
        ]);

    } catch (\Exception $e) {

        return response()->json([
            'status' => false,
            'message' => 'Something went wrong',
            'error' => $e->getMessage()
        ]);
    }
}
}