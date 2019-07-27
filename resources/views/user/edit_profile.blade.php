@extends('layouts.app')
@section('content')
    @include('layouts.sidebar')
    <div class="content">
        @if(Session::has('message'))
            <p class="alert {{ Session::get('alert-class', 'alert-info') }}" style="margin-top: 80px">{{ Session::get('message') }}</p>
        @endif
        <h2 style="margin-top: 56px">{{ $user->first_name.' '. $user->last_name}}</h2>

    <form method="post" action="{{ route('update_profile') }}" enctype="multipart/form-data">
        {{method_field('put')}}
        @csrf
        <img src="{{ asset($user->profile_picture) }}" class="img-responsive section-icon hidden-sm hidden-xs menu_img">
        <br>
        <input type="file" name="image">
        <br><br>
        Skills (comma separated):<br>
        <input type="text" name="skills" value="{{ $user->skills }}">
        <br><br>
        Email: <br>
        <label>{{ $user->email }}</label>
        <br><br>
        Upload Resume:<br>
        <input type="file" name="resume">
        <br><br>
        <input type="submit" class="btn btn-success" value="Submit">
    </form>
    </div>
@endsection
