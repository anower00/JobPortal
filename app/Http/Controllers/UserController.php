<?php

namespace App\Http\Controllers;

use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Auth;

class UserController extends Controller
{
    public function editProfile()
    {
        $id= Auth::user()->id;

        $user = User::find($id);
        return view('user.edit_profile',compact('user'));
    }

    public function updateProfile(Request $request)
    { $this->validate($request, [
        'image' => 'mimes:jpg,jpeg,png',
        'resume' => 'mimes:pdf,docx',
    ]);

        $id= Auth::user()->id;

        $user = User::find($id);
        $image = $request->file('image');
        $slug = str_slug($user->first_name);
        if (isset($image))
        {
            $currentDate = Carbon::now()->toDateString();
            $imagename = 'profile_pic/'.$slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
            if (!file_exists('profile_pic'))
            {
                mkdir('profile_pic', 0777,true);
            }
//            unlink('profile_pic' . $user->profile_picture);
            $image->move('profile_pic',$imagename);
        }
        else
        {
            $imagename = $user->profile_picture;
        }

        //for resume upload

        $resume = $request->file('resume');
        $slug = str_slug($user->first_name);
        if (isset($resume))
        {
            $currentDate = Carbon::now()->toDateString();
            $resumename = 'resume/'.$slug.'-'.$currentDate.'-'.uniqid().'.'.$resume->getClientOriginalExtension();
            if (!file_exists('resume'))
            {
                mkdir('resume', 0777,true);
            }
//            unlink('resume' . $user->resume);
            $resume->move('resume',$resumename);
        }
        else
        {
            $resumename = $user->resume;
        }

        $user->profile_picture = $imagename;
        $user->skills = $request->skills;
        $user->resume = $resumename;
        $user->update();

        Toastr::success('Profile updated successfully', 'Updated', ["positionClass" => "toast-top-right"]);
        return redirect('home');
    }

}
