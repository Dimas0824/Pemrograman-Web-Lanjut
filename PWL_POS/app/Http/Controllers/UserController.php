<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        // Tambah data user dengan Eloquent Model
        $data = [
            'username' => 'customer-1',
            'nama' => 'Pelanggan',
            'password' => Hash::make('12345'),
            'level_id' => 4
        ];

        // Tambahkan data ke tabel m_user
        UserModel::insert($data);

        // Ambil semua data dari tabel m_user
        $user = UserModel::all();

        // Kirim data ke view 'user'
        return view('user', ['data' => $user]);
    }
}
