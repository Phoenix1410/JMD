<?php

namespace App\Http\Controllers\Admin;

use AdminHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller;
use App\Models\City;

class ManageOffice extends Controller
{

    // ==========================================
    // LIST PAGE
    // ==========================================
    public function getIndex(Request $request)
    {
        if (!AdminHelper::isView()) {
            return redirect(AdminHelper::adminPath())
                ->withError('Sorry you do not have privilege to access this area!');
        }

        $data['page_title'] = 'Manage Offices';

        $limit = $request->get('limit') ?? 20;
        $q = $request->get('q');

        $query = DB::table('offices as o')
            ->leftJoin('office_types as ot', 'ot.id', '=', 'o.office_type_id')
            ->leftJoin('states as s','s.id','=','o.state')
            ->leftJoin('cities as c','c.id','=','o.city')
            ->select('o.*','s.name as state','c.name as city', 'ot.type_name');

        if ($q) {
            $query->where(function ($sub) use ($q) {
                $sub->where('o.office_name', 'like', "%$q%")
                    ->orWhere('ot.type_name', 'like', "%$q%")
                    ->orWhere('o.city', 'like', "%$q%");
            });
        }

        $query->orderBy('o.id', 'desc');

        $data['rows'] = $query->paginate($limit);
        $data['limit'] = $limit;

        return view('admin.office.index', $data);
    }


    // ==========================================
    // ADD PAGE
    // ==========================================
    public function getAdd()
    {
        if (!AdminHelper::isCreate()) {
            return redirect(AdminHelper::adminPath())
                ->withError('Sorry you do not have privilege to access this area!');
        }

        $data['page_title'] = 'Add Office';
        $data['office_types'] = DB::table('office_types')
            ->where('status', "1")
            ->get();
        $data['states']= DB::table('states')->where('country_id',101)->get();
        // dd( $data['states']);
        return view('admin.office.add', $data);
    }
    public function getCityByState(Request $request)
{
    $cities = DB::table('cities')
        ->where('state_id', $request->state_id)
        ->where('status', 1)
        ->orderBy('name', 'asc')
        ->get();

    $html = '<option value="">-- Select City --</option>';

    foreach ($cities as $city) {
        $html .= '<option value="'.$city->id.'">'.$city->name.'</option>';
    }

    return $html;
}

    // ==========================================
    // SAVE NEW OFFICE
    // ==========================================
    public function postAddSave(Request $request)
    {
        $request->validate([
            'office_type_id' => 'required|exists:office_types,id',
            'office_name'    => 'required|max:150',
            'address'        => 'required',
            'status'         => 'required|in:0,1'
        ]);

        DB::table('offices')->insert([
            'office_type_id' => $request->office_type_id,
            'office_name'    => $request->office_name,
            'address'        => $request->address,
            'city'           => $request->city_id,
            'state'          => $request->state_id,
            'country'        => $request->country ?? 'India',
            'pincode'        => $request->pincode,
            'phone'          => $request->phone,
            'email'          => $request->email,
            'sort'           => $request->sort ?? 0,
            'status'         => $request->status,
            'created_at'     => now(),
            'updated_at'     => now()
        ]);

        return redirect()
            ->route('office')
            ->withSuccess('Office added successfully!');
    }


    // ==========================================
    // DETAIL PAGE
    // ==========================================
   public function getDetail($id)
{
    $data['page_title'] = 'Office Detail';

    $data['row'] = DB::table('offices as o')
        ->leftJoin('office_types as ot', 'ot.id', '=', 'o.office_type_id')
        ->leftJoin('states as s', 's.id', '=', 'o.state')
        ->leftJoin('cities as c', 'c.id', '=', 'o.city')
        ->select(
            'o.*',
            'ot.type_name',
            's.name as state_name',
            'c.name as city_name'
        )
        ->where('o.id', $id)
        ->first();

    if (!$data['row']) {
        return redirect()->back()->withError('Record not found!');
    }

    return view('admin.office.detail', $data);
}

    // ==========================================
    // EDIT PAGE
    // ==========================================
   public function getEdit($id)
{
    $data['page_title'] = 'Edit Office';

    $data['row'] = DB::table('offices')
        ->where('id', $id)
        ->first();

    if (!$data['row']) {
        return redirect()->back()->withError('Record not found!');
    }

    $data['office_types'] = DB::table('office_types')
        ->where('status', '1')
        ->orderBy('type_name')
        ->get();

    // Load States
    $data['states'] = DB::table('states')
        ->where('country_id', 101)
        ->where('status', 1)
        ->orderBy('name')
        ->get();

    // Load Cities of selected state
    $data['cities'] = DB::table('cities')
        ->where('state_id', $data['row']->state)
        ->where('status', 1)
        ->orderBy('name')
        ->get();

    return view('admin.office.edit', $data);
}


    // ==========================================
    // UPDATE OFFICE
    // ==========================================
    public function postUpdateSave(Request $request, $id)
    {
        $request->validate([
            'office_type_id' => 'required|exists:office_types,id',
            'office_name'    => 'required|max:150',
            'address'        => 'required',
            'status'         => 'required|in:0,1'
        ]);

        DB::table('offices')
            ->where('id', $id)
            ->update([
                'office_type_id' => $request->office_type_id,
                'office_name'    => $request->office_name,
                'address'        => $request->address,
                'city'           => $request->city_id,
                'state'          => $request->state_id,
                'country'        => $request->country ?? 'India',
                'pincode'        => $request->pincode,
                'phone'          => $request->phone,
                'email'          => $request->email,
                'sort'           => $request->sort ?? 0,
                'status'         => $request->status,
                'updated_at'     => now()
            ]);

        return redirect()
            ->route('office')
            ->withSuccess('Office updated successfully!');
    }


    // ==========================================
    // DELETE
    // ==========================================
    public function getDelete($id)
    {
        DB::table('offices')->where('id', $id)->delete();

        return redirect()
            ->route('office')
            ->withSuccess('Office deleted successfully!');
    }
}