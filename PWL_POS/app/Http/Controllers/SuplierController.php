<?php

namespace App\Http\Controllers;

use App\Models\SuplierModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class SuplierController extends Controller
{
    // Menampilkan halaman daftar suplier
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Suplier',
            'list' => ['Home', 'Suplier']
        ];

        $page = (object) [
            'title' => 'Daftar suplier dalam sistem'
        ];

        $activeMenu = 'suplier'; // Set menu yang aktif

        // Ambil data suplier dari database
        $supliers = SuplierModel::select('suplier_id', 'nama_suplier', 'kontak', 'alamat', 'created_at', 'updated_at')->get();

        return view('suplier.index', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu,
            'supliers' => $supliers // Kirim ke view
        ]);
    }

    // Ambil data suplier dalam bentuk JSON untuk DataTables
    public function list(Request $request)
    {
        $suplier = SuplierModel::select('suplier_id', 'nama_suplier', 'kontak', 'alamat', 'created_at', 'updated_at');

        // Filter data berdasarkan suplier_id
        if ($request->suplier_id) {
            $suplier->where('suplier_id', $request->suplier_id);
        }

        return DataTables::of($suplier)
            ->addIndexColumn()
            ->addColumn('aksi', function ($suplier) {
                $btn = '<button onclick="modalAction(\'' . url('/suplier/' . $suplier->suplier_id . '/show') . '\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/suplier/' . $suplier->suplier_id . '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/suplier/' . $suplier->suplier_id . '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button> ';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function create_ajax()
    {
        return view('suplier.create_ajax');
    }

    public function store_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'nama_suplier' => 'required|string|max:255',
                'kontak' => 'nullable|string|max:255',
                'alamat' => 'nullable|string|max:255'
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors(),
                ]);
            }

            SuplierModel::create($request->all());
            return response()->json([
                'status' => true,
                'message' => 'Data suplier berhasil disimpan'
            ]);
        }
        return redirect('/suplier');
    }

    public function edit_ajax(string $id)
    {
        $suplier = SuplierModel::find($id);
        return view('suplier.edit_ajax', [
            'suplier' => $suplier
        ]);
    }

    public function update_ajax(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'nama_suplier' => 'required|string|max:255',
                'kontak' => 'nullable|string|max:255',
                'alamat' => 'nullable|string|max:255'
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi gagal.',
                    'msgField' => $validator->errors()
                ]);
            }

            $suplier = SuplierModel::find($id);
            if ($suplier) {
                $suplier->update($request->all());
                return response()->json([
                    'status' => true,
                    'message' => 'Data suplier berhasil diupdate'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan'
                ]);
            }
        }
        return redirect('/suplier');
    }

    public function confirm_ajax(string $id)
    {
        $suplier = SuplierModel::find($id);
        return view('suplier.confirm_ajax', [
            'suplier' => $suplier
        ]);
    }

    public function delete_ajax(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $suplier = SuplierModel::find($id);
            if ($suplier) {
                $suplier->delete();
                return response()->json([
                    'status' => true,
                    'message' => 'Data suplier berhasil dihapus'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan'
                ]);
            }
        }
        return redirect('/suplier');
    }

    // Menampilkan detail suplier
    public function show($suplier_id)
    {
        $suplier = SuplierModel::find($suplier_id);

        $breadcrumb = (object) [
            'title' => 'Detail Suplier',
            'list' => ['Home', 'Suplier', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail suplier'
        ];

        $activeMenu = 'suplier';

        return view('suplier.suplierShow', [
            'suplier' => $suplier,
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu
        ]);
    }
}
