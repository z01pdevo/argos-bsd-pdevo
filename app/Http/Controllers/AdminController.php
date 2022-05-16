<?php

namespace App\Http\Controllers;

use App\Models\QuestionGroup;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function manageQuestions(){

        $questiongroups = QuestionGroup::with('questions')
            ->orderBy('order','asc')
            ->get();

  
        return view('admin.manage-questions', ['questiongroups' => $questiongroups]);

    }

    public function manageQuestionGroups(){

        $questiongroups = QuestionGroup::orderBy('order','asc')
            ->get();
   

        return view('admin.manage-questionsgroups', ['questiongroups' => $questiongroups]);

    }

    public function manageSites(){

        return view('admin.manage-sites');

    }

    public function manageUsers(){

        return view('admin.manage-users');

    }

}
