<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\AdminHelper;
use App\Models\WhoWeAre;    

class WhoWeAreController extends Controller
{
    public function index()
    {
        if (!AdminHelper::isView()) {
            return redirect(AdminHelper::adminPath())->withError('Sorry you do not have privilege to access this area !');
        }

        $data = [];
        $data['page_title'] = 'Who We Are';
        $data['row'] = WhoWeAre::find(1);
        
        return view('admin.who_we_are.index', $data);
    }

    public function create()
    {
        if (!AdminHelper::isCreate()) {
            return redirect(AdminHelper::adminPath())->withError('Sorry you do not have privilege to access this area !');
        }

        $data = [];
        $data['page_title'] = 'Add WhoWeAre';        
        
        return view('admin.who_we_are.create', $data);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        if (!AdminHelper::isCreate()) {
            return redirect(AdminHelper::adminPath())->withError('Sorry you do not have privilege to access this area !');
        }

        $request->validate([
            'title'=>'required|string|max:50',
            'description'=>'required|string|max:3000',
            'vision_statement'=>'required|string|max:300',
            'our_value'=>'required|string|max:300',
            'our_value_title'=>'required|string|max:300',
            'quality_policy_title'=>'required|string|max:300',
            'vision_statement_title'=>'required|string|max:300',
            'quality_policy'=>'required|string|max:300'
        ]);

        $row = WhoWeAre::find(1);
        if(!empty($row)){
            $row->title = $request->input('title');
            $row->description = $request->input('description');
            $row->vision_statement_content = $request->input('vision_statement');
            $row->our_value_content = $request->input('our_value');
            $row->quality_policy_content = $request->input('quality_policy');
            $row->vision_statement_title = $request->input('vision_statement_title');
            $row->quality_policy_title = $request->input('quality_policy_title');
            $row->our_value_title = $request->input('our_value_title');
            $row->updated_at = now();
            $row->save();
        }else{
            WhoWeAre::insert([
                'title'=>$request->input('title'),
                'description'=>$request->input('description'),
                'vision_statement_content'=>$request->input('vision_statement'),
                'our_value_content'=>$request->input('our_value'),
                'vision_statement_title' => $request->input('vision_statement_title'),
                'quality_policy_title' => $request->input('quality_policy_title'),
                'our_value_title' => $request->input('our_value_title'),
                'quality_policy_content'=>$request->input('quality_policy'),
                'created_at'=>now()
            ]);
        }        
        
        $return_url = (!empty($request->input('return_url'))?$request->input('return_url'):route('who-we-are.index'));
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
        $data['page_title'] = 'WhoWeAre Details';
        $data['row'] = WhoWeAre::findOrFail($id);

        return view('admin.who_we_are.show', $data);
    }

    public function edit($id)
    {
        if (!AdminHelper::isUpdate()) {
            return redirect(AdminHelper::adminPath())->withError('Sorry you do not have privilege to access this area !');
        }

        $data = [];
        $data['page_title'] = 'Edit WhoWeAre';
        $data['row'] = WhoWeAre::findOrFail($id);

        return view('admin.who_we_are.edit', $data);
    }

    public function update(Request $request, $id)
    {
        dd($request->all());
        if (!AdminHelper::isUpdate()) {
            return redirect(AdminHelper::adminPath())->withError('Sorry you do not have privilege to access this area !');
        }

        $request->validate([]);

        $row = WhoWeAre::findOrFail($id);
        $row->update($request->all());
       
        $return_url = (!empty($request->input('return_url'))?$request->input('return_url'):route('who-we-are.index'));
    return redirect($return_url)->withSuccess('Data updated successfully!');
    }

    public function destroy($id)
    {
        if (!AdminHelper::isDelete()) {
            return redirect(AdminHelper::adminPath())->withError('Sorry you do not have privilege to access this area !');
        }

        $row = WhoWeAre::findOrFail($id);
        $row->delete();

        return redirect()->back()->withSuccess('Data deleted successfully!');
    }
}