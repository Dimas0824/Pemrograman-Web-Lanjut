<?php

namespace App\Http\Controllers;

use App\Models\SuplierModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Validation\Rule;

class SuplierController extends Controller
{
    // Menampilkan halaman awal suplier
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Suplier',
            'list' => ['Home', 'Suplier']
        ];

        $page = (object) [
            'title' => 'Daftar suplier yang terdaftar dalam sistem'
        ];

        $activeMenu = 'suplier'; // Set menu yang sedang aktif

        return view('suplier.index', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu
        ]);
    }

    // Menyimpan data suplier baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_suplier' => 'required|string|max:100', // Nama suplier wajib diisi dengan maksimal 100 karakter
            'kontak' => 'required|string|max:50', // Kontak wajib diisi
            'alamat' => 'required|string|max:200', // Alamat wajib diisi
        ]);

        SuplierModel::create([
            'nama_suplier' => $request->nama_suplier,
            'kontak' => $request->kontak,
            'alamat' => $request->alamat,
        ]);

        return redirect('/suplier')->with('success', 'Data suplier berhasil disimpan');
    }

    // Menampilkan detail suplier
    public function show($id)
    {
        $suplier = SuplierModel::find($id);

        if (!$suplier) {
            return redirect('/suplier')->with('error', 'Suplier tidak ditemukan');
        }

        $breadcrumb = (object) [
            'title' => 'Detail Suplier',
            'list' => ['Home', 'Suplier', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail suplier'
        ];

        $activeMenu = 'suplier'; // Set menu yang sedang aktif

        return view('suplier.suplierShow', [
            'suplier' => $suplier,
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu
        ]);
    }

    // Menampilkan halaman form edit suplier
    public function edit(string $id)
    {
        $suplier = SuplierModel::find($id);

        $breadcrumb = (object) [
            "title" => "Edit Suplier",
            "list" => ['Home', 'Suplier', 'Edit']
        ];

        $page = (object) [
            "title" => "Edit suplier"
        ];

        $activeMenu = 'suplier'; // set menu yang sedang aktif

        return view('suplier.edit', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'suplier' => $suplier,
            'activeMenu' => $activeMenu
        ]);
    }

    // Menyimpan perubahan data suplier
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_suplier' => 'required|string|max:100', // nama suplier harus diisi, berupa string, dan maksimal 100 karakter
            'kontak' => 'required|string|max:50', // kontak harus diisi
            'alamat' => 'required|string|max:200', // alamat harus diisi
        ]);

        SuplierModel::find($id)->update([
            'nama_suplier' => $request->nama_suplier,
            'kontak' => $request->kontak,
            'alamat' => $request->alamat,
        ]);

        return redirect('/suplier')->with('success', 'Data suplier berhasil diubah');
    }

    // Menghapus data suplier
    public function destroy(string $id)
    {
        $check = SuplierModel::find($id);
        if (!$check) {      //untuk mengecek apakah data suplier yang akan dihapus ada atau tidak
            return redirect('/suplier')->with('error', 'Data suplier tidak ditemukan');
        }
        try {
            SuplierModel::destroy($id);
            return redirect('/suplier')->with('success', 'Data suplier berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            //jika terjadi error ketika menghapus data, maka tampilkan pesan error dan redirect ke halaman suplier
            return redirect('/suplier')->with('error', 'Data suplier sedang digunakan');
        }
    }

    public function create_ajax()
    {
        return view('suplier.create_ajax');
    }

    public function store_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'nama_suplier' => 'required|string|max:100',
                'kontak' => 'required|string|max:50',
                'alamat' => 'required|string|max:200'
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
        return redirect('/');
    }

    // Ambil data suplier dalam bentuk json untuk datatables
    public function list(Request $request)
    {
        $suplier = SuplierModel::select('suplier_id', 'nama_suplier', 'kontak', 'alamat');

        return DataTables::of($suplier)
            ->addIndexColumn() // Menambahkan kolom index / no urut (default: DT_RowIndex)
            ->addColumn('aksi', function ($suplier) {
                $btn = '<a href="' . url('/suplier/' . $suplier->suplier_id . '/show') . '" class="btn btn-info btn-sm">Detail</a> ';
                $btn .= '<button onclick="modalAction(\'' . url('/suplier/' . $suplier->suplier_id . '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/suplier/' . $suplier->suplier_id . '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button> ';

                return $btn;
            })
            ->rawColumns(['aksi']) // Memberitahu bahwa kolom aksi berisi HTML
            ->make(true);
    }

    //Menampilkan halaman form edit suplier ajax
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
            // Cari data suplier
            $suplier = SuplierModel::find($id);
            if (!$suplier) {
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan'
                ]);
            }

            // Aturan validasi
            $rules = [
                'kontak' => ['required', 'string', 'max:50'],
                'alamat' => ['required', 'string', 'max:200']
            ];

            // Validasi nama_suplier unik hanya jika diubah
            if ($request->nama_suplier !== $suplier->nama_suplier) {
                $rules['nama_suplier'] = [
                    'required',
                    'string',
                    'max:100',
                    Rule::unique('m_suplier', 'nama_suplier')
                ];
            } else {
                $rules['nama_suplier'] = ['required', 'string', 'max:100'];
            }

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi gagal.',
                    'msgField' => $validator->errors()
                ]);
            }

            // Update data
            $suplier->update($request->only(['nama_suplier', 'kontak', 'alamat']));

            return response()->json([
                'status' => true,
                'message' => 'Data suplier berhasil diupdate'
            ]);
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
                    'message' => 'Data berhasil dihapus'
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
    public function import()
    {
        return view('suplier.importSuplier');
    }

    //import ajax
    public function import_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                // validasi file harus xls atau xlsx, max 1MB
                'file_suplier' => ['required', 'mimes:xlsx', 'max:1024']
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors()
                ]);
            }

            $file = $request->file('file_suplier');  // ambil file dari request

            $reader = IOFactory::createReader('Xlsx');  // load reader file excel
            $reader->setReadDataOnly(true);             // hanya membaca data
            $spreadsheet = $reader->load($file->getRealPath()); // load file excel
            $sheet = $spreadsheet->getActiveSheet();    // ambil sheet yang aktif

            $data = $sheet->toArray(null, false, true, true);   // ambil data excel   // ambil data excel

            $insert = [];
            if (count($data) > 1) {
                foreach ($data as $baris => $value) {
                    // Skip header jika semua cell kosong
                    if ($baris > 1 && (!empty($value['A']) || !empty($value['B']) || !empty($value['C']))) {
                        $insert[] = [
                            'nama_suplier' => $value['A'],
                            'kontak' => $value['B'],
                            'alamat' => $value['C'],
                            'created_at' => now(),
                        ];
                    }
                }

                if (count($insert) > 0) {
                    // insert data ke database, jika data sudah ada, maka diabaikan
                    SuplierModel::insertOrIgnore($insert);
                }

                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil diimport'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Tidak ada data yang diimport'
                ]);
            }
        }
        return redirect('/suplier');
    }

    //fungsi export
    public function export_excel()
    {
        //ambil data suplier
        $suplier = SuplierModel::select(
            'suplier_id',
            'nama_suplier',
            'kontak',
            'alamat',
        )
            ->orderBy('suplier_id')
            ->get();

        //load spreadsheet
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        //set header
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'ID suplier');
        $sheet->setCellValue('C1', 'Nama suplier');
        $sheet->setCellValue('D1', 'Kontak');
        $sheet->setCellValue('E1', 'Alamat');

        $sheet->getStyle('A1:E1')->getFont()->setBold(true); ///bold header

        //set data
        $no = 1;
        $baris = 2;
        foreach ($suplier as $row) {
            $sheet->setCellValue('A' . $baris, $no);
            $sheet->setCellValue('B' . $baris, $row->suplier_id);
            $sheet->setCellValue('C' . $baris, $row->nama_suplier);
            $sheet->setCellValue('D' . $baris, $row->kontak);
            $sheet->setCellValue('E' . $baris, $row->alamat);
            $no++;
            $baris++;
        }

        //set lebar kolom
        foreach (range('A', 'E') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true); //set autosize
        }

        //set judul file
        $sheet->setTitle('Data Suplier'); // set title sheet

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $filename = 'Data Suplier ' . date(format: 'Y-m-d H:i:s') . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        header('Cache-Control: max-age=1');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
        header('Cache-Control: cache, must-revalidate');
        header('Pragma: public');

        $writer->save('php://output');
        exit;
    }

    //export pdf
    public function export_pdf()
    {
        $suplier = SuplierModel::orderBy('suplier_id')
            ->orderBy('suplier_id')
            ->get();

        //gunakan barryvdh dompdf
        $pdf = PDF::loadview('suplier.export_pdf', ['suplier' => $suplier]);
        $pdf->setPaper('a4', 'potrait');
        $pdf->setOption("isRemoteEnabled", true);
        $pdf->render();

        return $pdf->download('Data suplier ' . date('Y-m-d H:i:s') . '.pdf');
    }
}

