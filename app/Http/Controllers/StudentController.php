<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $students = Student::query();

        if ($request->has('keyword')) {
            $students = $students->where('name', 'like', '%' . $request->query('keyword') . '%')
            ->orWhere('nim', 'like', '%' . $request->query('keyword') . '%')
            ->orWhere('address', 'like', '%' . $request->query('keyword') . '%')
            ->orWhere('major', 'like', '%' . $request->query('keyword') . '%')
            ->orWhere('year', 'like', '%' . $request->query('keyword') . '%');
        }

        $students = $students->paginate()->appends($request->query());

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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}