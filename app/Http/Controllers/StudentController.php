<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use app\Models\Student;

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
}
