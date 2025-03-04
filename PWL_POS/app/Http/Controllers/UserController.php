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
            'username' => 'manager55',
            'nama' => 'Manager55',
            'password' => Hash::make('12345'),
            'level_id' => 2
        ]);
        $user->username = 'manager56';

        $user->isDirty(); // true
        $user->isDirty('username'); // true
        $user->isDirty('nama'); // false
        $user->isDirty(['nama', 'username']); // true

        $user->isClean(); // false
        $user->isClean('username'); // false
        $user->isClean('nama'); // true
        $user->isClean(['nama', 'username']); // false

        $user->save();

        $user->isDirty(); // false
        $user->isClean(); // true
        dd($user->isDirty());

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
