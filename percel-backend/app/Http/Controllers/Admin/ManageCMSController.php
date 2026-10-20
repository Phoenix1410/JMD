<?php 
namespace App\Http\Controllers\Admin;

use AdminHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\CmsPages;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class ManageCMSController extends Controller
{
	function getIndex()
    {      
        if (!AdminHelper::isView()) {
            return redirect(AdminHelper::adminPath())->withError('Sorry you do not have privilege to access this area !');
        }
    	$request = request();
        $data = [];
        $data['page_title'] = 'Manage CMS';
        $data['limit'] = $limit = (!empty($request->get('limit'))?$request->get('limit'):20);
        $q = $request->get('q');

        $filter_clumn = $request->get('filter_column');
        $sorting = $request->get('sorting');
        if($filter_clumn!='')
        {
            $data['rows'] = CmsPages::when($q, function($query) use ($q){                           
                            $query->whereRaw("( page_title like '%".$q."%' or meta_title like '%".$q."%' )");
                        })->orderBy($filter_clumn,$sorting)->paginate($limit);

        }
        else
        {
            $data['rows'] = CmsPages::when($q, function($query) use ($q){                           
                            $query->whereRaw("( page_title like '%".$q."%' or meta_title like '%".$q."%' )");
                        })->latest()->paginate($limit);

        }
        
            
        return view('admin.cms_management.index', $data);
    }

    function getAdd()
    {
        if (!AdminHelper::isCreate()) {
            return redirect(AdminHelper::adminPath())->withError('Sorry you do not have privilege to access this area !');
        }
    	$data = [];
        $data['page_title'] = 'Add CMS';
            
        return view('admin.cms_management.add', $data);
    }

    function postAddSave(Request $request)
    {
        if (!AdminHelper::isCreate()) {
            return redirect(AdminHelper::adminPath())->withError('Sorry you do not have privilege to access this area !');
        }
    	$request->validate([
    		'page_title' => 'required|max:150',
            'meta_title' => 'required|max:150',
    		'image' => 'image|mimes:jpeg,jpg,png,gif,webp,svg|max:5000',    		
    		'status' => 'required|numeric'
    	]);

         $isdata = CmsPages::where('page_title' ,$request->input('page_title'))->get();
        if(!$isdata->isEmpty()){
           return redirect()->back()->withError('Page Already Exists!'); 
        }

        $featured_image = '';
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = 'featured-image-'.time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('admin/uploads/images/cmspage/');
            $image->move($destinationPath, $name);
            $featured_image = 'admin/uploads/images/cmspage/'.$name;
        }
        $slug_val = SlugService::createSlug(CmsPages::class, 'page_slug', $request->input('meta_title'));
    	CmsPages::insert([
    		'page_title' => $request->input('page_title'),
    		'page_slug' => $slug_val,
            'page_content' => $request->input('page_content'),
            'featured_image' => $featured_image,
            'meta_title' => $request->input('meta_title'),
            'meta_keywords' => $request->input('meta_keywords'),            
            'meta_description' => $request->input('meta_description'),            
    		'status' => $request->input('status'),
            'created_by' => AdminHelper::myId(),
            'user_ip' => $request->ip(),
    		'created_at' => date('Y-m-d H:i:s')
    	]);

    	$return_url = (!empty($request->input('return_url'))?$request->input('return_url'):AdminHelper::adminPath().'/manage-cms');
    	if($request->input('submit')=='Save')
    	{
    		return redirect($return_url)->withSuccess('CMS added successfully!');
    	}else{
    		return redirect()->back()->withSuccess('CMS added successfully!');
    	}
    }

    function getDetail($id)
    {
        if (!AdminHelper::isRead()) {
            return redirect(AdminHelper::adminPath())->withError('Sorry you do not have privilege to access this area !');
        }
    	$data = [];
    	$data['page_title'] = 'Details CMS';
    	$data['row'] = CmsPages::find($id);

    	return view('admin.cms_management.detail', $data);
    }

    function getEdit($id)
    {
        if (!AdminHelper::isUpdate()) {
            return redirect(AdminHelper::adminPath())->withError('Sorry you do not have privilege to access this area !');
        }
    	$data = [];
    	$data['page_title'] = 'Edit CMS';
    	$data['row'] = CmsPages::find($id);

    	return view('admin.cms_management.edit', $data);
    }

    function postUpdateSave($id, Request $request)
    {
        if (!AdminHelper::isUpdate()) {
            return redirect(AdminHelper::adminPath())->withError('Sorry you do not have privilege to access this area !');
        }
    	$request->validate([
            'page_title' => 'required|max:150',
            'meta_title' => 'required|max:150',
            'image' => 'image|mimes:jpeg,jpg,png,gif,webp,svg|max:5000',         
            'status' => 'required|numeric'
        ]);

         $isdata = CmsPages::where('id' ,'!=',$id)->where('page_title' ,$request->input('page_title'))->get();
       
        if(!$isdata->isEmpty()){
           return redirect()->back()->withError('Page Already Exists!'); 
        }

        $featured_image = '';
        $cms = CmsPages::find($id);
        if ($request->hasFile('image')) {
            // if(\Storage::exists($cms->featured_image) || file_exists(public_path($cms->featured_image))){
            //     //$file = public_path($file);
            //     // unlink(public_path($cms->featured_image));
            // }
            $image = $request->file('image');
            $name = 'featured-image-'.time().'.'.$image->getClientOriginalExtension();
           $destinationPath = public_path('uploads/site/cmspage/');
            $image->move($destinationPath, $name);
            $featured_image = 'uploads/site/cmspage/'.$name;
        }
       // $slug_val = SlugService::createSlug(CmsPages::class, 'page_slug', $request->input('meta_title'));
    	// dd($request->all());
    	$cms->page_title = $request->input('page_title');
    	//$cms->page_slug = $slug_val;
        $cms->page_content = $request->input('page_content');
    	if(!empty($featured_image))
    	{
    		$cms->featured_image = $featured_image;
    	}
    	$cms->meta_title = $request->input('meta_title');
        $cms->meta_keywords = $request->input('meta_keywords');
        $cms->meta_description = $request->input('meta_description');
        $cms->status = $request->input('status');
        $cms->updated_by = AdminHelper::myId();
        $cms->user_ip = $request->ip();
        $cms->updated_at = date('Y-m-d H:i:s');

    	$cms->save();

    	$return_url = (!empty($request->input('return_url'))?$request->input('return_url'):AdminHelper::adminPath().'/manage-cms');
    	return redirect($return_url)->withSuccess('CMS updated successfully!');
    }

    function getDelete($id)
    {
        if (!AdminHelper::isDelete()) {
            return redirect(AdminHelper::adminPath())->withError('Sorry you do not have privilege to access this area !');
        }
    	if(!empty($id))
    	{
    		CmsPages::find($id)->delete();
    		return redirect()->back()->withSuccess('CMS deleted successfully!');
    	}
    }

    public function postActionSelected(Request $request)
    {        
        if (!AdminHelper::isDelete()) {
            return redirect(AdminHelper::adminPath())->withError('Sorry you do not have privilege to access this area !');
        }
        $id_selected = $request->input('checkbox');
        $button_name = $request->input('button_name');
        $message = "No action taken";
        if (empty($id_selected)) {
            AdminHelper::redirect($_SERVER['HTTP_REFERER'], 'Please select at least one data!', 'warning');
        }

        if ($button_name == 'delete') {                  
            CmsPages::whereIn('id', $id_selected)->delete();

            AdminHelper::insertLog("Deleted data ".implode(',', $id_selected)." by ".AdminHelper::myName()." ip: ".$request->ip());            

            $message = "The selected data deleted successfully !";

            return redirect()->back()->withSuccess($message);
        }  

        if($button_name == 'active')      
        {
            CmsPages::whereIn('id', $id_selected)->update(['status'=>1, 'updated_at'=>date('Y-m-d H:i:s')]);

            AdminHelper::insertLog("Updated data ".implode(',', $id_selected)." by ".AdminHelper::myName()." ip: ".$request->ip()); 

            $message = "The selected data activated successfully !";
            return redirect()->back()->withSuccess($message);
        }

        if($button_name == 'inactive')      
        {
            CmsPages::whereIn('id', $id_selected)->update(['status'=>0, 'updated_at'=>date('Y-m-d H:i:s')]);

            AdminHelper::insertLog("Updated data ".implode(',', $id_selected)." by ".AdminHelper::myName()." ip: ".$request->ip()); 

            $message = "The selected data inactivated successfully !";
            return redirect()->back()->withSuccess($message);
        }

        return redirect()->back()->withError($message);
    }
}