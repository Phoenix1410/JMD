<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;
use AdminHelper;

class ManageCountry extends Controller
{
    function getIndex()
    {      
        if (!AdminHelper::isView()) {
            return redirect(AdminHelper::adminPath())->withError('Sorry you do not have privilege to access this area !');
        }
        $request = request();
        $data = [];
        $data['page_title'] = 'Manage Country';

        $data['limit'] = $limit = (!empty($request->get('limit'))?$request->get('limit'):20);
        $q = $request->get('q');

        $filter_clumn = (!empty($request->get('filter_column'))?$request->get('filter_column'):'created_at');
        $sorting = (!empty($request->get('sorting'))?$request->get('sorting'):'desc');
        $data['rows'] = Country::when($q, function($query) use ($q){                           
                            $query->whereRaw("( country_name like '%".$q."%')");
                        })->orderBy($filter_clumn,$sorting)->paginate($limit);
        
            
        return view('admin.country.index', $data);
    }

    function getAdd()
    {
        if (!AdminHelper::isCreate()) {
            return redirect(AdminHelper::adminPath())->withError('Sorry you do not have privilege to access this area !');
        }
        $data = [];
        $data['page_title'] = 'Add Country';        
        return view('admin.country.add', $data);
    }

    function postAddSave(Request $request)
    {
        if (!AdminHelper::isCreate()) {
            return redirect(AdminHelper::adminPath())->withError('Sorry you do not have privilege to access this area !');
        }
        $request->validate([
            'country_name' => 'required|string|max:100|unique:countries',
            'currency' => 'required|string|max:20',
            'currency_symbol' => 'required|string|max:10',
            'status' => 'required|numeric'
        ]);

        Country::insert([
            'country_name' => $request->input('country_name'),
            'currency' => $request->input('currency'),
            'currency_symbol' => $request->input('currency_symbol'),
            'country_status' => $request->input('status'),            
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        $return_url = (!empty($request->input('return_url'))?$request->input('return_url'):AdminHelper::adminPath('admin').'/banner');
        if($request->input('submit')=='Save')
        {
            return redirect($return_url)->withSuccess('Country added successfully!');
        }else{
            return redirect()->back()->withSuccess('Country added successfully!');
        }
    }

    function getDetail($id)
    {
        if (!AdminHelper::isRead()) {
            return redirect(AdminHelper::adminPath())->withError('Sorry you do not have privilege to access this area !');
        }
        $data = [];
        $data['page_title'] = 'Country Details';
        $data['row'] = Country::find($id);

        return view('admin.country.detail', $data);
    }

    function getEdit($id)
    {
        if (!AdminHelper::isUpdate()) {
            return redirect(AdminHelper::adminPath())->withError('Sorry you do not have privilege to access this area !');
        }
        $data = [];
        $data['page_title'] = 'Edit Country';
        $data['row'] = Country::find($id);

        return view('admin.country.edit', $data);
    }

    function postUpdateSave($id, Request $request)
    {
        if (!AdminHelper::isUpdate()) {
            return redirect(AdminHelper::adminPath())->withError('Sorry you do not have privilege to access this area !');
        }
        $request->validate([
            'country_name' => 'required|string|max:100|unique:countries,country_name,'.$id,
            'currency' => 'required|string|max:20',
            'currency_symbol' => 'required|string|max:10',
            'status' => 'required|numeric'
        ]);

        $data = Country::find($id);

        $data->country_name = $request->input('country_name');
        $data->currency = $request->input('currency');
        $data->currency_symbol = $request->input('currency_symbol');
        $data->country_status = $request->input('status');        
        $data->updated_at = date('Y-m-d H:i:s');
        $data->save();

        $return_url = (!empty($request->input('return_url'))?$request->input('return_url'):AdminHelper::adminPath('admin').'/banner');
        return redirect($return_url)->withSuccess('Country updated successfully!');
    }

    function getDelete($id)
    {
        if (!AdminHelper::isDelete()) {
            return redirect(AdminHelper::adminPath())->withError('Sorry you do not have privilege to access this area !');
        }
        if(!empty($id))
        {
            if(\App\Models\City::where('country_id', $id)->exists())
            {
                return redirect()->back()->withError('This country cannot be deleted. A city has been assigned to this country, please delete the city first');
            }
            Country::find($id)->delete();
            return redirect()->back()->withSuccess('Country deleted successfully!');
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
        //     Country::whereIn('id', $id_selected)->update(['is_delete' => 1]);;

        //     AdminHelper::insertLog("Deleted data ".implode(',', $id_selected)." by ".AdminHelper::myName()." ip: ".$request->ip());            

        //     $message = "The selected data deleted successfully !";

        //     return redirect()->back()->withSuccess($message);
        // }  

        if($button_name == 'active')      
        {
            Country::whereIn('id', $id_selected)->update(['country_status'=>'1', 'updated_at'=>date('Y-m-d H:i:s')]);

            AdminHelper::insertLog("Updated data ".implode(',', $id_selected)." by ".AdminHelper::myName()." ip: ".$request->ip()); 

            $message = "The selected data activated successfully !";
            return redirect()->back()->withSuccess($message);
        }

        if($button_name == 'inactive')      
        {
            Country::whereIn('id', $id_selected)->update(['country_status'=>'0', 'updated_at'=>date('Y-m-d H:i:s')]);

            AdminHelper::insertLog("Updated data ".implode(',', $id_selected)." by ".AdminHelper::myName()." ip: ".$request->ip()); 

            $message = "The selected data inactivated successfully !";
            return redirect()->back()->withSuccess($message);
        }

        return redirect()->back()->withError($message);
    }
}
