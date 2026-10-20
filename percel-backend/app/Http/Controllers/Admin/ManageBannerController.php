<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\AdminHelper;
use App\Models\ManageBanner;    

class ManageBannerController extends Controller
{
    public function index()
    {
        if (!AdminHelper::isView()) {
            return redirect(AdminHelper::adminPath())->withError('Sorry you do not have privilege to access this area !');
        }

        $data = [];
        $data['page_title'] = 'Manage Banner';
        $limit = (!empty(request()->get('limit'))?request()->get('limit'):20);
        $data['limit'] = $limit;
        $q = request()->get('q');
        $filter_column = request()->get('filter_column', 'created_at');
        $sorting = (!empty(request()->get('sorting'))?request()->get('sorting'):'desc');
        $data['rows'] = ManageBanner::when($q, function ($query) use ($q) {
            $query->where('title', 'like', "%{$q}%");
        })
        ->orderBy($filter_column, $sorting)
        ->paginate($limit);
        
        return view('admin.manage_banner.index', $data);
    }

    public function create()
    {
        if (!AdminHelper::isCreate()) {
            return redirect(AdminHelper::adminPath())->withError('Sorry you do not have privilege to access this area !');
        }

        $data = [];
        $data['page_title'] = 'Add Banner';        
        
        return view('admin.manage_banner.create', $data);
    }

    public function store(Request $request)
    {
        if (!AdminHelper::isCreate()) {
            return redirect(AdminHelper::adminPath())->withError('Sorry you do not have privilege to access this area !');
        }
        // dd($request);
        $request->validate([
            'title'=>'required|string|max:30',
            'sub_title'=>'required|string|max:50',
            'short_description'=>'string|max:5000|nullable',
            'url'=>'active_url|nullable',
            'image'=>'required|mimes:jpeg,png,svg,webp|max:2000'
        ]);

        $image_path = '';
        if ($request->hasFile('image')) {
                $image = $request->file('image');
                $name = 'service-'.time().'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('uploads/services/');
                $image->move($destinationPath, $name);
                $image_path = 'uploads/services/'.$name;
        }

        ManageBanner::insert([
            'title'=>$request->input('title'),
            'sub_title'=>$request->input('sub_title'),
            'short_description'=>$request->input('short_description'),
            'url'=>$request->input('url'),
            'position'=>1,
            'type'=>$request->type,
            'image'=>$image_path,
            'status'=>$request->input('status'),
            'created_at'=>now()
        ]);
        
        $return_url = (!empty($request->input('return_url'))?$request->input('return_url'):route('manage-banner.index'));
        if($request->input('submit')=='Save')
        {
            return redirect($return_url)->withSuccess('Data added successfully!');
        }else{
            return redirect()->back()->withSuccess('Data added successfully!');
        }
    }

    public function show($id)
    {
        if (!AdminHelper::isRead()) {
            return redirect(AdminHelper::adminPath())->withError('Sorry you do not have privilege to access this area !');
        }

        $data = [];
        $data['page_title'] = 'Manage Banner Details';
        $data['row'] = ManageBanner::findOrFail($id);

        return view('admin.manage_banner.show', $data);
    }

    public function edit($id)
    {
        if (!AdminHelper::isUpdate()) {
            return redirect(AdminHelper::adminPath())->withError('Sorry you do not have privilege to access this area !');
        }
       
        $data = [];
        $data['page_title'] = 'Edit Manage Banner';
        $data['row'] = ManageBanner::findOrFail($id);

        return view('admin.manage_banner.edit', $data);
    }

    public function update(Request $request, $id)
    {
        if (!AdminHelper::isUpdate()) {
            return redirect(AdminHelper::adminPath())->withError('Sorry you do not have privilege to access this area !');
        }
        //  dd($request->hasFile('image'));
        $request->validate([
            'title'=>'required|string|max:30',
            'sub_title'=>'required|string|max:50',
            'short_description'=>'string|max:5000|nullable',
            'url'=>'active_url|nullable',
            'image'=>'mimes:jpeg,png,svg,webp|max:2000'
        ]);

        $row = ManageBanner::findOrFail($id);

        $image_path = '';
        if ($request->hasFile('image')) {
            if ($row->image && file_exists(public_path($row->image))) {
                    unlink(public_path($row->image));
                }
                $image = $request->file('image');
                $name = 'service-'.time().'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('uploads/services/');
                $image->move($destinationPath, $name);
                $row->image = 'uploads/services/'.$name;
        }

        $row->title = $request->input('title');
        $row->sub_title = $request->input('sub_title');
        $row->short_description = $request->input('short_description');
        $row->url = $request->input('url');
        // $row->type=$request->type;
        $row->status = $request->input('status');
        $row->updated_at = now();
        $row->save();
       
        $return_url = (!empty($request->input('return_url'))?$request->input('return_url'):route('manage-banner.index'));
    return redirect($return_url)->withSuccess('Data updated successfully!');
    }

    public function destroy($id)
    {
        if (!AdminHelper::isDelete()) {
            return redirect(AdminHelper::adminPath())->withError('Sorry you do not have privilege to access this area !');
        }

        $row = ManageBanner::findOrFail($id);
        // Delete image from folder
        if ($row->image && file_exists(public_path($row->image))) {
            unlink(public_path($row->image));
        }
        $row->delete();

        return redirect()->back()->withSuccess('Data deleted successfully!');
    }

    public function changeStatus(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:banner_images,id',
            'status' => 'required|boolean'
        ]);

        $data = ManageBanner::findOrFail($request->id);
        $data->status = $request->status;
        $data->save();

         return redirect()->back()->withSuccess('Status Updated successfully!');
    }
}