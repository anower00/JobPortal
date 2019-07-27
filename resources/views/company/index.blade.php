@extends('layouts.app')

@section('content')

    @include('layouts.companySidebar')
    @forelse($jobs as $job)
    <div class="content">
        <a href="{{ route('applicants',$job->id) }}" type="button" class="btn btn-success text-button" @if ($loop->first) style="margin-top: 64px !important;" @endif>Applicants</a>
            <div class="middle" @if ($loop->first) style="margin-top: 56px" @endif>
                <h4>{{ $job->job_title }}</h4>
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
    @empty
        <br><br><div class="middle" >
        <h3>You Haven't Posted Any Job Yet!</h3>
        </div>
    @endforelse
@endsection