<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Report;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $report = Report::with('user')->where('user_id', auth()->user()->id)->get();
        return view('report.index', compact('report'));
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
            // 'statement' => 'required',
            'keyword' => 'required',
            'attendant' => 'required',
        ]);

        $input = $request->except(['_token', 'submit']);

        $input['user_id'] = auth()->user()->id;
        $input['department_id'] = auth()->user()->department_id;
        $input['section_id'] = auth()->user()->section_id;
        $input['status'] = 'Submit';
        unset($input['instructor']);

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
        //
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
        //


        // $array_user_old = $report->instructor->pluck('name', 'id_emp')->toArray();
        // //search user baru
        // $result1=array_diff_assoc($request->emp,$array_user_old);
        // //search user lama (yang tidak ada di inputan user baru)
        // $result2=array_diff_assoc($array_user_old,$request->emp);

        // //insert new user
        // if (!empty($result1)) {
        //     foreach($result1 as $id_user => $name_user){
        //         $report->instructor()->create(['id_emp' => $id_user, 'name' => $name_user]);
        //     }
        // }
        // //delete old user
        // if (!empty($result2)) {
        //     foreach($result2 as $id_user => $name){
        //        ReportInstructor::where('report_id', $report->id)->where('user_id', $id_user)->delete();
        //     }
        // }
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
}
