<?php 
namespace App\Http\Controllers\Admin;

use \App\Helpers\AdminHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
use App\StaticBlock;

class ManageStaticBlockController extends Controller
{
	function getIndex()
    {
    	$request = request();
        $data = [];
        $data['page_title'] = 'Manage Static Blocks';
        $data['limit'] = $limit = (!empty($request->get('limit'))?$request->get('limit'):20);
        //dd($limit);
        $q = $request->get('q');
        $filter_clumn = ($request->get('filter_column'))?$request->get('filter_column'):'created_at';
        $sorting = ($request->get('sorting'))?$request->get('sorting'):'desc';

        $data['rows'] = StaticBlock::when($q, function($query) use ($q){                           
                            $query->whereRaw("( page_title ilike '%".$q."%')");
                        })->orderBy($filter_clumn,$sorting)->paginate($limit);
        
        //dd($data['rows']); 
           
        return view('admin.static_block.index', $data);
    }

    function getAdd()
    {
    	$data = [];
        $data['page_title'] = 'Add Static Block';            
       
        return view('admin.static_block.add', $data);
    }


    function postAddSave(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:250|min:2',
            'content' => 'string|min:2|nullable|max:3000',
            'image' => 'image|max:2000|nullable',
            'status' => 'required',            
        ]);

        $page_image = '';
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = time().rand().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('uploads/images/static_blocks/');
            $image->move($destinationPath, $name);
            $page_image = 'uploads/images/static_blocks/'.$name;
        }
        $page_image2 = '';
        if ($request->hasFile('image2')) {
            $image2 = $request->file('image2');
            $name2 = time().rand().'.'.$image2->getClientOriginalExtension();
            $destinationPath = public_path('uploads/images/static_blocks/');
            $image2->move($destinationPath, $name2);
            $page_image2 = 'uploads/images/static_blocks/'.$name2;
        }

        StaticBlock::insert([            
            'page_title' => $request->input('title'),            
            'image' => $page_image,
            'image2' => $page_image2,
            'page_content' => $request->input('content'),
            'page_tag' => Str::slug($request->input('title')),
            'status' => $request->input('status'),            
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        $return_url = (!empty($request->input('return_url'))?$request->input('return_url'):route('getStaticBlock'));
        if($request->input('submit')=='Save')
        {
            return redirect($return_url)->withSuccess('Static Block added successfully!');
        }else{
            return redirect()->back()->withSuccess('Static Block added successfully!');
        }
    }

    function getEdit($id)
    {
    	$data = [];
        $data['page_title'] = 'Edit Static Block';
        $data['row'] = StaticBlock::find($id);                

        return view('admin.static_block.edit', $data);
    }

    function postUpdateSave($id, Request $request)
    {
      // if (!AdminHelper::isUpdate()) {
      //   return redirect(AdminHelper::adminPath())->withError('Sorry you do not have privilege to access this area !');
      // }
      $request->validate([
            'title' => 'required|string|max:250|min:2',
            'content' => 'string|min:2|nullable|max:3000',
            'image' => 'image|max:2000|nullable',
            'status' => 'required',            
        ]);

        $StaticBlock = StaticBlock::find($id);
        $page_image = '';
        if ($request->hasFile('image')) {
            if(!empty($StaticBlock->image) && (\Storage::exists($StaticBlock->image) || file_exists(public_path($StaticBlock->image)))){
                //$file = public_path($file);
                unlink(public_path($StaticBlock->image));
            }
            $image = $request->file('image');
            $name = time().rand().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('uploads/images/static_blocks/');
            $image->move($destinationPath, $name);
            $StaticBlock->image = 'uploads/images/static_blocks/'.$name;
        }

        if ($request->hasFile('image2')) {
            if(!empty($StaticBlock->image2) && (\Storage::exists($StaticBlock->image2) || file_exists(public_path($StaticBlock->image2)))){
                //$file = public_path($file);
                unlink(public_path($StaticBlock->image2));
            }
            $image2 = $request->file('image2');
            $name2 = time().rand().'.'.$image2->getClientOriginalExtension();
            $destinationPath = public_path('uploads/images/static_blocks/');
            $image2->move($destinationPath, $name2);
            $StaticBlock->image2 = 'uploads/images/static_blocks/'.$name2;
        }
        
        $StaticBlock->page_title = $request->input('title');
        $StaticBlock->page_content = $request->input('content');
        $StaticBlock->status = $request->input('status');             
        $StaticBlock->updated_at = date('Y-m-d H:i:s');       
        $StaticBlock->save();

        $return_url = (!empty($request->input('return_url'))?$request->input('return_url'):route('getStaticBlock'));
        return redirect($return_url)->withSuccess('StaticBlock updated successfully!');
    }

    function getDetail($id)
    {
        $data = [];
        $data['page_title'] = 'Static Block Details';
        $data['row'] = StaticBlock::find($id);
        //$data['sellers'] = DB::table('admin_users')->where('id',$data['row']->seller_id)->first();

        return view('admin.static_block.detail', $data);
    }

    // function getDelete($id)
    // {
    //     if (!AdminHelper::isDelete()) {
    //         return redirect(AdminHelper::adminPath())->withError('Sorry you do not have privilege to access this area !');
    //     }

    //     if(!empty($id))
    //     {
    //         StaticBlock::where('id',$id)->delete();
    //         return redirect()->back()->withSuccess('StaticBlock deleted successfully!');
    //     }
    // }
}