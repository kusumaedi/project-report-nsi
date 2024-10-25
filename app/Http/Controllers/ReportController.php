<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Report;
use Illuminate\Http\Request;
use App\Models\ReportInstructor;
use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Section;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $department = Department::where('del', 'N')->get();
        if(request()->get('department_id') !=''){
            $section = $section = Section::where('del', 'N')->where('department_id', request()->get('department_id'))->get();
        } else {
            $section = [];
        }
        $report = Report::with('user')->where('user_id', auth()->user()->id)->filter(request(['department_id','section_id']))->get();
        return view('report.index', compact('report', 'department', 'section'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = User::select('id', 'name')->get();
        return view('report.create',compact('user'));
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
            'checker' => 'required',
            'shift' => 'required',
            'report_at' => 'required',
            'title' => 'required',
            'potential_dangerous_point' => 'required',
            'most_danger_point' => 'required',
            'keyword' => 'required',
            'attendant' => 'required',
        ]);

        $input = $request->except(['_token', 'submit']);

        $input['user_id'] = auth()->user()->id;
        $input['department_id'] = auth()->user()->department_id;
        $input['section_id'] = auth()->user()->section_id;
        $input['status'] = 'Submit';

        $report = Report::create($input);

        // dd($request->instructor);

        foreach ($request->instructor as $instructor){
            $report->instructors()->create([
                                'report_id' => $report->id,
                                'user_id' => (int) $instructor
                            ]);
        }

        return to_route('report.index')->with('success', 'New report successfully added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function show(Report $report)
    {
        $user = User::select('id', 'name')->get();
        return view('report.show',compact('report','user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function edit(Report $report)
    {
        $user = User::select('id', 'name')->get();
        return view('report.edit', compact('report', 'user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Report $report)
    {
        $request->validate([
            'checker' => 'required',
            'shift' => 'required',
            'report_at' => 'required',
            'title' => 'required',
            'potential_dangerous_point' => 'required',
            'most_danger_point' => 'required',
            'keyword' => 'required',
            'attendant' => 'required',
            'instructor' => 'required',
        ]);

        $input = $request->except(['_token', 'submit']);

        $report->update($input);
        // dd($request->instructor);

        $array_instructor_old = $report->instructors->pluck('user_id')->toArray();
        //search instructor baru
        $result1=array_diff_assoc($request->instructor,$array_instructor_old);
        //search instructor lama (yang tidak ada di inputan instructor baru)
        $result2=array_diff_assoc($array_instructor_old,$request->instructor);

        // dd($result2);

        //insert new instructor
        if (!empty($result1)) {
            foreach($result1 as $user => $id_user){
                $report->instructors()->create(['report_id' => $report->id, 'user_id' => $id_user]);
            }
        }
        //delete old instructor
        if (!empty($result2)) {
            foreach($result2 as $user => $id_user){
               ReportInstructor::where('report_id', $report->id)->where('user_id', $id_user)->delete();
            }
        }

        return to_route('report.index')->with('success', 'Report successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function destroy(Report $report)
    {
        //
    }

    public function print(Report $report){
        $pdf = app('dompdf.wrapper');
        $contxt = stream_context_create([
            'ssl' => [
                'verify_peer' => FALSE,
                'verify_peer_name' => FALSE,
                'allow_self_signed' => TRUE,
            ]
        ]);
        $pdf = Pdf::setOptions(['isHTML5ParserEnabled' => true, 'isRemoteEnabled' => true]);
        $pdf->getDomPDF()->setHttpContext($contxt);

        $pdf = Pdf::loadView('report.pdf', compact('report'))->setPaper('a4', 'potrait');
        return $pdf->stream();
    }
}
