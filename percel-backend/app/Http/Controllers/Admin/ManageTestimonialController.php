<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\AdminHelper;
use App\Models\ManageTestimonial;    

class ManageTestimonialController extends Controller
{
    public function index()
    {
        if (!AdminHelper::isView()) {
            return redirect(AdminHelper::adminPath())->withError('Sorry you do not have privilege to access this area !');
        }

        $data = [];
        $data['page_title'] = 'Manage Testimonial';
        $limit = (!empty(request()->get('limit'))?request()->get('limit'):20);
        $data['limit'] = $limit;
        $q = request()->get('q');
        $filter_column = request()->get('filter_column', 'created_at');
        $sorting = (!empty(request()->get('sorting'))?request()->get('sorting'):'desc');
       $data['rows'] = ManageTestimonial::when($q, function ($query) use ($q) {
    $query->where(function($sub) use ($q) {
        $sub->where('name', 'like', "%{$q}%")
            ->orWhere('designation', 'like', "%{$q}%");
    });
})
->orderBy($filter_column, $sorting)
->paginate($limit);
        
        return view('admin.manage_testimonial.index', $data);
    }

    public function create()
    {
        if (!AdminHelper::isCreate()) {
            return redirect(AdminHelper::adminPath())->withError('Sorry you do not have privilege to access this area !');
        }

        $data = [];
        $data['page_title'] = 'Add Testimonial';        
        
        return view('admin.manage_testimonial.create', $data);
    }

    public function store(Request $request)
    {
        if (!AdminHelper::isCreate()) {
            return redirect(AdminHelper::adminPath())->withError('Sorry you do not have privilege to access this area !');
        }

        $request->validate([
            'name'=>'required|string|max:250',
            'designation'=>'required|string|max:250',
            'message'=>'required|string|max:500',
            'image'=>'mimes:jpeg,png,svg,webp|max:2000|nullable'
        ]);

        $image_path = '';
        if ($request->hasFile('image')) {
                $image = $request->file('image');
                $name = 'testimonial-'.time().'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('uploads/testimonial/');
                $image->move($destinationPath, $name);
                $image_path = 'uploads/testimonial/'.$name;
        }

        ManageTestimonial::insert([
            'name'=>$request->input('name'),
            'designation'=>$request->input('designation'),
            'message'=>$request->input('message'),
            'image'=>$image_path,
            'status'=>$request->input('status'),
            'created_at'=>now()
        ]);
        
        $return_url = (!empty($request->input('return_url'))?$request->input('return_url'):route('manage-testimonial.index'));
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
        $data['page_title'] = 'Testimonial Details';
        $data['row'] = ManageTestimonial::findOrFail($id);

        return view('admin.manage_testimonial.show', $data);
    }

    public function edit($id)
    {
        if (!AdminHelper::isUpdate()) {
            return redirect(AdminHelper::adminPath())->withError('Sorry you do not have privilege to access this area !');
        }

        $data = [];
        $data['page_title'] = 'Edit Testimonial';
        $data['row'] = ManageTestimonial::findOrFail($id);

        return view('admin.manage_testimonial.edit', $data);
    }

    public function update(Request $request, $id)
    {
        if (!AdminHelper::isUpdate()) {
            return redirect(AdminHelper::adminPath())->withError('Sorry you do not have privilege to access this area !');
        }

        $request->validate([
            'name'=>'required|string|max:250',
            'designation'=>'required|string|max:250',
            'message'=>'required|string|max:500',
            'image'=>'mimes:jpeg,png,svg,webp|max:2000|nullable'
        ]);

        $row = ManageTestimonial::findOrFail($id);
        if ($request->hasFile('image')) {
                $image = $request->file('image');
                $name = 'testimonial-'.time().'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('uploads/testimonial/');
                $image->move($destinationPath, $name);
                $row->image = 'uploads/testimonial/'.$name;
        }

        $row->name = $request->input('name');
        $row->designation = $request->input('designation');
        $row->message = $request->input('message');
        $row->status = $request->input('status');
        $row->updated_at = now();
        $row->save();

        $return_url = (!empty($request->input('return_url'))?$request->input('return_url'):route('manage-testimonial.index'));
    return redirect($return_url)->withSuccess('Data updated successfully!');
    }

    public function destroy($id)
    {
        if (!AdminHelper::isDelete()) {
            return redirect(AdminHelper::adminPath())->withError('Sorry you do not have privilege to access this area !');
        }

        $row = ManageTestimonial::findOrFail($id);
        $row->delete();

        return redirect()->back()->withSuccess('Data deleted successfully!');
    }

    public function changeStatus(Request $request)
    {
        // dd("it is commin here",$request);
        $request->validate([
            'id' => 'required|exists:services,id',
            'status' => 'required|boolean'
        ]);

        $data = ManageTestimonial::findOrFail($request->id);
        $data->status = $request->status;
        $data->save();

        return redirect()->back()->withSuccess('Status updated successfully!');
    }
}