<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $courses = Course::query();

        if ($request->has('keyword')) {
            $courses = $courses->where('name', 'like', '%' . $request->query('keyword') . '%')
                ->orWhere('code', 'like', '%' . $request->query('keyword') . '%')
                ->orWhere('credit', 'like', '%' . $request->query('keyword') . '%');
        }

        $courses = $courses->orderBy('name')->paginate()->appends($request->query());

        return view('dashboard.course.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('dashboard.course.create');
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
            'code' => 'required|unique:courses',
            'name' => 'required|string',
            'credit' => 'required|numeric|min:1|max:4',
        ]);

        $course = Course::create([
            'name' => $request->input('name'),
            'code' => $request->input('code'),
            'credit' => $request->input('credit'),
        ]);

        return redirect()->route('course.index')->with('success', 'Mata kuliah berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param Course $course
     * @return View
     */
    public function show(Course $course): View
    {
        return view('dashboard.course.show', compact('course'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
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
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
