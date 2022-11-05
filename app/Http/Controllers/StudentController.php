<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    public function index()
    {
        # menggunakan model students untul select datanya
        $students = Student::all();

        $data = [
            'message' => 'Get all student',
            'data' => $students
        ];

        # menggunakan response json laravel
        # otomatis set header content type json
        # otomatis mengubah data array  ke json
        # mengatur status code
        return response()->json($data, 200);
    }

    public function store(Request $request)
    {
        $input = [
            'nama' => $request->nama,
            'nim' => $request->nim,
            'email' => $request->email,
            'jurusan' => $request->jurusan
        ];

        $students = Student::create($input);

        $data = [
            'message' => 'Student is created succesfully',
            'data' => $students
        ];

        return response()->json($data, 201);
    }

    public function update(Request $request, $id)
    {
        $input = [
            'nama' => $request->nama,
            'nim' => $request->nim,
            'email' => $request->email,
            'jurusan' => $request->jurusan
        ];

        Student::find($id)->update($input);

        $data = [
            'message' => 'Data student updated succesfully',
            'data' => $input
        ];

        return response()->json($data, 200);
    }

    public function destroy($id)
    {
        Student::find($id)->delete();
        
        $data = [
            'message' => 'Data student Deleted succesfully',
            'id' => $id
        ];
        return response()->json($data, 200);
    }
}
