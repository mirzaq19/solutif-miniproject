<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Student;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TakeCourseController extends Controller
{
    /**
     * @param Request $request
     * @param Student $student
     * @return RedirectResponse
     */
    public function store(Request $request, Student $student): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'course_id' => 'required',
            'grade' => 'nullable|string|in:A,AB,B,BC,C,D,E',
            'semester' => 'required|integer|min:1|max:14',
        ],[
            'course_id.required' => 'Silahkan pilih mata kuliah terlebih dahulu',
            'semester.required' => 'Isian semester tidak boleh kosong',
            'semester.integer' => 'Isian semester harus berupa angka',
            'semester.min' => 'Isian semester minimal 1',
            'semester.max' => 'Isian semester maksimal 14',
            'grade.in' => 'Nilai yang anda masukkan tidak valid, pastikan anda memasukkan nilai A, AB, B, BC, C, D, E',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('take-error','Silahkan perbaiki kesalahan di bawah ini');
        }

        if ($student->courses()->where('course_id', $request->input('course_id'))->exists()) {
            return redirect()->back()->with('error', 'Mahasiswa sudah mengambil mata kuliah ini');
        }

        $student->courses()->attach($request->input('course_id'), [
            'grade' => $request->input('grade'),
            'semester' => $request->input('semester'),
        ]);
        return redirect()->route('student.show', $student)->with('success', 'Mata kuliah berhasil ditambahkan');
    }

    public function update(Request $request, Student $student,Course $course): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'grade' => 'nullable|string|in:A,AB,B,BC,C,D,E',
            'semester' => 'required|integer|min:1|max:14',
        ],[
            'semester.required' => 'Isian semester tidak boleh kosong',
            'semester.integer' => 'Isian semester harus berupa angka',
            'semester.min' => 'Isian semester minimal 1',
            'semester.max' => 'Isian semester maksimal 14',
            'grade.in' => 'Nilai yang anda masukkan tidak valid, pastikan anda memasukkan nilai A, AB, B, BC, C, D, E',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('edit-take-error','Silahkan perbaiki kesalahan di bawah ini');
        }

        $student->courses()->updateExistingPivot($course, [
            'grade' => $request->input('grade'),
            'semester' => $request->input('semester'),
        ]);
        return redirect()->route('student.show', $student)->with('success', 'Data mata kuliah berhasil diubah');
    }

    public function destroy(Student $student, Course $course): RedirectResponse
    {
        $student->courses()->detach($course);
        return redirect()->route('student.show', $student)->with('success', 'Mata kuliah berhasil dihapus');
    }
}
