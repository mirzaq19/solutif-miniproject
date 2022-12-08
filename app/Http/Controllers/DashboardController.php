<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        if ($request->user()->role == 'admin') {
            if (Redis::exists('numberOfStudent')) {
                $numberOfStudent = Redis::get('numberOfStudent');
                if (Redis::ttl('numberOfStudent') == -1){
                    $numberOfStudent = Student::all()->count();
                    Redis::set('numberOfStudent', $numberOfStudent, 'EX', 20);
                }
            } else {
                $numberOfStudent = Student::all()->count();
                Redis::set('numberOfStudent', $numberOfStudent, 'EX', 20);
            }

            if (Redis::exists('numberOfCourse')) {
                $numberOfCourse = Redis::get('numberOfCourse');
                if (Redis::ttl('numberOfCourse') == -1){
                    $numberOfCourse = Course::all()->count();
                    Redis::set('numberOfCourse', $numberOfCourse, 'EX', 20);
                }
            } else {
                $numberOfCourse = Course::all()->count();
                Redis::set('numberOfCourse', $numberOfCourse, 'EX', 20);
            }

            return view('dashboard.index', compact('numberOfStudent', 'numberOfCourse'));
        } else {
            if (Redis::exists('student:' . $request->user()->id) && Redis::exists('student:'. $request->user()->id. ':courses')) {
                $student = Redis::get('student:' . $request->user()->id);
                if (Redis::ttl('student:' . $request->user()->id) == -1){
                    $student = Student::where('user_id', $request->user()->id)->with('courses')->first();
                    Redis::set('student:' . $request->user()->id, $student, 'EX', 20);
                }
                $ownedCourses = Redis::get('student:'. $request->user()->id. ':courses');
                if (Redis::ttl('student:'. $request->user()->id. ':courses') == -1){
                    $ownedCourses = $student->courses;
                    Redis::set('student:'. $request->user()->id. ':courses', $ownedCourses, 'EX', 20);
                }
            } else {
                $student = Student::where('user_id', $request->user()->id)->with('courses')->first();
                Redis::set('student:' . $request->user()->id, $student, 'EX', 20);
                $ownedCourses = $student->courses;
                Redis::set('student:'. $request->user()->id. ':courses', $ownedCourses, 'EX', 20);
            }
            return view('dashboard.index', compact('student','ownedCourses'));
        }
    }
}
