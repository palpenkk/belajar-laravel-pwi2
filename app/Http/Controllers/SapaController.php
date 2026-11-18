<?php

namespace App\Http\Controllers;

class SapaController extends Controller
{
    public function index()
    {
        $nama = 'Naufal Naqajiwa Mulian';

        return view('pages.sapa', [
            'nama' => $nama,
        ]);
    }
}