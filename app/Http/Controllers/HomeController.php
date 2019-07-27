<?php

namespace App\Http\Controllers;

use App\Job;
use App\Company;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $jobs = Job::with('apply_jobs')->orderBy('id', 'desc')->get();
        foreach ($jobs as $job)
        {
            $company = User::find($job->company_id);
            $job->company_name = $company;
        }
        return view('home',compact('jobs'));
    }

    public function welcome()
    {
        $jobs = Job::with('apply_jobs')->orderBy('id', 'desc')->get();
        foreach ($jobs as $job)
        {
            $company = User::find($job->company_id);
            $job->company_name = $company;
        }
        return view('welcome',compact('jobs'));
    }
}
