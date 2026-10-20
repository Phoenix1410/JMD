<?php

namespace App\Http\Controllers\Admin;

use AdminHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller;

class ManageContactUs extends Controller
{
    // ===============================
    // LIST PAGE
    // ===============================
    public function getIndex(Request $request)
    {
        if (!AdminHelper::isView()) {
            return redirect(AdminHelper::adminPath())
                ->withError('Sorry you do not have privilege to access this area !');
        }
        $data = [];
        $data['page_title'] = 'Manage Contact Us';
        $limit = $request->get('limit') ?? 20;
        $q = $request->get('q');
        $query = DB::table('contact_us');
        if ($q) {
            $query->where(function ($sub) use ($q) {
                $sub->where('name', 'like', "%$q%")
                    ->orWhere('email', 'like', "%$q%")
                    ->orWhere('phone', 'like', "%$q%");
            });
        }
        $query->orderBy('created_at', 'desc');
        $data['rows'] = $query->paginate($limit);
        $data['limit']=$limit;
        return view('admin.contactus.index', $data);
    }
    // ===============================
    // DETAIL PAGE
    // ===============================
    public function getDetail($id)
    {
        if (!AdminHelper::isView()) {
            return redirect(AdminHelper::adminPath())
                ->withError('Sorry you do not have privilege to access this area !');
        }
        $data['page_title'] = 'Contact Details';
        $data['row'] = DB::table('contact_us')
            ->where('id', $id)
            ->first();
        if (!$data['row']) {
            return redirect()->back()->withError('Record not found!');
        }
        return view('admin.contactus.detail', $data);
    }
    // ===============================
    // UPDATE STATUS ONLY
    // ===============================
    public function postUpdateSave($id, Request $request)
    {
        // if (!AdminHelper::isUpdate()) {
        //     return redirect(AdminHelper::adminPath())
        //         ->withError('Sorry you do not have privilege to access this area !');
        // }
        $request->validate([
            'status' => 'required|in:0,1'
        ]);
        DB::table('contact_us')
            ->where('id', $id)
            ->update([
                'status' => $request->status,
                'updated_at' => now()
            ]);
        return redirect()
            ->route('managecontactus')
            ->withSuccess('Status updated successfully!');
    }
}