<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('activities.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'activity_name' => 'required',
            'round' => 'required',
            'file' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        if ($file = $request->file('file')) {
            $file_name =time().$file->getClientOriginalName();
            $file->move('uploads/activities', $file_name);
        }

        $mou_id = $request->input('mou_id');

        Activity::create([
            'mou_id' => $request->input('mou_id'),
            'activity_name' => $request->input('activity_name'),
            'round' => $request->input('round'),
            'file_path' => $file_name ?? null,
        ]);

        session()->flash('success', 'Activity created successfully.');

        return redirect()->to('mous/' . $mou_id);
        // return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Activity $activity)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Activity $activity)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Activity $activity)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Activity $activity)
    {
        //
    }
}
