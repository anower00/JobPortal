<?php

namespace App\Http\Controllers;

use App\ApplyJob;
use App\Job;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class JobController extends Controller
{
    public function add_job()
    {
        return view('company.create_job');
    }
    public function job_store(Request $request)
    {
        $this->validate($request, [
            'job_title' => 'required',
            'job_description' => 'required',
            'salary' => 'required',
            'location' => 'required',
            'country' => 'required'
        ]);

        $company_id = Auth::user()->id;
        $jobs = new Job();
        $jobs->job_title = $request->job_title;
        $jobs->job_description = $request->job_description;
        $jobs->salary = $request->salary;
        $jobs->location = $request->location;
        $jobs->country = $request->country;
        $jobs->company_id = $company_id;
        $jobs->save();

        Toastr::success('Job created successfully', 'Job Created', ["positionClass" => "toast-top-right"]);
        return redirect()->route('company');
    }

    public function apply_job($id)
    {
        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        if ($user->resume == null){
            Session::flash('message', 'Please upload your resume to apply this job!');
            Session::flash('alert-class', 'alert-danger');
            return redirect()->route('edit_profile');
        }

        $apply_job = new ApplyJob();
        $apply_job->user_id = $user_id;
        $apply_job->job_id = $id;
        $apply_job->save();

        Toastr::success('Successfully applied in this job', 'Applied', ["positionClass" => "toast-top-right"]);
        return redirect()->route('home');
    }

    public function applicants($id)
    {

        $job = Job::find($id);

        $applicants = ApplyJob::where('job_id',$id)->get();
        foreach ($applicants as $applicant)
        {
            $user = User::find($applicant->user_id);
            $applicant->user = $user;
        }

        return view('company.applicants',compact('job','applicants'));
    }

    public function company()
    {
        $company_id = Auth::user()->id;
        $jobs = Job::where('company_id',$company_id)->orderBy('id', 'desc')->get();
        return view('company.index',compact('jobs'));
    }

}
