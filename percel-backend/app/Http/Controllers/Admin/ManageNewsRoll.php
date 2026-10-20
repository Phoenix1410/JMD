<?php 
namespace App\Http\Controllers\Admin;

use App\Helpers\AdminHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller;

class ManageNewsRoll extends Controller
{
    function getIndex()
    {      
        $request = request();
        $data = []; 
        $data['page_title'] = 'News Rolls';
        $data['limit'] = $limit = ($request->get('limit') ?? 20);
        $q = $request->get('q');
        $filter_column = $request->get('filter_column');
        $sorting = $request->get('sorting') ?? 'desc';

        $query = DB::table('news');

        if ($q) {
            $query->where(function($sub) use ($q){
                $sub->where('heading', 'like', "%$q%")
                    ->orWhere('author_name', 'like', "%$q%");
            });
        }

        if ($filter_column) {
            $query->orderBy($filter_column, $sorting);
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $data['rows'] = $query->paginate($limit);

        return view('admin.newsroll.index', $data);
    }

    function getAdd()
    {
        return view('admin.newsroll.add', [
            'page_title' => 'Add News Roll'
        ]);
    }

    function postAddSave(Request $request)
    {
        $request->validate([
            'heading'      => 'required|string|max:255',
            'content'      => 'required|string',
            'status'       => 'required|in:0,1',
            'sort'         => 'nullable|integer|min:0',
            'image'        => 'required|image|max:5000', 
            // 'mobileimage'  => 'image|mimes:jpeg,jpg,png,gif,svg|max:5000',
            'meta_title'   => 'nullable|string|max:255',
            'author_name'  => 'nullable|string|max:150',
        ]);
        $featured_image = '';
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = 'featured-image-'.time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('admin/uploads/images/newsroll/');
            $image->move($destinationPath, $name);
            $featured_image = 'admin/uploads/images/newsroll/'.$name;
        }
        // $mobile_image = '';
        // if ($request->hasFile('mobileimage')) {
        //     $image = $request->file('mobileimage');
        //     $name = 'featured-mobileimage-'.time().'.'.$image->getClientOriginalExtension();
        //     $destinationPath = public_path('admin/uploads/mobileimage/newsroll/');
        //     $image->move($destinationPath, $name);
        //     $featured_image = 'admin/uploads/mobileimage/newsroll/'.$name;
        // }
        DB::table('news')->insert([
            'heading'      => $request->heading,
            'content'      => $request->content,
            'status'       => $request->status,
            'sort'         => $request->sort ?? 0,
            'meta_title'   => $request->meta_title,
            'image'        => $featured_image,
            // 'mobileimage'  => $mobile_image,
            'author_name'  => $request->author_name,
            'created_at'   => now(),
            'updated_at'   => now(),
        ]);

        return redirect(AdminHelper::adminPath().'/Newsletter')
            ->withSuccess('News added successfully!');
    }

    function getDetail($id)
    {
        $data['page_title'] = 'News Details';
        $data['row'] = DB::table('news')->where('id', $id)->first();

        return view('admin.newsroll.detail', $data);
    }

    function getEdit($id)
    {
        $data['page_title'] = 'Edit News Roll';
        $data['row'] = DB::table('news')->where('id', $id)->first();

        return view('admin.newsroll.edit', $data);
    }

    function postUpdateSave($id, Request $request)
    {
        // dd($request);
        $request->validate([
            'heading'      => 'required|string|max:255',
            'content'      => 'required|string',
            'status'       => 'required|in:0,1',
            'sort'         => 'nullable|integer|min:0',
            'image'        => 'image|max:5000', 
            // 'mobileimage'  => 'image|mimes:jpeg,jpg,png,gif,svg|max:5000',
            'meta_title'   => 'nullable|string|max:255',
            'author_name'  => 'nullable|string|max:150',
        ]);
        $featured_image = '';
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = 'featured-image-'.time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('admin/uploads/images/newsroll/');
            $image->move($destinationPath, $name);
            $featured_image = 'admin/uploads/images/newsroll/'.$name;
        }
        // $mobile_image = '';
        // if ($request->hasFile('mobileimage')) {
        //     $image = $request->file('mobileimage');
        //     $name = 'featured-mobileimage-'.time().'.'.$image->getClientOriginalExtension();
        //     $destinationPath = public_path('admin/uploads/mobileimage/newsroll/');
        //     $image->move($destinationPath, $name);
        //     $featured_image = 'admin/uploads/mobileimage/newsroll/'.$name;
        // }
        // dd($request->hasFile('image'));
        DB::table('news')->where('id', $id)->update([
            'heading'      => $request->heading,
            'content'      => $request->content,
            'status'       => $request->status,
            'sort'         => $request->sort ?? 0,
            'image'        => $featured_image,
            // 'mobileimage'  => $mobile_image,
            'meta_title'   => $request->meta_title,
            'author_name'  => $request->author_name,
            'updated_at'   => now(),
        ]);

        return redirect(AdminHelper::adminPath().'/Newsletter')
            ->withSuccess('News updated successfully!');
    }

    function getDelete($id)
    {
        DB::table('news')->where('id', $id)->delete();
        return redirect()->back()->withSuccess('News deleted successfully!');
    }

    public function postActionSelected(Request $request)
    {
        $ids = $request->checkbox;
        $action = $request->button_name;

        if (empty($ids)) {
            return redirect()->back()->withWarning('Please select at least one record!');
        }

        if ($action == 'delete') {
            DB::table('news')->whereIn('id', $ids)->delete();
            return redirect()->back()->withSuccess('Selected records deleted successfully!');
        }

        if ($action == 'active') {
            DB::table('news')->whereIn('id', $ids)
                ->update(['status' => 1, 'updated_at' => now()]);
            return redirect()->back()->withSuccess('Selected records activated!');
        }

        if ($action == 'inactive') {
            DB::table('news')->whereIn('id', $ids)
                ->update(['status' => 0, 'updated_at' => now()]);
            return redirect()->back()->withSuccess('Selected records inactivated!');
        }

        return redirect()->back()->withError('No action performed!');
    }
     public function changeStatus(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:services,id',
            'status' => 'required|boolean'
        ]);
            DB::table('news')
    ->where('id', $request->id)
    ->update(['status' => $request->status]);
        // $data = ManageTestimonial::findOrFail($request->id);
        // $data->status = $request->status;
        // $data->save();

        return redirect()->back()->withSuccess('Status updated successfully!');
    }
}