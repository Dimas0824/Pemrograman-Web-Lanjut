<?php

namespace App\Http\Controllers;

use App\Models\LevelModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class LevelController extends Controller
{
    // Menampilkan halaman daftar level
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Level',
            'list' => ['Home', 'Level']
        ];

        $page = (object) [
            'title' => 'Daftar level dalam sistem'
        ];

        $activeMenu = 'level'; // Set menu yang aktif

        // Ambil data level dari database
        $levels = LevelModel::select('level_id', 'level_code', 'level_nama')->get();

        return view('level.index', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu,
            'levels' => $levels // Kirim ke view
        ]);
    }

    // Ambil data level dalam bentuk JSON untuk DataTables
    public function list(Request $request)
    {
        $query = LevelModel::select('level_id', 'level_code', 'level_nama', 'created_at', 'updated_at');

        // Tambahkan filter jika level_code dikirimkan
        if (!empty($request->level_code)) {
            $query->where('level_code', $request->level_code);
        }

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('aksi', function ($level) {
                $btn = '<a href="' . url('/level/' . $level->level_id) . '" class="btn btn-info btn-sm">Detail</a> ';
                $btn .= '<a href="' . url('/level/' . $level->level_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
                $btn .= '<form class="d-inline-block" method="POST" action="' . url('/level/' . $level->level_id) . '">'
                    . csrf_field()
                    . method_field('DELETE')
                    . '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\')">Hapus</button>'
                    . '</form>';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }


    // Menampilkan halaman form tambah level
    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Level',
            'list' => ['Home', 'Level', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah level baru'
        ];

        $activeMenu = 'level';

        return view('level.levelCreate', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu
        ]);
    }

    // Menyimpan data level baru
    public function store(Request $request)
    {
        $request->validate([
            'level_code' => 'required|string|unique:m_level,level_code',
            'level_nama' => 'required|string|max:100'
        ]);

        LevelModel::create([
            'level_code' => $request->level_code,
            'level_nama' => $request->level_nama
        ]);

        return redirect('/level')->with('success', 'Data level berhasil disimpan');
    }

    // Menampilkan detail level
    public function show($level_id)
    {
        $level = LevelModel::find($level_id);

        $breadcrumb = (object) [
            'title' => 'Detail Level',
            'list' => ['Home', 'Level', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail level'
        ];

        $activeMenu = 'level';

        return view('level.levelShow', [
            'level' => $level,
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu
        ]);
    }

    // Menampilkan halaman form edit level
    public function edit($id)
    {
        $level = LevelModel::find($id);

        if (!$level) {
            return redirect('level')->with('error', 'Data level tidak ditemukan.');
        }

        $levels = LevelModel::all(); // Ambil semua level untuk dropdown

        return view('level.levelEdit', [
            'breadcrumb' => (object) ['title' => 'Edit Level', 'list' => ['Home', 'Level', 'Edit']],
            'page' => (object) ['title' => 'Edit Level'],
            'level' => $level, // Data level yang sedang diedit
            'levels' => $levels, // Data untuk dropdown
            'activeMenu' => 'level'
        ]);
    }


    // Menyimpan perubahan data level
    public function update(Request $request, $id)
    {
        $request->validate([
            'level_code' => 'required|string|unique:m_level,level_code,' . $id . ',level_id',
            'level_nama' => 'required|string|max:100'
        ]);

        LevelModel::find($id)->update([
            'level_code' => $request->level_code,
            'level_nama' => $request->level_nama
        ]);

        return redirect('/level')->with('success', 'Data level berhasil diubah');
    }

    // Menghapus data level
    public function destroy($id)
    {
        $check = LevelModel::find($id);
        if (!$check) {
            return redirect('/level')->with('error', 'Data level tidak ditemukan');
        }

        try {
            LevelModel::destroy($id);
            return redirect('/level')->with('success', 'Data level berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/level')->with('error', 'Data level sedang digunakan');
        }
    }
}
