<?php

namespace App\Http\Controllers\Admin;

use AdminHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller;
use App\Models\State;

class ManageBranches extends Controller
{

    // ==========================================
    // LIST PAGE
    // ==========================================
    public function getIndex(Request $request)
    {
        // dd($request);
        if (!AdminHelper::isView()) {
            return redirect(AdminHelper::adminPath())
                ->withError('Sorry you do not have privilege to access this area!');
        }

        $data['page_title'] = 'Manage Branches';

        $limit = $request->get('limit') ?? 20;
        $q = $request->get('q');

        $query = DB::table('branch as b')
            ->leftJoin('states as s', 's.id', '=', 'b.state')
            ->select(
                'b.*',
                's.name as state_name',
            );

        if ($q) {
            $query->where(function ($sub) use ($q) {
                $sub->where('b.branch_name', 'like', "%$q%")
                    ->orwhere('b.address','like',"%$q%")
                    ->orWhere('b.phone', 'like', "%$q%")
                    ->orwhere('b.branch_code','like',"%$q%")
                    ->orWhere('b.email_address', 'like', "%$q%");
            });
        }
        if($request->state_id){
            $query->where('b.state',$request->state_id);
        }
        $filter_column = $request->get('filter_column', 'b.id');
        $sorting = $request->get('sorting', 'desc');
        $query->orderBy($filter_column, $sorting);
        $data['states'] = DB::table('states')
        ->where('country_id',101)
        ->where('status',1)
        ->orderBy('name')
        ->get();
         $data['selectedstate']=DB::table('states')
        ->where('country_id',101)
        ->where('id',$request->state_id)
        ->where('status',1)
        ->orderBy('name')
        ->first();
        $data['rows'] = $query->paginate($limit);
        $data['limit'] = $limit;

        return view('admin.branches.index', $data);
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

        $data['page_title'] = 'Add Branch';

        $data['states'] = DB::table('states')
            ->where('country_id', 101)
            ->where('status', 1)
            ->orderBy('name')
            ->get();

        return view('admin.branches.add', $data);
    }

    // ==========================================
    // SAVE NEW BRANCH
    // ==========================================
 public function postAddSave(Request $request)
{
    $request->validate([
        'branch_name'   => 'required|max:150',
        'address'       => 'required',
        'branch_id'     => 'required',
        'status'        => 'required|in:0,1',
        'state_id'      => 'required',
        'contactperson' => 'required'
    ]);

    // ✅ Insert and get ID
    $branchId = DB::table('branch')->insertGetId([
        'branch_name'   => $request->branch_name,
        'branch_code'   => $request->branch_id,
        'address'       => $request->address,
        'state'         => $request->state_id,
        'contact_person'=> $request->contactperson,
        'phone'         => $request->phone,
        'phone2'         => $request->phone2,
        'phone3'         => $request->phone3,
        'google_link'   => $request->google_link,
        'email_address' => $request->email,
        'sort'          => $request->sort ?? 0,
        'branch_type'     => $request->branch_type ?? null,
        'status'        => $request->status,
        'created_at'    => now(),
        'updated_at'    => now()
    ]);
    return redirect()
        ->route('managebranches')
        ->withSuccess('Branch added successfully!');
}
    // ==========================================
    // GET CITY BY STATE (AJAX)
    // ==========================================
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
    // DETAIL PAGE
    // ==========================================
    public function getDetail($id)
    {
        $data['page_title'] = 'Branch Detail';

        $data['row'] = DB::table('branch as b')
            ->leftJoin('states as s', 's.id', '=', 'b.state')
            ->select(
                'b.*',
                's.name as state_name',
            )
            ->where('b.id', $id)
            ->first();

        if (!$data['row']) {
            return redirect()->back()->withError('Record not found!');
        }

        return view('admin.branches.detail', $data);
    }

    // ==========================================
    // EDIT PAGE
    // ==========================================
    public function getEdit($id)
    {
        $data['page_title'] = 'Edit Branch';

        $data['row'] = DB::table('branch')
            ->where('id', $id)
            ->first();

        if (!$data['row']) {
            return redirect()->back()->withError('Record not found!');
        }

        $data['states'] = DB::table('states')
            ->where('country_id', 101)
            ->where('status', 1)
            ->orderBy('name')
            ->get();

        return view('admin.branches.edit', $data);
    }

