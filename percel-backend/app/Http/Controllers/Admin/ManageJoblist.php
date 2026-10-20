<?php 
namespace App\Http\Controllers\Admin;

use App\Helpers\AdminHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller;

class ManageJoblist extends Controller
{
   function getIndex()
{      
    $request = request();
    $data = []; 

    $data['page_title'] = 'Job Rolls';
    $data['limit'] = $limit = ($request->get('limit') ?? 20);
    $q = $request->get('q');

    $filter_column = $request->get('filter_column');
    $sorting = in_array($request->get('sorting'), ['asc','desc']) ? $request->get('sorting') : 'desc';

    $query = DB::table('job_listings');

    if ($q) {
        $query->where(function($sub) use ($q){
            $sub->where('title', 'like', "%$q%")
                ->orWhere('designation', 'like', "%$q%")
                ->orWhere('location', 'like', "%$q%")
                ->orWhere('min_experience', 'like', "%$q%")
                ->orWhere('max_experience', 'like', "%$q%")
                ->orWhere('description', 'like', "%$q%");
        });
    }

    $allowedColumns = ['title','designation','experience','location','created_at'];

    if ($filter_column && in_array($filter_column, $allowedColumns)) {
        $query->orderBy($filter_column, $sorting);
    } else {
        $query->orderBy('created_at', 'desc');
    }

    $data['rows'] = $query->paginate($limit);

    return view('admin.joblisting.index', $data);
}

    function getAdd()
    {
        return view('admin.joblisting.add', [
            'page_title' => 'Add Job List'
        ]);
    }

function postAddSave(Request $request)
{
    $request->validate([
        'title'       => 'required|string|max:255',
        // 'designation' => 'required|string|max:255',
        'min_experience'  => 'required|int|max:100',
        'max_experience'  => 'required|int|max:100',
        'location'    => 'required|string|max:255',
        'description' => 'required|string',
    ]);

    DB::table('job_listings')->insert([
        'title'       => $request->title,
        'designation' => $request->designation,
        'min_experience'  => $request->min_experience,
        'max_experience'  => $request->max_experience,
        'location'    => $request->location,
        'description' => $request->description,
        'status'   =>    $request->status,
        'created_at'  => now(),
        'updated_at'  => now(),
    ]);

    return redirect(AdminHelper::adminPath().'/joblist')
        ->withSuccess('Job added successfully!');
}

    function getDetail($id)
    {
        $data['page_title'] = 'Job Lists';
        $data['row'] = DB::table('job_listings')->where('id', $id)->first();

        return view('admin.joblisting.detail', $data);
    }

    function getEdit($id)
    {
        $data['page_title'] = 'Edit Job List';
        $data['row'] = DB::table('job_listings')->where('id', $id)->first();

        return view('admin.joblisting.edit', $data);
    }

    function postUpdateSave($id, Request $request)
    {
        // dd($request);
        $request->validate([
            'title'       => 'required|string|max:255',
        // 'designation' => 'required|string|max:255',
        'min_experience'  => 'required|int|max:100',
        'max_experience'  => 'required|int|max:100',
        'location'    => 'required|string|max:255',
        'description' => 'required|string',
        ]);
       
        DB::table('job_listings')->where('id', $id)->update([
            'title'       => $request->title,
            'designation' => $request->designation,
            'min_experience' => $request->min_experience,
            'max_experience'  => $request->max_experience,
            'location'    => $request->location,
            'description' => $request->description,
            'status'   =>    $request->status,
            'updated_at'  => now(),
        ]);

        return redirect(AdminHelper::adminPath().'/joblist')
            ->withSuccess('Job updated successfully!');
    }

    function getDelete($id)
    {
        DB::table('job_listings')->where('id', $id)->delete();
        return redirect()->back()->withSuccess('Job deleted successfully!');
    }

    public function postActionSelected(Request $request)
    {
        $ids = $request->checkbox;
        $action = $request->button_name;

        if (empty($ids)) {
            return redirect()->back()->withWarning('Please select at least one record!');
        }

        if ($action == 'delete') {
            DB::table('job_listings')->whereIn('id', $ids)->delete();
            return redirect()->back()->withSuccess('Selected records deleted successfully!');
        }

        if ($action == 'active') {
            DB::table('job_listings')->whereIn('id', $ids)
                ->update(['status' => 1, 'updated_at' => now()]);
            return redirect()->back()->withSuccess('Selected records activated!');
        }

        if ($action == 'inactive') {
            DB::table('job_listings')->whereIn('id', $ids)
                ->update(['status' => 0, 'updated_at' => now()]);
            return redirect()->back()->withSuccess('Selected records inactivated!');
        }

        return redirect()->back()->withError('No action performed!');
    }
     public function changeStatus(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:services,id',
            'status' => 'required|boolean'
        ]);
            DB::table('job_listings')
    ->where('id', $request->id)
    ->update(['status' => $request->status]);
        // $data = ManageTestimonial::findOrFail($request->id);
        // $data->status = $request->status;
        // $data->save();

        return redirect()->back()->withSuccess('Status updated successfully!');
    }
}