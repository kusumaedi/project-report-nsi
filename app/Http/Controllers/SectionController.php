<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $section = Section::with('department')->where('del', 'N')->get();
        return view('admin.section.index', compact('section'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $department = Department::select('id', 'name')->get();
        return view('admin.section.create', compact('department'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'department_id' => 'required',
        ]);

        Section::create($request->all());
        return to_route('section.index')->with('success','Place created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Section $section
     * @return \Illuminate\Http\Response
     */
    public function show(Section $section)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Section $section
     * @return \Illuminate\Http\Response
     */
    public function edit(Section $section)
    {
        $department = Department::select('id', 'name')->get();
        return view('admin.section.edit', compact('section', 'department'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Section $section
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Section $section)
    {
        $request->validate([
            'name' => 'required',
            'department_id' => 'required',
        ]);

        $section->update($request->all());
        return to_route('section.index')->with('success','Place updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Section $section
     * @return \Illuminate\Http\Response
     */
    public function destroy(Section $section)
    {
        // $section->delete();
        $section->update(['del' => 'Y']);
        return to_route('section.index')->with('success', 'Place deleted successfully');
    }
}
