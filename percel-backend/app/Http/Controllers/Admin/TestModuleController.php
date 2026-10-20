<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\AdminHelper;
use App\Models\TestModule;    

class TestModuleController extends Controller
{
    public function index()
    {
        if (!AdminHelper::isView()) {
            return redirect(AdminHelper::adminPath())->withError('Sorry you do not have privilege to access this area !');
        }

        $data = [];
        $data['page_title'] = 'TestModule';
        $limit = (!empty(request()->get('limit'))?request()->get('limit'):20);
        $data['limit'] = $limit;
        $q = request()->get('q');
        $filter_column = request()->get('filter_column', 'created_at');
        $sorting = (!empty(request()->get('sorting'))?request()->get('sorting'):'desc');
        $data['rows'] = TestModule::when($q, function ($query) use ($q) {
            $query->where('country_name', 'like', "%{$q}%");
        })
        ->orderBy($filter_column, $sorting)
        ->paginate($limit);
        
        return view('admin.testmodule.index', $data);
    }

    public function create()
    {
        if (!AdminHelper::isCreate()) {
            return redirect(AdminHelper::adminPath())->withError('Sorry you do not have privilege to access this area !');
        }

        $data = [];
        $data['page_title'] = 'Add TestModule';        
        
        return view('admin.testmodule.create', $data);
    }

    public function store(Request $request)
    {
        if (!AdminHelper::isCreate()) {
            return redirect(AdminHelper::adminPath())->withError('Sorry you do not have privilege to access this area !');
        }

        $request->validate([]);
        TestModule::create($request->all());
        
        $return_url = (!empty($request->input('return_url'))?$request->input('return_url'):route('testmodule.index'));
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
        $data['page_title'] = 'TestModule Details';
        $data['row'] = TestModule::findOrFail($id);

        return view('admin.testmodule.show', $data);
    }

    public function edit($id)
    {
        if (!AdminHelper::isUpdate()) {
            return redirect(AdminHelper::adminPath())->withError('Sorry you do not have privilege to access this area !');
        }

        $data = [];
        $data['page_title'] = 'Edit TestModule';
        $data['row'] = TestModule::findOrFail($id);

        return view('admin.testmodule.edit', $data);
    }

    public function update(Request $request, $id)
    {
        if (!AdminHelper::isUpdate()) {
            return redirect(AdminHelper::adminPath())->withError('Sorry you do not have privilege to access this area !');
        }

        $request->validate([]);

        $row = TestModule::findOrFail($id);
        $row->update($request->all());
       
        $return_url = (!empty($request->input('return_url'))?$request->input('return_url'):route('testmodule.index'));
    return redirect($return_url)->withSuccess('Data updated successfully!');
    }

    public function destroy($id)
    {
        if (!AdminHelper::isDelete()) {
            return redirect(AdminHelper::adminPath())->withError('Sorry you do not have privilege to access this area !');
        }

        $row = TestModule::findOrFail($id);
        $row->delete();

        return redirect()->back()->withSuccess('Data deleted successfully!');
    }
}