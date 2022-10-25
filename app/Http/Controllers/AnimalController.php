<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnimalController extends Controller
{
    public $animals = ['Kucing', 'Ayam', 'Ikan', 'Sapi', 'kuda'];

    public function index()
    {
        echo "Menampilkan Data hewan<br>";
        foreach ($this->animals as $nama) {
            echo "- $nama <br>";
        }
    }

    public function store(Request $request)
    {
        echo "Menambahkan hewan Baru <br>";
        array_push($this->animals, $request->nama);
        echo $this->index();
    }

    public function update(Request $request, $id)
    {
        echo "Mengubah data hewan id $id <br>";
        $this->animals[$id] = $request->nama;
        echo $this->index();
    }

    public function destroy($id)
    {
        echo "Menghapus Data hewan id $id <br>";
        unset($this->animals[$id]);
        echo $this->index();
    }
}
