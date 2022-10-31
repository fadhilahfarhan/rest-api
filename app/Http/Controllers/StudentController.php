<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $user = [
            'nama' => 'Fadhilah Farhan',
            'jurusan' => 'Teknik Informatika'
        ];

        # menggunakan response json laravel
        # otomatis set header content type json
        # otomatis mengubah data array  ke json
        # mengatur status code
        return response()->json($user,200);
    }
}
