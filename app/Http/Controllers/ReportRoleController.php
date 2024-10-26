<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Section;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReportRoleController extends Controller
{
    public function admin(){
        $department = Department::where('del', 'N')->get();
        if(request()->get('department_id') !=''){
            $section = $section = Section::where('del', 'N')->where('department_id', request()->get('department_id'))->get();
        } else {
            $section = [];
        }
        $report = Report::with('user')->filter(request(['department_id','section_id', 'status']))->get();
        return view('admin.index', compact('report', 'department', 'section'));
    }

    public function reviewer(){
        $department = Department::where('del', 'N')->get();
        if(request()->get('department_id') !=''){
            $section = $section = Section::where('del', 'N')->where('department_id', request()->get('department_id'))->get();
        } else {
            $section = [];
        }
        $report = Report::with('user')->where('status', 'Submit')->filter(request(['department_id','section_id']))->get();
        return view('reviewer.index', compact('report', 'department', 'section'));
    }
}
