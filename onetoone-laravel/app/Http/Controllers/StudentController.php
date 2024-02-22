<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Academic;
use App\Models\Country;

class StudentController extends Controller
{
    public function index(Request $request) {
        $students = Student::with(['academic', 'country'])->get();
        
        if ($request->wantsJson() || $request->is('api/*')) {
            return response()->json($students, 200);
        }   
        
        return view('student.index', compact('students'));
    }

    public function edit(Student $student) {
        return view('student.edit', ['student' => $student]);
    }

    public function create() {
        return view('student.create');
    }

    public function store(Request $request) {
        $rules = [
            'name' => 'required|string',
            'age' => 'required|integer',
            'address' => 'required|string',
            'academic.course' => 'required|string',
            'academic.year' => 'required|string',
            'country.continent' => 'required|string',
            'country.country_name' => 'required|string',
            'country.capital' => 'required|string',
        ];

        $data = $request->validate($rules);

        $student = Student::create([
            'name' => $data['name'],
            'age' => $data['age'],
            'address' => $data['address'],
        ]);

        $student->academic()->create([
            'course' => $data['academic']['course'],
            'year' => $data['academic']['year'],
        ]);

        $student->country()->create([
            'continent' => $data['country']['continent'],
            'country_name' => $data['country']['country_name'],
            'capital' => $data['country']['capital'],
        ]);

        if ($request->wantsJson() || $request->is('api/*')) {
            return response()->json($student, 201);
        }

        return redirect(route('student.index'))->with('message', 'Student Data created successfully.');
    }

    public function update(Request $request, Student $student) {
        $rules = [
            'name' => 'required|string',
            'age' => 'required|integer',
            'address' => 'required|string',
            'academic' => 'required|array',
            'academic.course' => 'required|string',
            'academic.year' => 'required|string',
            'country' => 'required|array',
            'country.continent' => 'required|string',
            'country.country_name' => 'required|string',
            'country.capital' => 'required|string',
        ];

        $data = $request->validate($rules);

        $student->update([
            'name' => $data['name'],
            'age' => $data['age'],
            'address' => $data['address'],
        ]);

        if ($student->academic) {
            $student->academic->update([
                'course' => $data['academic']['course'],
                'year' => $data['academic']['year'],
            ]);
        }

        if ($student->country) {
            $student->country->update([
                'continent' => $data['country']['continent'],
                'country_name' => $data['country']['country_name'],
                'capital' => $data['country']['capital'],
            ]);
        }

        if ($request->wantsJson() || $request->is('api/*')) {
            return response()->json($student, 200);
        }

        return redirect(route('student.index'))->with('message', 'Student Data updated successfully.');
    }


    public function destroy($id) {
        $student = Student::findOrFail($id);

        $student->academic()->delete();

        $student->country()->delete();

        $student->delete();

        return response()->json(['message' => 'Successfully deleted']);
    }
}
