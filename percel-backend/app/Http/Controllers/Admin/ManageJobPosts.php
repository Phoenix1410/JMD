<?php 
namespace App\Http\Controllers\Admin;

use App\Helpers\AdminHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller;

class ManageJobPosts extends Controller
{
   function getIndex()
{      
    $request = request();
    $data = []; 

    $data['page_title'] = 'Job Applications';
    $data['limit'] = $limit = ($request->get('limit') ?? 20);
    $q = $request->get('q');

    $filter_column = $request->get('filter_column');
    $sorting = in_array($request->get('sorting'), ['asc','desc']) ? $request->get('sorting') : 'desc';

    $query = DB::table('job_applications');

    if ($q) {
        $query->where(function($sub) use ($q){
            $sub->where('applicant_name', 'like', "%$q%")
                ->orWhere('phone_number', 'like', "%$q%")
                ->orWhere('email', 'like', "%$q%")
                ->orWhere('description', 'like', "%$q%");
        });
    }

    $allowedColumns = [
        'applicant_name',
        'phone_number',
        'email',
        'created_at'
    ];

    if ($filter_column && in_array($filter_column, $allowedColumns)) {
        $query->orderBy($filter_column, $sorting);
    } else {
        $query->orderBy('created_at', 'desc');
    }

    $data['rows'] = $query->paginate($limit);

    return view('admin.jobposts.index', $data);
}



    function getDetail($id)
    {
        $data['page_title'] = 'Job Post Details';
        $data['row'] = DB::table('job_applications')->where('id', $id)->first();

        return view('admin.jobposts.detail', $data);
    }

    //  public function changeStatus(Request $request)
    // {
    //     $request->validate([
    //         'id' => 'required|exists:services,id',
    //         'status' => 'required|boolean'
    //     ]);
    //         DB::table('job_listings')
    //         ->where('id', $request->id)
    //         ->update(['status' => $request->status]);
    //       // $data = ManageTestimonial::findOrFail($request->id);
    //       // $data->status = $request->status;
    //       // $data->save();

    //     return redirect()->back()->withSuccess('Status updated successfully!');
    // }
}