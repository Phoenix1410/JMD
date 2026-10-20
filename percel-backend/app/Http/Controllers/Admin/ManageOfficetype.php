<?php

namespace App\Http\Controllers\Admin;

use AdminHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller;

class ManageOfficetype extends Controller
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

    $data = [];
    $data['page_title'] = 'Manage Office Types';

    $limit = $request->get('limit') ?? 20;
    $q = $request->get('q');

    $query = DB::table('office_types');

    if ($q) {
        $query->where('type_name', 'like', "%$q%");
    }

    $query->orderBy('id', 'desc');

    $data['rows'] = $query->paginate($limit);
    $data['limit'] = $limit;   // ✅ THIS WAS MISSING

    return view('admin.officetype.index', $data);
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

        $data['page_title'] = 'Add Office Type';

        return view('admin.officetype.add', $data);
    }


    // ==========================================
    // SAVE NEW OFFICE TYPE
    // ==========================================
    public function postAddSave(Request $request)
    {
        // if (!AdminHelper::isCreate()) {
        //     dd(AdminHelper::isCreate());
        //     return redirect(AdminHelper::adminPath())
        //         ->withError('Sorry you do not have privilege to access this area!');
        // }

        $request->validate([
            'type_name' => 'required|max:150',
            'status'    => 'required|in:0,1'
        ]);

        DB::table('office_types')->insert([
            'type_name' => $request->type_name,
            'status'    => $request->status,
            'created_at'=> now(),
            'updated_at'=> now()
        ]);

        return redirect()
            ->route('officetype')
            ->withSuccess('Office Type added successfully!');
    }


    // ==========================================
    // DETAIL PAGE
    // ==========================================
    public function getDetail($id)
    {
        if (!AdminHelper::isView()) {
            return redirect(AdminHelper::adminPath())
                ->withError('Sorry you do not have privilege to access this area!');
        }

        $data['page_title'] = 'Office Type Detail';

        $data['row'] = DB::table('office_types')
            ->where('id', $id)
            ->first();

        if (!$data['row']) {
            return redirect()->back()->withError('Record not found!');
        }

        return view('admin.officetype.detail', $data);
    }


    // ==========================================
    // EDIT PAGE
    // ==========================================
    public function getEdit($id)
    {
        if (!AdminHelper::isUpdate()) {
            return redirect(AdminHelper::adminPath())
                ->withError('Sorry you do not have privilege to access this area!');
        }

        $data['page_title'] = 'Edit Office Type';

        $data['row'] = DB::table('office_types')
            ->where('id', $id)
            ->first();

        if (!$data['row']) {
            return redirect()->back()->withError('Record not found!');
        }

        return view('admin.officetype.edit', $data);
    }


    // ==========================================
    // UPDATE OFFICE TYPE
    // ==========================================
    public function postUpdateSave(Request $request, $id)
    {
        // if (!AdminHelper::isUpdate()) {
        //     return redirect(AdminHelper::adminPath())
        //         ->withError('Sorry you do not have privilege to access this area!');
        // }

        $request->validate([
            'type_name' => 'required|max:150',
            'status'    => 'required|in:0,1'
        ]);

        DB::table('office_types')
            ->where('id', $id)
            ->update([
                'type_name' => $request->type_name,
                'status'    => $request->status,
                'updated_at'=> now()
            ]);

        return redirect()
            ->route('officetype')
            ->withSuccess('Office Type updated successfully!');
    }


    // ==========================================
    // DELETE
    // ==========================================
    public function getDelete($id)
    {
        if (!AdminHelper::isDelete()) {
            return redirect(AdminHelper::adminPath())
                ->withError('Sorry you do not have privilege to access this area!');
        }

        DB::table('office_types')->where('id', $id)->delete();

        return redirect()
            ->route('officetype')
            ->withSuccess('Office Type deleted successfully!');
    }
}