<?php 
namespace App\Http\Controllers\Admin;

use AdminHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Session;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
use App\Models\State;
use Illuminate\Support\Facades\File;
use App\Models\Country;



class ManageStatesController extends Controller
{

   function getIndex()
{  
    if (!AdminHelper::isView()) {
        return redirect(AdminHelper::adminPath())
            ->withError('Sorry you do not have privilege to access this area !');
    }    

    $request = request();
    $data = [];

    $data['page_title'] = 'Manage State';
    $data['limit'] = $limit = (!empty($request->get('limit')) ? $request->get('limit') : 20);

    $q = $request->get('q');
    $filter_column = $request->get('filter_column');
    $sorting = $request->get('sorting');

    // ✅ Static country ID
    $static_country_id = 101;

    $query = DB::table('states')
        ->where('country_id', $static_country_id);

    // ✅ Search
    if (!empty($q)) {
        $query->where('name', 'LIKE', '%' . $q . '%');
    }

    // ✅ Sorting
    if (!empty($filter_column) && !empty($sorting)) {
        $query->orderBy($filter_column, $sorting);
    } else {
        $query->orderBy('name', 'asc');
    }

    $data['rows'] = $query->paginate($limit);

    // Since country is static, you don't need dynamic country list
    $data['countries'] = DB::table('countries')
        ->where('id', $static_country_id)
        ->orderBy('name', 'asc')
        ->get();

    $base_url = AdminHelper::adminpath().'/manage-states';
    $page_num = request()->get('page');

    $data['ret_url'] = $page_num 
        ? $base_url.'?page='.$page_num
        : $base_url;

    return view('admin.states.index', $data);
}


function getEdit($id)
{
    if (!AdminHelper::isUpdate()) {
        return redirect(AdminHelper::adminPath())
            ->withError('Sorry you do not have privilege to access this area !');
    }

    $data = [];
    $data['page_title'] = 'Edit State';

    // ✅ Get state row
    $data['row'] = DB::table('states')
        ->where('id', $id)
        ->first();

    // ✅ Static country (only ID 101)
    $data['country'] = DB::table('countries')
        ->where('id', 101)
        // ->where('status', 1)
        ->get();

    // Optional safety: if state not found
    if (!$data['row']) {
        return redirect(AdminHelper::adminPath().'/manage-states')
            ->withError('State not found.');
    }

    return view('admin.states.edit', $data);
}

public function postUpdateSave($id, Request $request)
{
    $request->validate([
        'name'   => 'required|max:30|min:2|string',
        'status' => 'required|numeric',
        'image'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
    ]);

    // ✅ Get existing record
    $data = DB::table('states')->where('id', $id)->first();

    if (!$data) {
        return redirect()->back()->withError('State not found.');
    }

    $updateData = [
        'name'       => $request->input('name'),
        'status'     => $request->input('status'),
        'updated_at' => now(),
    ];

    // ===============================
    // IMAGE UPLOAD
    // ===============================
    if ($request->hasFile('image')) {

        // Delete old image if exists
        if (!empty($data->image) && File::exists(public_path('uploads/states/' . $data->image))) {
            File::delete(public_path('uploads/states/' . $data->image));
        }

        $file = $request->file('image');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('uploads/states'), $filename);

        $updateData['image'] = $filename;
    }

    // ✅ Update record
    DB::table('states')
        ->where('id', $id)
        ->update($updateData);

    $return_url = (!empty($request->input('return_url'))
        ? $request->input('return_url')
        : route('getStates'));

    return redirect($return_url)->withSuccess('State updated successfully!');
}
function getDetail($id)
{
    if (!AdminHelper::isRead()) {
        return redirect(AdminHelper::adminPath())
            ->withError('Sorry you do not have privilege to access this area !');
    }

    $data = [];
    $data['page_title'] = 'Details State';

    // ✅ Get state record
    $data['row'] = DB::table('states')
        ->where('id', $id)
        ->first();

    // Safety check
    if (!$data['row']) {
        return redirect(AdminHelper::adminPath().'/manage-states')
            ->withError('State not found.');
    }

    // ✅ Get country record
    $data['country'] = DB::table('countries')
        ->where('id', $data['row']->country_id)
        ->first();

    return view('admin.states.detail', $data);
}

    function getDelete($id)
    {
        if (!AdminHelper::isDelete()) {
            return redirect(AdminHelper::adminPath())->withError('Sorry you do not have privilege to access this area !');
        }
        /*if(!empty($id))
        {
            $data = Homeopath::find($id);
            $data->is_delete = 1;
            $data->save();
            return redirect()->back()->withSuccess('Homeopath deleted successfully!');
        }*/
      if(!empty($id))
        {
             $check_allocations_state = AdminHelper::check_state_allocations($id);
             //$check_allocations_state = 0;
            
            if($check_allocations_state==0)
            {
             return redirect()->back()->withError('State can not be deleted because of alloaction!');
             exit;
            }
            
            $state_dtls = State::where('id',$id)->first();
            if(!empty($state_dtls))
            {
                $state_dtls->delete();
                return redirect()->back()->withSuccess('State deleted successfully!');
            }
            else
            {
                return redirect()->back()->withError('Sorry!! some error occured.');
            }
            

            
        }
    }

    public function postActionSelected(Request $request)
    {        
        $id_selected = $request->input('checkbox');
        $button_name = $request->input('button_name');
        $message = "No action taken";
        if (empty($id_selected)) {
            AdminHelper::redirect($_SERVER['HTTP_REFERER'], 'Please select at least one data!', 'warning');
        }

        /*if ($button_name == 'delete') {  
            Homeopath::whereIn('id', $id_selected)->update(['is_delete' => 1]);;

            AdminHelper::insertLog("Deleted data ".implode(',', $id_selected)." by ".AdminHelper::myName()." ip: ".$request->ip());            

            $message = "The selected data deleted successfully !";

            return redirect()->back()->withSuccess($message);
        } */ 

        if($button_name == 'active')      
        {
            State::whereIn('id', $id_selected)->update(['status'=>'1', 'updated_at'=>date('Y-m-d H:i:s')]);

            AdminHelper::insertLog("Updated data ".implode(',', $id_selected)." by ".AdminHelper::myName()." ip: ".$request->ip()); 

            $message = "The selected data activated successfully !";
            return redirect()->back()->withSuccess($message);
        }

        if($button_name == 'inactive')      
        {
            State::whereIn('id', $id_selected)->update(['status'=>'0', 'updated_at'=>date('Y-m-d H:i:s')]);

            AdminHelper::insertLog("Updated data ".implode(',', $id_selected)." by ".AdminHelper::myName()." ip: ".$request->ip()); 

            $message = "The selected data inactivated successfully !";
            return redirect()->back()->withSuccess($message);
        }

        return redirect()->back()->withError($message);
    }
    public function changeStatus(Request $request) {
        $request->validate([
            'id' => 'required',
            'status' => 'required|boolean'
        ]);

        $data = DB::table('states')->where('id', $request->input('id'))->first();
        if (!$data || $data->image == null) {
            return redirect()->back()->withError('State image is missing.');
        }
        $updateData = [
        'status'     => $request->input('status'),
        'updated_at' => now(),
    ];
     DB::table('states')
        ->where('id', $request->input('id'))
        ->update($updateData);

         return redirect()->back()->withSuccess('Status Updated successfully!');
    }
}