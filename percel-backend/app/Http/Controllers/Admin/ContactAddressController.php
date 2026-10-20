<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\AdminHelper;
use App\Models\ContactAddress;  
use Illuminate\Support\Facades\DB;  

class ContactAddressController extends Controller
{
    public function index()
    {
        if (!AdminHelper::isView()) {
            return redirect(AdminHelper::adminPath())->withError('Sorry you do not have privilege to access this area !');
        }

        $data = [];
        $data['page_title'] = 'Contact Address';
        $limit = (!empty(request()->get('limit'))?request()->get('limit'):20);
        $data['limit'] = $limit;
        $q = request()->get('q');
        $filter_column = request()->get('filter_column', 'created_at');
        $sorting = (!empty(request()->get('sorting'))?request()->get('sorting'):'desc');
       $data['rows'] = ContactAddress::when($q, function ($query) use ($q) {
            $query->where(function ($sub) use ($q) {
                $sub->where('title', 'like', "%{$q}%")
                    ->orWhere('address', 'like', "%{$q}%");
            });
        })
        ->orderBy($filter_column, $sorting)
        ->paginate($limit);
        
        return view('admin.contact_address.index', $data);
    }

    public function create()
    {
        if (!AdminHelper::isCreate()) {
            return redirect(AdminHelper::adminPath())->withError('Sorry you do not have privilege to access this area !');
        }

        $data = [];
        $data['page_title'] = 'Add Contact Address';        
        
        return view('admin.contact_address.create', $data);
    }

    public function store(Request $request)
    {
        if (!AdminHelper::isCreate()) {
            return redirect(AdminHelper::adminPath())->withError('Sorry you do not have privilege to access this area !');
        }

        $request->validate([
            'title'=>'required|string|max:250',
            'address'=>'required|string|max:500',
            'status'=>'required'
        ]);
        ContactAddress::insert([
            'title'=>$request->input('title'),
            'address'=>$request->input('address'),
            'status'=>$request->input('status'),
            'created_at'=>now()
        ]);
        
        $return_url = (!empty($request->input('return_url'))?$request->input('return_url'):route('contact-address.index'));
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
        $data['page_title'] = 'Contact Address Details';
        $data['row'] = ContactAddress::findOrFail($id);

        return view('admin.contact_address.show', $data);
    }

    public function edit($id)
    {
        if (!AdminHelper::isUpdate()) {
            return redirect(AdminHelper::adminPath())->withError('Sorry you do not have privilege to access this area !');
        }

        $data = [];
        $data['page_title'] = 'Edit Contact Address';
        $data['row'] = ContactAddress::findOrFail($id);

        return view('admin.contact_address.edit', $data);
    }

    public function update(Request $request, $id)
    {
        if (!AdminHelper::isUpdate()) {
            return redirect(AdminHelper::adminPath())->withError('Sorry you do not have privilege to access this area !');
        }

        $request->validate([
            'title'=>'required|string|max:250',
            'address'=>'required|string|max:500',
            'status'=>'required'
        ]);

        $row = ContactAddress::findOrFail($id);
        $row->update([
            'title'=>$request->input('title'),
            'address'=>$request->input('address'),
            'status'=>$request->input('status'),
            'updated_at'=>now()
        ]);
       
        $return_url = (!empty($request->input('return_url'))?$request->input('return_url'):route('contact-address.index'));
    return redirect($return_url)->withSuccess('Data updated successfully!');
    }

    public function destroy($id)
    {
        if (!AdminHelper::isDelete()) {
            return redirect(AdminHelper::adminPath())->withError('Sorry you do not have privilege to access this area !');
        }

        $row = ContactAddress::findOrFail($id);
        $row->delete();

        return redirect()->back()->withSuccess('Data deleted successfully!');
    }

    public function changeStatus(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:contact_addresses,id',
            'status' => 'required|boolean'
        ]);
        //  dd($request);
         DB::table('contact_addresses')
    ->where('id', $request->id)
    ->update(['status' => $request->status]);
        // $data = ContactAddress::findOrFail($request->id);
        // $data->status = $request->status;
        // $data->save();

        return redirect()->back()->withSuccess('Status updated successfully!');
    }
}