<?php

namespace App\Http\Controllers\API;

use App\Group;
use App\Post;

class HomeController extends ApiController
{
    public function groups()
    {
        $student =  request()->user()->student;
        $profile['full_name'] = request()->user()->full_name;
        $profile['specialization'] = $student->stu_specialization;
        $profile['u_img'] = request()->user()->u_img;
        $profile['stu_id'] = $student->stu_id;         
        
        $groups =  $student->groups;

        return $this->sendResponse("Groups Loaded", $groups, $profile);
    }

    public function group(Group $group)
    {
        return $this->sendResponse("Assignments Loaded", $group);
    }

    public function assignments(Group $group)
    {
        $groups =  request()->user()->student->groups;
        $stu_group =  $groups->where('g_no',$group->g_no)->first()->pivot['stu_group'];
        $assignments = Post::where('stu_group',$stu_group)->with('files')->get();

        return $this->sendResponse("Assignments Loaded", $assignments);
    }

    public function assignment(Post $post)
    {
        $post->load('files');             
        return $this->sendResponse("Assignments Loaded", $post);
    }

    public function materials(Group $group)
    {
        $materials = Post::select("*")->whereNull('stu_group')->where('g_no',$group->g_no)->with('files')->get();

       // $materials =  $group->materials;           
        return $this->sendResponse("Materials Loaded", $materials);
    }
    
    public function material(Post $post)
    {
        $post->load('files');        
        return $this->sendResponse("Material Loaded", $post);
    }
    

    public function announcements_assign(Group $group)
    {
        $announcements =  $group->announcements()->where('grade', '!=', NULL)->get();
        return $this->sendResponse("Announcements Loaded", $announcements);
    }

    public function announcements(Group $group)
    {
        $announcements =  $group->announcements()->where('grade', '=', NULL)->get();
        return $this->sendResponse("Announcements Loaded", $announcements);
    }
    public function profile()
    {
        $student =  request()->user()->student;
        $data['full_name'] = request()->user()->full_name;
        $data['specialization'] = $student->stu_specialization;
        $data['u_img'] = request()->user()->u_img;
        $data['stu_id'] = $student->stu_id;

        return $this->sendResponse("Profile Loaded", $data);
    }
    
    public function updatePassword()
    {
        $user = request()->user();         
        $user->password = bcrypt(request()->password);
        $user->save();

        return $this->sendResponse("password Changed Successful", $user);
    }
}
