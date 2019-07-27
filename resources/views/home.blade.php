@extends('layouts.app')

@section('content')
@include('layouts.sidebar')

@foreach($jobs as $job)
    <?php
    $applied = 0;
    $user_id = auth()->user()->id;
    foreach ($job->apply_jobs as $apply_job){
        if ($apply_job->user_id == $user_id){
            $applied = 1;
            break;
        }
    }
    ?>

<div class="content">
    @if($applied == 0)
    <a type="button" href="{{ route('apply_job',$job->id) }}" onclick="
            if(confirm('Do You Want To Apply This Job?'))
            {

            }
            else
            {
            event.preventDefault();
            }
            " class="btn btn-success text-button" @if ($loop->first) style="margin-top: 64px !important;" @endif>Apply</a>
    @else
        <p class="text-button" @if ($loop->first) style="margin-top: 64px !important; color: green" @else style="color: green" @endif>Already Applied</p>
    @endif
        <div class="middle" @if ($loop->first) style="margin-top: 56px" @endif>
          <h4>{{ $job->job_title }}</h4>
          <br>
            <h5>{{ $job->company_name->business_name }}</h5>
            <br>
          <h5>Job Description:</h5>
          <p>{{ $job->job_description }}</p>
          <h5>Salary:</h5>
          <p>{{ $job->salary }}</p>
          <h5>Location:</h5>
          <p>{{ $job->location }}</p>
          <h5>Country:</h5>
          <p>{{ $job->country }}</p>
      </div>
</div>
@endforeach

@endsection



