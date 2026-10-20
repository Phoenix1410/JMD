<?php 
namespace App\Http\Controllers\Admin;

use AdminHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Routing\Controller;
use App\Models\Category;
use App\Models\AdminUser;

class ManageCategory extends Controller
{
	function getIndex()
    {      
        if (!AdminHelper::isView()) {
            return redirect(AdminHelper::adminPath())->withError('Sorry you do not have privilege to access this area !');
        }
    	$request = request();
        $data = [];
        $data['page_title'] = 'Manage Categories';
        $data['limit'] = $limit = (!empty($request->get('limit'))?$request->get('limit'):20);
        //dd($limit);
        $q = $request->get('q');
        $filter_clumn = ($request->get('filter_column'))?$request->get('filter_column'):'created_at';
        $sorting = ($request->get('sorting'))?$request->get('sorting'):'desc';

        $data['rows'] = Category::when($q, function($query) use ($q){                           
                            $query->whereRaw("(`category_name` like '%".$q."%')");
                        })->orderBy($filter_clumn,$sorting)->paginate($limit);
        
        //dd($data['rows']); 
           
        return view('admin.category.index', $data);
    }

    function getAdd()
    {
        if (!AdminHelper::isCreate()) {
            return redirect(AdminHelper::adminPath())->withError('Sorry you do not have privilege to access this area !');
        }
    	$data = [];
        $data['page_title'] = 'Add Category';        
       
        return view('admin.category.add', $data);
    }


    function postAddSave(Request $request)
    {
        if (!AdminHelper::isCreate()) {
            return redirect(AdminHelper::adminPath())->withError('Sorry you do not have privilege to access this area !');
        }
        
        $request->validate([
            'category_name' => 'required|max:250|min:2|unique:categories,category_name|string',
            'status' => 'required|numeric'
        ]);
      
    
        // $isdata = Category::where('title' ,$request->input('name'))->get();
        // if(!$isdata->isEmpty()){
        //    return redirect()->back()->withError('Category Already Exists!'); 
        // }
        $category_dtls = new Category ;

        $category_dtls->category_name = $request->category_name;
        $category_dtls->status = $request->input('status');
        $category_dtls->created_at = date('Y-m-d H:i:s');
        $category_dtls->created_by = AdminHelper::myId();
        $category_dtls->save();

        $return_url = (!empty($request->input('return_url'))?$request->input('return_url'):route('getCategoryIndex'));
        if($request->input('submit')=='Save')
        {
            return redirect($return_url)->withSuccess('Category added successfully!');
        }else{
            return redirect()->back()->withSuccess('Category added successfully!');
        }
    }

    function getEdit($id)
    {
        if (!AdminHelper::isUpdate()) {
            return redirect(AdminHelper::adminPath())->withError('Sorry you do not have privilege to access this area !');
        }
    	$data = [];
        $data['page_title'] = 'Edit Category';
        $data['row'] = Category::find($id);        

        return view('admin.category.edit', $data);
    }

    function postUpdateSave($id, Request $request)
    {
      if (!AdminHelper::isUpdate()) {
        return redirect(AdminHelper::adminPath())->withError('Sorry you do not have privilege to access this area !');
      }
      $request->validate([
            'category_name' => 'required|max:250|min:2|unique:categories,category_name,'.$id.'|string',
            'status' => 'required|numeric'
        ]);

        $category = Category::find($id);
        $category->category_name = $request->category_name;
        $category->status = $request->input('status');
        $category->updated_at = date('Y-m-d H:i:s');
        $category->save();       

        $return_url = (!empty($request->input('return_url'))?$request->input('return_url'):route('getCategoryIndex'));
        return redirect($return_url)->withSuccess('Category updated successfully!');
    }

    function getDetail($id)
    {
        if (!AdminHelper::isRead()) {
            return redirect(AdminHelper::adminPath())->withError('Sorry you do not have privilege to access this area !');
        }
        $data = [];
        $data['page_title'] = 'Category Details';
        $data['row'] = Category::find($id);        

        return view('admin.category.detail', $data);
    }

    function deleteCategory($id)
    {
        if (!AdminHelper::isDelete()) {
            return redirect(AdminHelper::adminPath())->withError('Sorry you do not have privilege to access this area !');
        }

        if(!empty($id))
        {
            Category::where('id',$id)->delete();
            return redirect()->back()->withSuccess('Category deleted successfully!');
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

        if($button_name == 'active')      
        {
            Category::whereIn('id', $id_selected)->update(['status'=>'1', 'updated_at'=>date('Y-m-d H:i:s')]);

            AdminHelper::insertLog("Updated data ".implode(',', $id_selected)." by ".AdminHelper::myName()." ip: ".$request->ip()); 

            $message = "The selected data activated successfully !";
            return redirect()->back()->withSuccess($message);
        }

        if($button_name == 'inactive')      
        {
            Category::whereIn('id', $id_selected)->update(['status'=>'0', 'updated_at'=>date('Y-m-d H:i:s')]);

            AdminHelper::insertLog("Updated data ".implode(',', $id_selected)." by ".AdminHelper::myName()." ip: ".$request->ip()); 

            $message = "The selected data inactivated successfully !";
            return redirect()->back()->withSuccess($message);
        }
        if($button_name == 'add-featured')      
        {
            Category::whereIn('id', $id_selected)->update(['is_featured'=>'1', 'updated_at'=>date('Y-m-d H:i:s')]);

            AdminHelper::insertLog("Updated data ".implode(',', $id_selected)." by ".AdminHelper::myName()." ip: ".$request->ip()); 

            $message = "The selected data featured successfully !";
            return redirect()->back()->withSuccess($message);
        }
        if($button_name == 'remove-featured')      
        {
            Category::whereIn('id', $id_selected)->update(['is_featured'=>'0', 'updated_at'=>date('Y-m-d H:i:s')]);

            AdminHelper::insertLog("Updated data ".implode(',', $id_selected)." by ".AdminHelper::myName()." ip: ".$request->ip()); 

            $message = "The selected data featured removed successfully !";
            return redirect()->back()->withSuccess($message);
        }

        if($button_name == 'delete')      
        {
            foreach($id_selected as $key=>$ids)
            {
                $data = Category::find($ids);
                $destinationPath_delete = public_path('/').$data->category_image;
               
                if(file_exists($destinationPath_delete)) 
                {
                    unlink($destinationPath_delete);
                }
            }
            Category::whereIn('id', $id_selected)->delete();

            AdminHelper::insertLog("Updated data ".implode(',', $id_selected)." by ".AdminHelper::myName()." ip: ".$request->ip()); 

            $message = "The selected data deleted successfully !";
            return redirect()->back()->withSuccess($message);
        }

        return redirect()->back()->withError($message);
    }
}