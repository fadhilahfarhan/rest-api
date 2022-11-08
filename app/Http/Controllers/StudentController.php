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
        #isEmty digunakan untuk menjelaskan data yang dicari ada atau tidak
        if ($students->isEmpty()) {
            return response()->json(['message' => 'Data students is emty'], 404);
        } else {
            $data = [
                'message' => 'Get all students',
                'data' => $students
            ];
            return response()->json($data, 200);
        }
    }

    public function store(Request $request)
    {
        #untuk memvalidasi apakah data yang diisi benar atau salah
        $input = Validator::make($request->all(), [
            'nama' => 'required|min:2|max:255',
            'nim' => 'required|min:10|max:10',
            'email' => 'required|email',
            'jurusan' => 'required'
        ]);

        #jika fails akan menampilkan error
        if ($input->fails()) {
            return response()->json(['message' => 'Input data failed!'], 404);
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
        #mencari data menggunakan find id
        $student = Student::find($id);
        #memvalidasi data yang diinput
        #nullable agar tetap bisa diproses jika tidak mendapat input
        $input = Validator::make($request->all(), [
            'nama' => 'nullable|min:2|max:255',
            'nim' => 'nullable|min:10|max:10',
            'email' => 'nullable|email',
            'jurusan' => 'nullable'
        ]);

        #fails digunakan jika ada ada kegagalan dalam proses validasi
        if ($input->fails()) {
            #jika input data ada kesalahan
            return response()->json(['message' => 'Ups something wrong!'], 404);
        }elseif(!$student){
            #jika id tidak ditemukan
            return response()->json(['message' => 'Id not found!'], 404);
        } else{
            $student->update($request->all());
            $data = [
                'message' => 'Data student updated succesfully',
                'data' => $student
            ];
            return response()->json($data, 200);
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
            return response()->json(['message' => 'Data Student Not Found!'], 404);
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
            return response()->json(['message' => 'Data Student Not Found!'], 404);
        }
    }
}
