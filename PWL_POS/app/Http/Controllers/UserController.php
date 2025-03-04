<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $user = UserModel::create([
            'username' => 'manager11',
            'nama' => 'Manager11',
            'password' => Hash::make('12345'),
            'level_id' => 2,
        ]);

        $user->username = 'manager12';

        $user->save();

        $user->wasChanged(); // true
        $user->wasChanged('username'); // true
        $user->wasChanged(['username', 'level_id']); // true
        $user->wasChanged('nama'); // false
        $user->wasChanged(['nama', 'username']); // true

        // Tambah data user dengan Eloquent Model
        //$data = [
        //    'username' => 'customer-1',
        //    'nama' => 'Pelanggan',
        //    'password' => Hash::make('12345'),
        //    'level_id' => 4
        //];

        // Tambahkan data ke tabel m_user
        //UserModel::insert($data);

        // Ambil semua data dari tabel m_user
        //$user = UserModel::all();

        // Kirim data ke view 'user'
        //return view('user', ['data' => $user]);

        // tambah data user dengan Eloquent Model
        //$data = [
        //'level_id' => 2,
        //'username' => 'manager_tiga',
        //'nama' => 'Manager 3',
        //'password' => Hash::make('12345')
        //];
        //UserModel::create($data);

        //UserModel::where('username', 'customer-1')->update($data); // update data user

        // coba akses model UserModel
        //$user = UserModel::all(); // ambil semua data dari tabel m_user
        //return view('user', ['data' => $user]);
    }
}
