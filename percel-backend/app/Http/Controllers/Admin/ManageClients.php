<?php 
namespace App\Http\Controllers\Admin;

use App\Helpers\AdminHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller;

class ManageClients extends Controller
{
function getIndex()
{      
    $request = request();
    $data = []; 

    $data['page_title'] = 'Clients';
    $data['limit'] = $limit = ($request->get('limit') ?? 20);
    $q = $request->get('q');

    $filter_column = $request->get('filter_column');
    $sorting = in_array($request->get('sorting'), ['asc','desc']) ? $request->get('sorting') : 'desc';

    $query = DB::table('client');

    // Search
    if ($q) {
        $query->where(function($sub) use ($q){
            $sub->where('title', 'like', "%$q%")
                ->orWhere('description', 'like', "%$q%")
                ->orWhere('location', 'like', "%$q%");
        });
    }

    // Allowed columns for sorting
    $allowedColumns = ['title','location','status','created_at'];

    if ($filter_column && in_array($filter_column, $allowedColumns)) {
        $query->orderBy($filter_column, $sorting);
    } else {
        $query->orderBy('created_at', 'desc');
    }

    $data['rows'] = $query->paginate($limit);

    return view('admin.clients.index', $data);
}

    function getAdd()
    {
        return view('admin.clients.add', [
            'page_title' => 'Add Job List'
        ]);
    }

public function postAddSave(Request $request)
{
    $request->validate([
        'title'       => 'required|string|max:255',
        // 'location'    => 'required|string|max:255',
        // 'description' => 'nullable|string|max:255',
        'image'       => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        'status'      => 'required|in:0,1',
    ]);

    $imageName = null;

    if ($request->hasFile('image')) {
        $file = $request->file('image');
        $imageName = time().'_'.$file->getClientOriginalName();
        $file->move(public_path('uploads/clients'), $imageName);
    }

    DB::table('client')->insert([
        'title'       => $request->title,
        'location'    => $request->location??'',
        // 'description' => $request->description??'',
        'image'       => 'uploads/clients/'.$imageName,
        'status'      => $request->status,
        'created_at'  => now(),
        'updated_at'  => now(),
    ]);

    return redirect(AdminHelper::adminPath().'/manageclient')
        ->withSuccess('Client added successfully!');
}
    function getDetail($id)
    {
        $data['page_title'] = 'Job Lists';
        $data['row'] = DB::table('client')->where('id', $id)->first();

        return view('admin.clients.detail', $data);
    }

    function getEdit($id)
    {
        $data['page_title'] = 'Edit Job List';
        $data['row'] = DB::table('client')->where('id', $id)->first();

        return view('admin.clients.edit', $data);
    }

function postUpdateSave($id, Request $request)
{
    $request->validate([
        'title'  => 'required|string|max:255',
        'image'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        'status' => 'required|in:0,1'
    ]);

    $row = DB::table('client')->where('id', $id)->first();

    $imagePath = $row->image;

    // If new image uploaded
    if ($request->hasFile('image')) {

        // Delete old image
        if ($row->image && file_exists(public_path($row->image))) {
            unlink(public_path($row->image));
        }

        $file = $request->file('image');
        $imageName = time().'_'.$file->getClientOriginalName();
        $file->move(public_path('uploads/clients'), $imageName);

        $imagePath = 'uploads/clients/'.$imageName;
    }

    DB::table('client')->where('id', $id)->update([
        'title'       => $request->title,
        'description' => $request->description,
        'location'    => $request->location ?? '',
        'image'       => $imagePath,
        'status'      => $request->status,
        'updated_at'  => now(),
    ]);

    return redirect(AdminHelper::adminPath().'/manageclient')
        ->withSuccess('Client updated successfully!');
}

 function getDelete($id)
{
    $row = DB::table('client')->where('id', $id)->first();

    // Remove image from public folder
    if ($row && $row->image && file_exists(public_path($row->image))) {
        unlink(public_path($row->image));
    }

    // Delete record
    DB::table('client')->where('id', $id)->delete();

    return redirect()->back()->withSuccess('Client deleted successfully!');
}

  
     public function changeStatus(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'status' => 'required|boolean'
        ]);
            DB::table('client')
    ->where('id', $request->id)
    ->update(['status' => $request->status]);
        // $data = ManageTestimonial::findOrFail($request->id);
        // $data->status = $request->status;
        // $data->save();

        return redirect()->back()->withSuccess('Status updated successfully!');
    }
}