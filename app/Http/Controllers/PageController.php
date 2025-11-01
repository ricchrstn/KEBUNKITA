<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Menampilkan halaman "Tentang Kami".
     */
    public function about()
    {
        // Siapkan data tim di sini agar mudah diubah
        $team = [
            [
                'name' => 'Tegar Aji Pangestu',
                'role' => 'Membuat Tampilan Coding Tampilan User Interface',
                'imageUrl' => asset('./img/.jpg'),
                'instagramUrl' => '',
            ],
            [
                'name' => 'Andika Indra Prastawa',
                'role' => 'Membuat Prototype Low Feadilitiy dan High Feadility',
                'imageUrl' => asset('./img/.jpg'),
                'instagramUrl' => '',
            ],
            [
                'name' => 'Didik Setiawan',
                'role' => 'Membuat Database dan API',
                'imageUrl' => asset('./img/.jpg'),
                'instagramUrl' => '',
            ],
            [
                'name' => 'Ben Waiz Pintus Widyosaputro',
                'role' => 'Membuat Tampilan Coding Tampilan User Interface',
                'imageUrl' => asset('./img/.jpg'),
                'instagramUrl' => '',
            ],
            [
                'name' => 'Kartika Pringgo Hutomo',
                'role' => 'Melakukan dan Membuat Pengujian Blackbox',
                'imageUrl' => asset('./img/.jpg'),
                'instagramUrl' => '',
            ],
            [
                'name' => 'Rizky Cristian S',
                'role' => 'Membuat Tampilan Coding Tampilan User Interface',
                'imageUrl' => asset('./img/christian.jpg'),
                'instagramUrl' => 'https://www.instagram.com/rickychristians/',
            ],
        ];

        return view('pages.about', [
            'team' => $team,
        ]);
    }
}
