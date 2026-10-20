<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\City;
use AdminHelper;

class ManageCity extends Controller
{
    function getIndex()
    {      
        if (!AdminHelper::isView()) {
            return redirect(AdminHelper::adminPath())->withError('Sorry you do not have privilege to access this area !');
        }
        $request = request();
        $data = [];
        $data['page_title'] = 'Manage City';

        $data['limit'] = $limit = (!empty($request->get('limit'))?$request->get('limit'):20);
        $q = $request->get('q');

        $filter_clumn = (!empty($request->get('filter_column'))?$request->get('filter_column'):'created_at');
        $sorting = (!empty($request->get('sorting'))?$request->get('sorting'):'desc');
        $data['rows'] = City::when($q, function($query) use ($q){                           
                            $query->whereRaw("( city_name like '%".$q."%')");
                        })->orderBy($filter_clumn,$sorting)->paginate($limit);
        
            
        return view('admin.city.index', $data);
    }

    function getAdd()
    {
        if (!AdminHelper::isCreate()) {
            return redirect(AdminHelper::adminPath())->withError('Sorry you do not have privilege to access this area !');
        }
        $data = [];
        $data['page_title'] = 'Add City';
        $data['countries'] = Country::where('country_status', 1)->get();

        return view('admin.city.add', $data);
    }

    function postAddSave(Request $request)
    {
        if (!AdminHelper::isCreate()) {
            return redirect(AdminHelper::adminPath())->withError('Sorry you do not have privilege to access this area !');
        }
        $request->validate([
            'country_id' => 'required|numeric',
            'city_name' => 'required|string|max:100|unique:cities',
            'status' => 'required|numeric'
        ]);

        City::insert([
            'country_id' => $request->input('country_id'),
            'city_name' => $request->input('city_name'),
            'city_name_fr' => $request->input('city_name_fr'),
            'city_name_ar' => $request->input('city_name_ar'),
            'city_status' => $request->input('status'),            
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        $return_url = (!empty($request->input('return_url'))?$request->input('return_url'):AdminHelper::adminPath('admin').'/banner');
        if($request->input('submit')=='Save')
        {
            return redirect($return_url)->withSuccess('City added successfully!');
        }else{
            return redirect()->back()->withSuccess('City added successfully!');
        }
    }

    function getDetail($id)
    {
        if (!AdminHelper::isRead()) {
            return redirect(AdminHelper::adminPath())->withError('Sorry you do not have privilege to access this area !');
        }
        $data = [];
        $data['page_title'] = 'City Details';
        $data['row'] = City::find($id);

        return view('admin.city.detail', $data);
    }

    function getEdit($id)
    {
        if (!AdminHelper::isUpdate()) {
            return redirect(AdminHelper::adminPath())->withError('Sorry you do not have privilege to access this area !');
        }
        $data = [];
        $data['page_title'] = 'Edit City';
        $data['countries'] = Country::where('country_status', 1)->get();
        $data['row'] = City::find($id);

        return view('admin.city.edit', $data);
    }

    function postUpdateSave($id, Request $request)
    {
        if (!AdminHelper::isUpdate()) {
            return redirect(AdminHelper::adminPath())->withError('Sorry you do not have privilege to access this area !');
        }
        $request->validate([
            'country_id' => 'required|numeric',
            'city_name' => 'required|string|max:100|unique:cities,city_name,'.$id,
            'status' => 'required|numeric'
        ]);

        $data = City::find($id);

        $data->country_id = $request->input('country_id');
        $data->city_name = $request->input('city_name');
        $data->city_name_fr = $request->input('city_name_fr');
        $data->city_name_ar = $request->input('city_name_ar');
        $data->city_status = $request->input('status');        
        $data->updated_at = date('Y-m-d H:i:s');
        $data->save();

        $return_url = (!empty($request->input('return_url'))?$request->input('return_url'):AdminHelper::adminPath('admin').'/banner');
        return redirect($return_url)->withSuccess('City updated successfully!');
    }

    function getDelete($id)
    {
        if (!AdminHelper::isDelete()) {
            return redirect(AdminHelper::adminPath())->withError('Sorry you do not have privilege to access this area !');
        }
        if(!empty($id))
        {
            if(\App\Models\Company::where('city_id', $id)->exists())
            {
                return redirect()->back()->withError('This city cannot be deleted. A company has been assigned to this city, please delete the company first');
            }
            City::find($id)->delete();
            return redirect()->back()->withSuccess('City deleted successfully!');
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

        // if ($button_name == 'delete') {
        //     City::whereIn('id', $id_selected)->update(['is_delete' => 1]);;

        //     AdminHelper::insertLog("Deleted data ".implode(',', $id_selected)." by ".AdminHelper::myName()." ip: ".$request->ip());            

        //     $message = "The selected data deleted successfully !";

        //     return redirect()->back()->withSuccess($message);
        // }  

        if($button_name == 'active')      
        {
            City::whereIn('id', $id_selected)->update(['city_status'=>'1', 'updated_at'=>date('Y-m-d H:i:s')]);

            AdminHelper::insertLog("Updated data ".implode(',', $id_selected)." by ".AdminHelper::myName()." ip: ".$request->ip()); 

            $message = "The selected data activated successfully !";
            return redirect()->back()->withSuccess($message);
        }

        if($button_name == 'inactive')      
        {
            City::whereIn('id', $id_selected)->update(['city_status'=>'0', 'updated_at'=>date('Y-m-d H:i:s')]);

            AdminHelper::insertLog("Updated data ".implode(',', $id_selected)." by ".AdminHelper::myName()." ip: ".$request->ip()); 

            $message = "The selected data inactivated successfully !";
            return redirect()->back()->withSuccess($message);
        }

        return redirect()->back()->withError($message);
    }
}
