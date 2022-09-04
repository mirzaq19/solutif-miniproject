<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Student;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        if ($request->user()->role == 'admin') {
            $numberOfStudent = Student::all()->count();
            $numberOfCourse = Course::all()->count();

            return view('dashboard.index', compact('numberOfStudent', 'numberOfCourse'));
        } else {
            $student = Student::where('user_id', $request->user()->id)->with('courses')->first();
            $ownedCourses = $student->courses;
            return view('dashboard.index', compact('student','ownedCourses'));
        }
    }
}
