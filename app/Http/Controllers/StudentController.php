<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Student;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;
use Illuminate\Pagination\LengthAwarePaginator;

class StudentController extends Controller
{
    /**
     * @param Student $student
     * @return Response
     */
    public function report(Student $student): Response
    {
        $student->load('courses', 'user');
        $ownedCourses = $student->courses->sortBy('pivot.semester');;

        $pdf = Pdf::loadView('dashboard.summary', ['student' => $student, 'ownedCourses' => $ownedCourses]);

        return $pdf->download('report-'.$student->nim.'.pdf');
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $page = $request->query('page') ?? 1;
        $keyword = $request->query('keyword') ?? '';

        if (Redis::exists('students:page:' . $page . ':keyword:' . $keyword)) {
            $students = json_decode(Redis::get('students:page:' . $page . ':keyword:' . $keyword));
            $students = new LengthAwarePaginator($students->data, $students->total, $students->per_page, $students->current_page, [
                'path' => $students->path, 
            ]);
            if ($request->has('keyword')){
                $students->appends('keyword', $request->query('keyword'));
            }
            if (Redis::ttl('students:page:' . $page . ':keyword:' . $keyword) == -1) {
                $students = Student::query();
                if ($request->has('keyword')) {
                    $students = $students->where('name', 'like', '%' . $request->query('keyword') . '%')
                    ->orWhere('nim', 'like', '%' . $request->query('keyword') . '%')
                    ->orWhere('address', 'like', '%' . $request->query('keyword') . '%')
                    ->orWhere('major', 'like', '%' . $request->query('keyword') . '%')
                    ->orWhere('year', 'like', '%' . $request->query('keyword') . '%');
                }
                $students = $students->paginate()->appends($request->query());
                Redis::set('students:page:' . $page . ':keyword:' . $keyword, json_encode($students), 'EX', 20);
            }
        } else {
            $students = Student::query();
            if ($request->has('keyword')) {
                $students = $students->where('name', 'like', '%' . $request->query('keyword') . '%')
                ->orWhere('nim', 'like', '%' . $request->query('keyword') . '%')
                ->orWhere('address', 'like', '%' . $request->query('keyword') . '%')
                ->orWhere('major', 'like', '%' . $request->query('keyword') . '%')
                ->orWhere('year', 'like', '%' . $request->query('keyword') . '%');
            }
            $students = $students->paginate()->appends($request->query());
            Redis::set('students:page:' . $page . ':keyword:' . $keyword, json_encode($students), 'EX', 20);
        }

        return view('dashboard.student.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('dashboard.student.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'username' => 'required',
            'password' => 'required|min:6|max:255|confirmed',
            'nim' => 'required',
            'gender' => 'required|in:male,female',
            'address' => 'required',
            'major' => 'required',
            'year' => 'required|int',
        ]);

        DB::beginTransaction();
        try {
            $user = User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'username' => $request->input('username'),
                'password' => Hash::make($request->input('password')),
                'role' => 'student',
            ]);

            $user->student()->create([
                'name' => $request->input('name'),
                'nim' => $request->input('nim'),
                'gender' => $request->input('gender'),
                'address' => $request->input('address'),
                'major' => $request->input('major'),
                'year' => $request->input('year'),
            ]);

            DB::commit();
            return redirect()->route('student.index')->with('success', 'Data mahasiswa berhasil ditambahkan');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Student $student
     * @return View
     */
    public function show(Student $student): View
    {
        if (!Redis::exists('student:'. $student->id)) {
            Redis::set('student:'. $student->id, $student, 'EX', 120);
        }

        if (Redis::exists('student:'. $student->id .':notcourses')) {
            $courses = json_decode(Redis::get('student:'. $student->id .':notcourses'));
        } else {
            $courses = Course::whereNotIn('id', $student->courses->pluck('id'))->get();
            Redis::set('student:'. $student->id .':notcourses', $courses, 'EX', 120);
        }

        if (Redis::exists('student:'. $student->id .':courses')) {
            $ownedCourses = json_decode(Redis::get('student:'. $student->id .':courses'));
        } else {
            $ownedCourses = $student->courses->sortBy('pivot.semester');
            Redis::set('student:'. $student->id .':courses', $ownedCourses, 'EX', 120);
        }
        return view('dashboard.student.show', compact('student','courses','ownedCourses'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Student $student
     * @return View
     */
    public function edit(Student $student): View
    {
        if (!Redis::exists('student:'. $student->id)) {
            // $student = json_decode(Redis::get('student:'. $student->id));
            Redis::set('student:'. $student->id, $student, 'EX', 20);
        }
        return view('dashboard.student.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     *
     */
    public function update(Request $request, Student $student): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $student->user->id,
            'username' => 'required|unique:users,username,' . $student->user->id,
            'password' => 'nullable|min:6|max:255|confirmed',
            'nim' => 'required',
            'gender' => 'required|in:male,female',
            'address' => 'required',
            'major' => 'required',
            'year' => 'required|int',
        ]);

        DB::beginTransaction();
        try {
            $student->user()->update([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'username' => $request->input('username'),
                'password' => $request->input('password') ? Hash::make($request->input('password')) : $student->user->password,
            ]);

            $student->update([
                'name' => $request->input('name'),
                'nim' => $request->input('nim'),
                'gender' => $request->input('gender'),
                'address' => $request->input('address'),
                'major' => $request->input('major'),
                'year' => $request->input('year'),
            ]);

            DB::commit();
            Redis::del('student:'. $student->id);
            return redirect()->route('student.index')->with('success', 'Data mahasiswa berhasil diubah');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Student $student
     * @return RedirectResponse
     */
    public function destroy(Student $student): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $user = User::find($student->user_id);
            $user->delete();
            Redis::del('student:'. $student->id);
            Redis::del('student:'. $student->id .':notcourses');
            Redis::del('student:'. $student->id .':courses');
            Redis::del(Redis::keys('students:*'));
            DB::commit();
            return redirect()->route('student.index')->with('success', 'Data mahasiswa berhasil dihapus');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
