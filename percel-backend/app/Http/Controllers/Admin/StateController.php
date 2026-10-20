<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\State;
use App\Models\Country;

class StateController extends Controller
{
    /**
     * Display a listing of states
     */
    public function index()
    {
        $states = State::with('country')
            ->orderBy('id', 'desc')
            ->get();

        return view('admin.states.index', [
            'page_title' => 'Manage States',
            'states'     => $states
        ]);
    }

    /**
     * Show create form
     */
    public function create()
    {
        $countries = Country::where('status', 1)->get();

        return view('admin.states.create', [
            'page_title' => 'Add State',
            'countries'  => $countries
        ]);
    }

    /**
     * Store new state
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'       => 'required|string|max:255',
            'country_id' => 'required|exists:countries,id',
            'status'     => 'required|in:0,1',
            'image'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $image_path = '';

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = 'state-'.time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('uploads/states/');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $image->move($destinationPath, $name);
            $image_path = 'uploads/states/'.$name;
        }

        State::create([
            'name'       => $request->name,
            'country_id' => $request->country_id,
            'status'     => $request->status,
            'image'      => $image_path,
        ]);

        return redirect()->route('managestates')
            ->with('success', 'State added successfully.');
    }

    /**
     * Show state details
     */
    public function show($id)
    {
        $state = State::with('country')->findOrFail($id);

        return view('admin.states.show', [
            'page_title' => 'State Details',
            'state'      => $state
        ]);
    }

    /**
     * Show edit form
     */
    public function edit($id)
    {
        $state = State::findOrFail($id);
        $countries = Country::where('status', 1)->get();

        return view('admin.states.edit', [
            'page_title' => 'Edit State',
            'state'      => $state,
            'countries'  => $countries
        ]);
    }

    /**
     * Update state
     */
    public function update(Request $request, $id)
    {
        $state = State::findOrFail($id);

        $request->validate([
            'name'       => 'required|string|max:255',
            'country_id' => 'required|exists:countries,id',
            'status'     => 'required|in:0,1',
            'image'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $image_path = $state->image;

        if ($request->hasFile('image')) {

            // delete old image
            if ($state->image && file_exists(public_path($state->image))) {
                unlink(public_path($state->image));
            }

            $image = $request->file('image');
            $name = 'state-'.time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('uploads/states/');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $image->move($destinationPath, $name);
            $image_path = 'uploads/states/'.$name;
        }

        $state->update([
            'name'       => $request->name,
            'country_id' => $request->country_id,
            'status'     => $request->status,
            'image'      => $image_path,
        ]);

        return redirect()->route('managestates')
            ->with('success', 'State updated successfully.');
    }

    /**
     * Delete state
     */
    public function destroy($id)
    {
        $state = State::findOrFail($id);

        if ($state->image && file_exists(public_path($state->image))) {
            unlink(public_path($state->image));
        }

        $state->delete();

        return redirect()->route('managestates')
            ->with('success', 'State deleted successfully.');
    }
}