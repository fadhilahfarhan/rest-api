<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    public function index()
    {
        # menggunakan model students untul select datanya
        #fungsi all() untuk mendapatkan seluruh resource
        $students = Student::all();
        if ($students->isEmpty()) {
            $data = ['message' => 'Data students is emty'];

            return response()->json($data, 404);
        } else {
            $data = [
                'message' => 'Get all students',
                'data' => $students
            ];

            return response()->json($data, 200);
        }

        # menggunakan response json laravel
        # otomatis set header content type json
        # otomatis mengubah data array  ke json
        # mengatur status code
        # return response()->json($data, 200);
    }

    public function store(Request $request)
    {
        #untuk memvalidasi apakah data yang diisi benar atau salah
        $validator = Validator::make($request->all(), [
            'nama' => 'required|min:2|max:255',
            'nim' => 'required|min:10|max:10',
            'email' => 'required',
            'jurusan' => 'required'
        ]);

        #jika fails akan menampilkan error
        if ($validator->fails()) {
            $data = ['message' => 'Input data failed!'];

            return response()->json($data, 404);
        } else {
            #ini akan menampilkan jika sudah benar
            $students = Student::create($request->all());

            $data = [
                'message' => 'Student is created succesfully',
                'data' => $students
            ];

            return response()->json($data, 201);
        }
    }

    #untuk mengupdate data
    public function update(Request $request, $id)
    {
        #find untuk menemukan id yang ingin diubah
        $student = Student::find($id);
        if ($student) {
            #ini akan menampilkan data yang berhasil diubah
            #jika data yang diubah tidak ada akan menggunakan data yang lama
            $input = [
                'nama' => $request->nama ?? $student->nama,
                'nim' => $request->nim ?? $student->nim,
                'email' => $request->email ?? $student->email,
                'jurusan' => $request->jurusan ?? $student->jurusan
            ];

            #update untuk mengubah data
            $student->update($input);

            $data = [
                'message' => 'Data student updated succesfully',
                'data' => $input
            ];

            return response()->json($data, 200);
        } else {
            #ini akan menampilkan jika data memang tidak ada
            $data = ['message' => 'Data Student Not Found!'];

            return response()->json($data, 404);
        }
    }

    public function destroy($id)
    {
        $student = Student::find($id);
        if ($student) {
            #delete untuk menghapus data 
            $student->delete();
            $data = ['message' => 'Data student Deleted succesfully'];

            return response()->json($data, 200);
        } else {
            $data = ['message' => 'Data Student Not Found!'];

            return response()->json($data, 404);
        }
    }

    public function show($id)
    {
        $student = Student::find($id);
        if ($student) {
            $data = [
                'message' => 'Get details student',
                'data' => $student
            ];

            return response()->json($data, 200);
        } else {
            $data = ['message' => 'Data Student Not Found!'];

            return response()->json($data, 404);
        }
    }
}
