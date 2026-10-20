<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\AdminHelper;
use App\Models\Service;   
use Illuminate\Support\Facades\DB; 

class ManageServicesController extends Controller
{
    public function index()
    {
        if (!AdminHelper::isView()) {
            return redirect(AdminHelper::adminPath())->withError('Sorry you do not have privilege to access this area !');
        }

        $data = [];
        $data['page_title'] = 'Manage Services';
        $limit = (!empty(request()->get('limit'))?request()->get('limit'):20);
        $data['limit'] = $limit;
        $q = request()->get('q');
        $filter_column = request()->get('filter_column', 'created_at');
        $sorting = (!empty(request()->get('sorting'))?request()->get('sorting'):'desc');
        $data['rows'] = Service::when($q, function ($query) use ($q) {
            $query->where('title', 'like', "%{$q}%");
        })
        ->orderBy($filter_column, $sorting)
        ->paginate($limit);
        
        return view('admin.manage_services.index', $data);
    }

    public function create()
    {
        if (!AdminHelper::isCreate()) {
            return redirect(AdminHelper::adminPath())->withError('Sorry you do not have privilege to access this area !');
        }

        $data = [];
        $data['page_title'] = 'Add Service';        
        
        return view('admin.manage_services.create', $data);
    }

    public function store(Request $request)
    {
        if (!AdminHelper::isCreate()) {
            return redirect(AdminHelper::adminPath())->withError('Sorry you do not have privilege to access this area !');
        }
        // dd($request->image);
        $request->validate([
            'title'=>'required|string|max:250',
            'text'=>'required|max:1000',
            'image'=>'required|mimes:jpeg,png,svg,webp|max:2000',
            'icon'=>'required|mimes:jpeg,png,svg,webp|max:2000'
        ]);

        $image_path = '';
        if ($request->hasFile('image')) {
                $image = $request->file('image');
                $name = 'service-'.time().'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('uploads/services/');
                $image->move($destinationPath, $name);
                $image_path = 'uploads/services/'.$name;
        }
        $icon_path = '';
        if ($request->hasFile('icon')) {
                $icon = $request->file('icon');
                $name = 'service-'.time().'.'.$icon->getClientOriginalExtension();
                $destinationPath = public_path('uploads/services/');
                $icon->move($destinationPath, $name);
                $icon_path = 'uploads/services/'.$name;
        }

        Service::insert([
            'title'=>$request->input('title'),
            'image'=>$image_path,
            'icon'=>$icon_path,
            'status'=>$request->input('status'),
            'text'=>strip_tags($request->input('text')),
            'created_at'=>now()
        ]);
        
        $return_url = (!empty($request->input('return_url'))?$request->input('return_url'):route('manage-services.index'));
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
        $data['page_title'] = 'Service Details';
        $data['row'] = Service::findOrFail($id);

        return view('admin.manage_services.show', $data);
    }

    public function edit($id)
    {
        if (!AdminHelper::isUpdate()) {
            return redirect(AdminHelper::adminPath())->withError('Sorry you do not have privilege to access this area !');
        }

        $data = [];
        $data['page_title'] = 'Edit Service';
        $data['row'] = Service::findOrFail($id);

        return view('admin.manage_services.edit', $data);
    }

    public function update(Request $request, $id)
    {
        if (!AdminHelper::isUpdate()) {
            return redirect(AdminHelper::adminPath())->withError('Sorry you do not have privilege to access this area !');
        }
        // dd($request->input('text'));
        $request->validate([
            'title'=>'required|string|max:250',
            'text'=>'required|max:1000',
            // 'image'=>'required|mimes:jpeg,png,svg,webp|max:2000'
        ]);

        $row = Service::findOrFail($id);
        $image_path = '';
        if ($request->hasFile('image')) {
                $image = $request->file('image');
                $name = 'service-'.time().'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('uploads/services/');
                $image->move($destinationPath, $name);
                $row->image = 'uploads/services/'.$name;
        }
        $icon_path = '';
        if ($request->hasFile('icon')) {
                $icon = $request->file('icon');
                $name = 'service-'.time().'.'.$icon->getClientOriginalExtension();
                $destinationPath = public_path('uploads/services/');
                $icon->move($destinationPath, $name);
                $row->icon = 'uploads/services/'.$name;
        }
        $row->title = $request->input('title');
        $row->text =strip_tags($request->input('text'));
        $row->status = $request->input('status');
        $row->updated_at = now();
        $row->save();
       
        $return_url = (!empty($request->input('return_url'))?$request->input('return_url'):route('manage-services.index'));
    return redirect($return_url)->withSuccess('Data updated successfully!');
    }

    public function destroy($id)
    {
        if (!AdminHelper::isDelete()) {
            return redirect(AdminHelper::adminPath())->withError('Sorry you do not have privilege to access this area !');
        }

        $row = Service::findOrFail($id);
        $row->delete();

        return redirect()->back()->withSuccess('Data deleted successfully!');
    }

    public function changeStatus(Request $request,$id)
    {
        // dd($id);
        $request->validate([
            // 'id' => 'required|exists:services,id',
            'status' => 'required|boolean'
        ]);
        DB::table('services')
        ->where('id', $id)
            ->update([
                'status' => $request->status,
                'updated_at' => now()
            ]);
        // $data = Service::findOrFail($id);
        // $data->status = $request->status;
        // $data->save();

        return redirect()->back()->withSuccess('Status updated  successfully!');
    }
}