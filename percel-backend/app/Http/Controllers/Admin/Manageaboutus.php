<?php 
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Routing\Controller;

class Manageaboutus extends Controller{

    // 🔹 List all records
    public function getIndex(){
        $data = DB::table('about_content')->orderBy('id','desc')->get();
        return view('admin.aboutus.index', compact('data'));
    }

    // 🔹 Show Add Form
    public function getAdd(){
        return view('admin.aboutus.add');
    }

    // 🔹 Save New Record
  public function postAddSave(Request $request){

    // Upload Fleet Icon
    $fleet_icon = null;
    if ($request->hasFile('fleet_icon')) {
        $file = $request->file('fleet_icon');
        $name = 'fleet_'.time().'.'.$file->getClientOriginalExtension();
        $file->move(public_path('uploads/aboutus'), $name);
        $fleet_icon = 'uploads/aboutus/'.$name;
    }

    // Upload Network Icon
    $network_icon = null;
    if ($request->hasFile('network_icon')) {
        $file = $request->file('network_icon');
        $name = 'network_'.time().'.'.$file->getClientOriginalExtension();
        $file->move(public_path('uploads/aboutus'), $name);
        $network_icon = 'uploads/aboutus/'.$name;
    }

    // Upload Delivery Icon
    $delivery_icon = null;
    if ($request->hasFile('delivery_icon')) {
        $file = $request->file('delivery_icon');
        $name = 'delivery_'.time().'.'.$file->getClientOriginalExtension();
        $file->move(public_path('uploads/aboutus'), $name);
        $delivery_icon = 'uploads/aboutus/'.$name;
    }

    // Insert Data
    DB::table('about_content')->insert([
        'content' => $request->content,

        'fleet_icon' => $fleet_icon,
        'fleet_name' => $request->fleet_name,
        'fleet_content' => $request->fleet_content,

        'network_icon' => $network_icon,
        'network_name' => $request->network_name,
        'network_content' => $request->network_content,

        'delivery_icon' => $delivery_icon,
        'delivery_name' => $request->delivery_name,
        'delivery_content' => $request->delivery_content,

        'states_covered' => $request->states_covered,
        'branches' => $request->branches,
        'daily_shipments' => $request->daily_shipments,
        'years_experience' => $request->years_experience,

        'created_at' => now(),
        'updated_at' => now()
    ]);

    return redirect()->route('manageaboutus')->with('success', 'About Us added successfully');
}
    // 🔹 View Details
    public function getDetail($id){
        $data = DB::table('about_content')->where('id', $id)->first();
        return view('admin.aboutus.detail', compact('data'));
    }

    // 🔹 Show Edit Form
    public function getEdit(){
        $data = DB::table('about_content')->where('id',1)->first();
        return view('admin.aboutus.edit', compact('data'));
    }

    // 🔹 Update Record
public function postUpdateSave(Request $request){

    // ✅ Validation
    $request->validate([
        'content' => 'required',
        'fleet_icon' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        'network_icon' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        'delivery_icon' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
    ]);

    // Get existing data
    $data = DB::table('about_content')->where('id', 1)->first();

    // 🔹 Fleet Icon
    $fleet_icon = $data->fleet_icon;
    if ($request->hasFile('fleet_icon')) {
        $file = $request->file('fleet_icon');
        $name = 'fleet_'.time().'_'.rand(100,999).'.'.$file->getClientOriginalExtension();
        $file->move(public_path('uploads/aboutus'), $name);
        $fleet_icon = 'uploads/aboutus/'.$name;

        // Optional: delete old image
        if ($data->fleet_icon && file_exists(public_path($data->fleet_icon))) {
            unlink(public_path($data->fleet_icon));
        }
    }

    // 🔹 Network Icon
    $network_icon = $data->network_icon;
    if ($request->hasFile('network_icon')) {
        $file = $request->file('network_icon');
        $name = 'network_'.time().'_'.rand(100,999).'.'.$file->getClientOriginalExtension();
        $file->move(public_path('uploads/aboutus'), $name);
        $network_icon = 'uploads/aboutus/'.$name;

        if ($data->network_icon && file_exists(public_path($data->network_icon))) {
            unlink(public_path($data->network_icon));
        }
    }

    // 🔹 Delivery Icon
    $delivery_icon = $data->delivery_icon;
    if ($request->hasFile('delivery_icon')) {
        $file = $request->file('delivery_icon');
        $name = 'delivery_'.time().'_'.rand(100,999).'.'.$file->getClientOriginalExtension();
        $file->move(public_path('uploads/aboutus'), $name);
        $delivery_icon = 'uploads/aboutus/'.$name;

        if ($data->delivery_icon && file_exists(public_path($data->delivery_icon))) {
            unlink(public_path($data->delivery_icon));
        }
    }

    // ✅ Update Data
    DB::table('about_content')->where('id', 1)->update([
        'content' => $request->content,

        'fleet_icon' => $fleet_icon,
        'fleet_name' => $request->fleet_name,
        'fleet_content' => $request->fleet_content,

        'network_icon' => $network_icon,
        'network_name' => $request->network_name,
        'network_content' => $request->network_content,

        'delivery_icon' => $delivery_icon,
        'delivery_name' => $request->delivery_name,
        'delivery_content' => $request->delivery_content,

        'states_covered' => $request->states_covered,
        'branches' => $request->branches,
        'daily_shipments' => $request->daily_shipments,
        'years_experience' => $request->years_experience,

        'updated_at' => now()
    ]);

    return redirect()->route('manageaboutus')->with('success', 'About Us updated successfully');
}

    // 🔹 Delete Record
    public function getDelete($id){
        DB::table('about_content')->where('id', $id)->delete();

        return redirect()->route('manageaboutus')->with('success', 'About Us deleted successfully');
    }
}