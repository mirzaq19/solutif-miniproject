<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Illuminate\Support\Facades\Redis;
use Illuminate\Pagination\LengthAwarePaginator;

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
        $page = $request->query('page') ?? 1;
        $keyword = $request->query('keyword') ?? '';
        if (Redis::exists('courses:page:' . $page . ':keyword:' . $keyword)) {
            $courses = json_decode(Redis::get('courses:page:' . $page . ':keyword:' . $keyword));
            $courses = new LengthAwarePaginator($courses->data, $courses->total, $courses->per_page, $courses->current_page, [
                'path' => $courses->path, 
            ]);
            if ($request->has('keyword')){
                $courses->appends('keyword', $request->query('keyword'));
            }
            if (Redis::ttl('courses:page:' . $page . ':keyword:' . $keyword) == -1) {
                $courses = Course::query();
                if ($request->has('keyword')) {
                    $courses = $courses->where('name', 'like', '%' . $request->query('keyword') . '%')
                        ->orWhere('code', 'like', '%' . $request->query('keyword') . '%')
                        ->orWhere('credit', 'like', '%' . $request->query('keyword') . '%');
                }
                $courses = $courses->orderBy('name')->paginate()->appends($request->query());
                Redis::set('courses:page:' . $page . ':keyword:' . $keyword, json_encode($courses), 'EX', 120);
            }
        } else {
            $courses = Course::query();
            if ($request->has('keyword')) {
                $courses = $courses->where('name', 'like', '%' . $request->query('keyword') . '%')
                    ->orWhere('code', 'like', '%' . $request->query('keyword') . '%')
                    ->orWhere('credit', 'like', '%' . $request->query('keyword') . '%');
            }
            $courses = $courses->orderBy('name')->paginate()->appends($request->query());
            Redis::set('courses:page:' . $page . ':keyword:' . $keyword, json_encode($courses), 'EX', 120);
        }
        
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
    public function show(string $course_id): View
    {
        if (Redis::exists('course:' . $course_id)) {
            $course = json_decode(Redis::get('course:' . $course_id));
            if (Redis::ttl('course:' . $course_id) == -1) {
                $course = Course::findOrFail($course_id);
                Redis::set('course:' . $course_id, json_encode($course), 'EX', 120);
            }
        } else {
            $course = Course::findOrFail($course_id);
            Redis::set('course:' . $course_id, json_encode($course), 'EX', 120);
        }
        return view('dashboard.course.show', compact('course'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Course $course
     * @return View
     */
    public function edit(string $course_id): View
    {
        if (Redis::exists('course:' . $course_id)) {
            $course = json_decode(Redis::get('course:' . $course_id));
            if (Redis::ttl('course:' . $course_id) == -1) {
                $course = Course::findOrFail($course_id);
                Redis::set('course:' . $course_id, json_encode($course), 'EX', 120);
            }
        } else {
            $course = Course::findOrFail($course_id);
            Redis::set('course:' . $course_id, json_encode($course), 'EX', 120);
        }
        return view('dashboard.course.edit', compact('course'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Course $course
     * @return RedirectResponse
     */
    public function update(Request $request, Course $course): RedirectResponse
    {
        $request->validate([
            'code' => 'required|unique:courses,code,' . $course->id,
            'name' => 'required|string',
            'credit' => 'required|numeric|min:1|max:4',
        ]);

        $course->update([
            'name' => $request->input('name'),
            'code' => $request->input('code'),
            'credit' => $request->input('credit'),
        ]);

        Redis::del('course:' . $course->id);

        return redirect()->route('course.index')->with('success', 'Mata kuliah berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Course $course
     * @return RedirectResponse
     */
    public function destroy(Course $course): RedirectResponse
    {
        $course->delete();
        Redis::del('course:' . $course->id);
        return redirect()->route('course.index')->with('success', 'Mata kuliah berhasil dihapus.');
    }

}
