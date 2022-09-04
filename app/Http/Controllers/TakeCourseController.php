<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TakeCourseController extends Controller
{
    /**
     * @param Request $request
     * @param Student $student
     * @return RedirectResponse
     */
    public function store(Request $request, Student $student): RedirectResponse
    {
        $request->validate([
            'course_id' => 'required',
            'grade' => 'nullable|string',
            'semester' => 'required',
        ]);

        if ($student->courses()->where('course_id', $request->input('course_id'))->exists()) {
            return redirect()->back()->with('error', 'Mahasiswa sudah mengambil mata kuliah ini');
        }

        $student->courses()->attach($request->input('course_id'), [
            'grade' => $request->input('grade'),
            'semester' => $request->input('semester'),
        ]);
        return redirect()->route('student.show', $student)->with('success', 'Mata kuliah berhasil ditambahkan');
    }
}
