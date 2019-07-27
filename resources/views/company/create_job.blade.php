@extends('layouts.app')

@section('content')

    @include('layouts.companySidebar')

    <div class="container" style="width: 50%">
        <div class="form-sec">
            <div>
                <br><br><br><br>
            <h4>Create Job</h4>
            <form name="qryform" id="qryform" method="post" action="{{ route('job_store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Job Title:</label>
                    <input type="text" class="form-control @error('job_title') is-invalid @enderror" id="job_title"                                    placeholder="Enter job title" name="job_title">
                    @error('job_title')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Job Description:</label>

                    <textarea class="form-control @error('job_description') is-invalid @enderror" id="job_description" placeholder="Enter job description" name="job_description"></textarea>
                    @error('job_description')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Salary:</label>
                    <input type="text" class="form-control @error('salary') is-invalid @enderror" id="salary" placeholder="Salary" name="salary">
                    @error('salary')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Location:</label>
                    <input type="text" class="form-control @error('location') is-invalid @enderror" id="location" placeholder="Job location" name="location">
                    @error('location')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Country:</label>
                    <input type="text" class="form-control @error('country') is-invalid @enderror" id="country" placeholder="Country Name" name="country">
                    @error('country')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <br>
                <button type="submit" class="btn btn-success">Submit</button>
            </form>
        </div>
    </div>
@endsection