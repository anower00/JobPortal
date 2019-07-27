@extends('layouts.app')
@section('content')
    @include('layouts.companySidebar')
    @section('css')
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>
    @endsection
<div class="content">
    <h3 style="text-align: center;margin-top: 80px">{{ $job->job_title }}</h3>
    <br>
    <table>
        <tr>
            <th>Applicant Name</th>
            <th>Email</th>
            <th>Skills</th>
            <th>resume</th>
        </tr>
        @forelse($applicants as $applicant)
        <tr>
            <td>{{ $applicant->user->first_name .' '. $applicant->user->last_name}}</td>
            <td>{{ $applicant->user->email }}</td>
            <td>{{ $applicant->user->skills }}</td>
            <td><iframe src="{{ asset($applicant->user->resume) }}"></iframe></td>
        </tr>
    @empty
            <tr><td colspan="3" class="text-center">No Applicants Yet!</td></tr>
@endforelse
    </table>
</div>
    @endsection