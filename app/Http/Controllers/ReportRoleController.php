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
        if(!(auth()->user()->isAdmin())){
            abort(403, 'Unauthorized Action');
        }
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
        if(!(auth()->user()->isReviewer())){
            abort(403, 'Unauthorized Action');
        }
        $department = Department::where('del', 'N')->get();
        if(request()->get('department_id') !=''){
            $section = $section = Section::where('del', 'N')->where('department_id', request()->get('department_id'))->get();
        } else {
            $section = [];
        }
        $report = Report::with('user')->where('status', 'Submit')->filter(request(['department_id','section_id']))->get();
        return view('reviewer.index', compact('report', 'department', 'section'));
    }

    public function review_process($id, $status)
    {
        $report = Report::findOrFail($id);
        if((!auth()->user()->isReviewer()) or (!in_array($report->status, array("Submit")))){
            abort(403);
        }

        $report->update(['status' => $status, 'reviewer' => auth()->user()->name]);

        return to_route('report.reviewer')->with('success','Selected report '.$status.' successfully');
    }

    public function approver(){
        if(!(auth()->user()->isApprover())){
            abort(403, 'Unauthorized Action');
        }
        $department = Department::where('del', 'N')->get();
        if(request()->get('department_id') !=''){
            $section = $section = Section::where('del', 'N')->where('department_id', request()->get('department_id'))->get();
        } else {
            $section = [];
        }
        $report = Report::with('user')->whereIn('status', ['Reviewed', 'Approved'])->filter(request(['department_id','section_id']))->get();
        return view('approver.index', compact('report', 'department', 'section'));
    }

    public function approval_process($id, $status)
    {
        $report = Report::findOrFail($id);
        if((!auth()->user()->isApprover()) or (!in_array($report->status, array("Reviewed", "Approved")))){
            abort(403);
        }

        //check reject or not
        if($status == 'Rejected'){
            $report->update(['status' => 'Rejected', 'approver1' => '', 'approver2' => '']);
        } else {

             //check status approval before

             //avoid double approver with same person
            if(($report->approver1 == auth()->user()->id) or (($report->approver2 == auth()->user()->id))){
                return to_route('report.approver')->with('warning','Selected report has your approval before');
            }

            if ($report->approver1 == ''){
                $report->update(['status' => 'Approved',  'approver1' => auth()->user()->id]);

            } else {
                $report->update(['status' => 'Completed',  'approver2' => auth()->user()->id]);
            }
        }



        // $report->update(['status' => $status]);

        return to_route('report.approver')->with('success','Selected report '.$status.' successfully');
    }
}