    // ==========================================
    // UPDATE BRANCH
    // ==========================================
    public function postUpdateSave(Request $request, $id)
    {
        // dd($request->branch_type);
        $request->validate([
            'branch_name' => 'required|max:150',
            'address'     => 'required',
            'branch_id'     => 'required',
            'branch_type' => 'required',
            'status'      => 'required|in:0,1'
        ]);

        DB::table('branch')
            ->where('id', $id)
            ->update([
            'branch_name' => $request->branch_name,
            'branch_code'   => $request->branch_id,
            'address'     => $request->address,
            'state'    => $request->state_id,
            'contact_person'     => $request->contactperson ,
            'google_link'   => $request->google_link,
            'phone'       => $request->phone,
            'phone2'       => $request->phone2,
            'phone3'       => $request->phone3,
            'email_address'=> $request->email,
            'sort'        => $request->sort ?? 0,
            'branch_type' => $request->branch_type ,
            'status'      => $request->status,
            'updated_at'  => now()
            ]);

        return redirect()
            ->route('managebranches')
            ->withSuccess('Branch updated successfully!');
    }
public function uploadBranchCsv(Request $request)
{
    $request->validate([
        'state_id' => 'required',
        'csv_file' => 'required|mimes:csv,txt'
    ]);

    $file = $request->file('csv_file');
    $stateId = $request->state_id;

    $handle = fopen($file->getRealPath(), 'r');

    if ($handle === false) {
        return redirect()->back()->withError('Unable to read CSV file.');
    }

    $expectedHeader = [
        'Branch Code',
        'Branch Name',
        'Address',
        'Contact Person',
        'Phone',
        'Phone2',
        'Phone3',
        'google_link',
        'Email',
        'Branch Type'
    ];

    $header = array_map('trim', fgetcsv($handle));

    if ($header != $expectedHeader) {
        fclose($handle);
        return redirect()->back()->withError(
            'Invalid CSV format. Please download the sample CSV and upload again.'
        );
    }

    $rowNumber = 2;

    function cleanText($value)
    {
        if ($value === null) {
            return null;
        }

        $value = mb_convert_encoding($value, 'UTF-8', 'UTF-8, ISO-8859-1, Windows-1252');
        $value = str_replace("\xA0", " ", $value);
        $value = preg_replace("/[\r\n]+/", " ", $value);
        $value = preg_replace('/\s+/', ' ', $value);

        return trim($value);
    }

    $skippedRows = [];

    while (($row = fgetcsv($handle)) !== false) {

        if (count($row) < 8) {
            fclose($handle);
            return redirect()->back()
                ->withError("Invalid column count in row " . $rowNumber);
        }

        $branch_code     = cleanText($row[0]);
        $branch_name     = cleanText($row[1]);
        $address         = cleanText($row[2]);
        $contact_person  = cleanText($row[3]);
        $phone           = cleanText($row[4]);
        $phone2           = cleanText($row[5]);
        $phone3           = cleanText($row[6]);
        $google_link     = cleanText($row[7]);
        $email           = cleanText($row[8]);
        $branch_type     = cleanText($row[9]);

        if (!$branch_code || !$branch_name) {
            fclose($handle);
            return redirect()->back()
                ->withError("Branch Code or Branch Name missing in row " . $rowNumber);
        }

        // Check duplicate branch code
        $exists = DB::table('branch')
            ->where('branch_code', $branch_code)
            ->exists();

        if ($exists) {
            $skippedRows[] = $rowNumber;
            $rowNumber++;
            continue;
        }

        DB::table('branch')->insert([
            'branch_code'     => $branch_code,
            'branch_name'     => $branch_name,
            'address'         => $address,
            'contact_person'  => $contact_person,
            'phone'           => $phone,
            'phone2'           => $phone2,
            'phone3'           => $phone3,
            'google_link'     => $google_link,
            'email_address'   => $email,
            'branch_type'     => $branch_type,
            'state'           => $stateId,
            'status'          => "1",
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        $rowNumber++;
    }

    fclose($handle);

    $message = 'CSV Uploaded Successfully';

    if (!empty($skippedRows)) {
        $message .= '. Duplicate branch codes skipped at rows: ' . implode(', ', $skippedRows);
    }

    return redirect()
        ->route('managebranches')
        ->withSuccess($message);
}
    // Mange csv
    // public function uploadBranchCsv(Request $request)
    // {
    //     $request->validate([
    //         'state_id' => 'required',
    //         'csv_file' => 'required|mimes:csv,txt'
    //     ]);

    //     $file = $request->file('csv_file');
    //     $stateId = $request->state_id;

    //     $csv = array_map('str_getcsv', file($file));

    //     if(count($csv) <= 1){
    //         return redirect()->back()->withError('CSV file is empty.');
    //     }

    //     // Expected header
    //     $expectedHeader = [
    //         'Branch Code',
    //         'Branch Name',
    //         'Address',
    //         'Contact Person',
    //         'Phone',
    //         'Email'
    //     ];

    //     $header = array_map('trim', $csv[0]);

    //     // Validate header
    //     if ($header != $expectedHeader) {
    //         return redirect()->back()->withError(
    //             'Invalid CSV format. Please download the sample CSV and upload again.'
    //         );
    //     }

    //     unset($csv[0]); // remove header

    //         foreach ($csv as $index => $row) {

    //             if(count($row) < 6){
    //                 return redirect()->back()
    //                     ->withError("Invalid column count in row ".($index+2));
    //             }

    //             $branch_code = trim($row[0]);
    //             $branch_name = trim($row[1]);

    //             // Last columns
    //             $email = trim($row[count($row)-1]);
    //             $phone = trim($row[count($row)-2]);
    //             $contact_person = trim($row[count($row)-3]);

    //             // Address = everything between branch_name and contact_person
    //             $addressParts = array_slice($row, 2, count($row)-5);
    //             $address = trim(implode(',', $addressParts));

    //             // Required validation
    //             if(!$branch_code || !$branch_name){
    //                 return redirect()->back()
    //                     ->withError("Branch Code or Branch Name missing in row ".($index+2));
    //             }

    //             DB::table('branch')->insert([
    //                 'branch_code'   => $branch_code,
    //                 'branch_name'   => $branch_name,
    //                 'address'       => $address,
    //                 'contact_person'=> $contact_person,
    //                 'phone'         => $phone,
    //                 'email_address' => $email,
    //                 'state'         => $stateId,
    //                 'status'        => "1",
    //                 'created_at'    => now(),
    //                 'updated_at'    => now()
    //             ]);
    //         }

    //     return redirect()
    //         ->route('managebranches')
    //         ->withSuccess('CSV Uploaded Successfully');
    // }
    //download csv
    public function downloadBranchSample()
    {
        $fileName = "branch_sample.csv";

        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate",
        ];

        $columns = [
        'Branch Code',
        'Branch Name',
        'Address',
        'Contact Person',
        'Phone',
        'Phone2',
        'Phone3',
        'google_link',
        'Email',
        'Branch Type'
        ];

        $callback = function() use ($columns) {

            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            fputcsv($file, [
                '0001',
                'Mumbai Branch',
                'Mumbai Address',
                'John Doe',
                '9876543210',
                '9876543210',
                '9876543210',
                'https://www.google.com/maps/place/WebGuru+Infosystems/@22.5740507,88.4323657,16z/data=!3m1!4b1!4m6!3m5!1s0x3a0275af2faa0385:0x11ae681334ba7c9d!8m2!3d22.5740458!4d88.4349406!16s%2Fg%2F1hc2900gm?entry=ttu&g_ep=EgoyMDI2MDYyMy4wIKXMDSoASAFQAw%3D%3D',
                'branch@example.com',
                'Delivery'
            ]);

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
    // ==========================================
    // DELETE
    // ==========================================
    public function getDelete($id)
    {
        DB::table('branch')->where('id', $id)->delete();

        return redirect()
            ->route('managebranches')
            ->withSuccess('Branch deleted successfully!');
    }
    public function changeStatus(Request $request){
         DB::table('branch')
        ->where('id', $request->id)
            ->update([
                'status' => $request->status,
                'updated_at' => now()
            ]);
        // $data = Service::findOrFail($id);
        // $data->status = $request->status;
        // $data->save();

        return redirect()->back()->withSuccess('Status updated  successfully!');
    }
}