<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

use App\Models\Portal_Pages;

use DataTables;

class HalamanController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Portal_Pages::select('id','judul','deskripsi','konten','created_at','updated_at')
                    ->orderBy('id','desc')
                    ->get();

            return DataTables::of($data)
                    // ->editColumn('has_submenu', function($p){
                    //     if($p->has_submenu==0){
                    //         return 'Tidak ada';
                    //     } else {
                    //         return '<a href="#" onclick="show('.$p->has_submenu.')"> Ada</a>';
                    //     }
                    // })
                    ->editColumn('aksi', function($p){
                        return '
                            <a href="halaman/'.$p->id.'/edit" class="btn btn-primary btn-sm"><i class="fas fa-fw fa-pen"></i></a>
                            <a href="'.route('halaman.destroy', $p->id).'" class="btn btn-danger btn-sm"><i class="fas fa-fw fa-trash"></i></a>';
                    })
                    // ->editColumn('tgl_booking', function($p){
                    //     if($p->tgl_booking == "")
                    //         return '-';
                    //     return \Carbon\Carbon::parse($p->tgl_booking)->isoFormat('D MMM Y');
                    // })
                    // ->addColumn('n_status', function($p){
                    //     $status = '';
                    //     if($p->is_pending == 1){
                    //         $status = '<span class="badge badge-secondary">Pengajuan</span>';
                    //     }else if($p->is_pending == 2){
                    //         $status = '<span class="badge badge-warning">Diproses </span>';
                    //     }else if($p->is_pending == 0){
                    //         if($p->is_autenticate == 0){
                    //             $status = '<span class="badge badge-info">Proses Autentifikasi<br/>Produk Hukum</span>';
                    //         }else{
                    //             if($p->is_finish == 0){
                    //                 $status = '<span class="badge badge-info">Proses Akhir Autentifikasi</span>';
                    //             }else{
                    //                 $status = '<span class="badge badge-success">Selesai</span>';
                    //                 if($p->is_private == 1)
                    //                     $status .= '<br/><small><i class="text-muted">Bersifat rahasia</i></small>';
                    //             }
                    //         }
                    //     }
                    //     return $status;
                    // })
                    ->addIndexColumn()
                    ->rawColumns(['id', 'aksi'])
                    ->make(true);
        }

        return view('frontend.halaman.index');
    }

    public function create()
    {
        $no_urut = Portal_Pages::orderBy('id','desc')->limit(1)->get();

        $year = date('Y-m-d');
        // $nomor = $this->getNoNotaDinas($id_jenis_sub, $year);
        return view('frontend.halaman.create', compact('no_urut', 'year'));
    }

    public function store(Request $request)
    {
        $data = $request->all();

        Portal_Pages::create($data);
        return response()->json(['message' => "Berhasil ubah data."]);
    }

    public function show($id)
    {
        // return Produk_hukum::with(['jenis_peraturan', 'jenis_peraturan_sub', 'upload_files'])->whereid_produk_hukum($id)->firstOrFail();
    }

    public function edit($id)
    {
        $data = Portal_Pages::findOrFail($id);

        return view('frontend.halaman.edit', compact('data'));

        // $data = Portal_Pages::where('id','=',$id)->get();

        // return view('frontend.halaman.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();

        $item = Portal_Pages::findOrFail($id);
        $item->update($data);
                
        return response()->json(['message' => "Berhasil ubah data."]);
    }

    public function destroy($id)
    {
        $data = Portal_Pages::findOrFail($id);
        $data->delete();

        if($data) {
            //return response()->json(['message' => "Berhasil Menghapus data"])    
            return redirect()->route('frontend.halaman.index')->with(['success' => 'Berhasil Menghapus data']);
        }else{
            // return response()->json(['message' => "Gagal Menghapus data!"])
            return redirect()->route('frontend.halaman.index')->with(['error' => 'Gagal Menghapus data']);
        }

        // return response()->json(['message' => "Berhasil Menghapus data"]);
        //return redirect()->route('frontend.halaman.index');
    }
}
