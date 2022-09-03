<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Student;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $numberOfStudent = Student::all()->count();
        $numberOfCourse = Course::all()->count();

        return view('dashboard.index', compact('numberOfStudent', 'numberOfCourse'));
    }
}
