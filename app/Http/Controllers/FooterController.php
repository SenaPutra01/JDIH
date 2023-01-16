<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

use App\Models\Portal_Footer;
use App\Models\Produk_hukum;
use DataTables;

class FooterController extends Controller
{
    public function index(Request $request)
    {
        $data   = Portal_Footer::all();

        return view('frontend.footer.edit', compact('data'));
    }

    public function create()
    {
        // $no_urut = Portal_Menu::orderBy('no_urut','desc')->limit(1)->get();

        // $year = date('Y-m-d');
        // // $nomor = $this->getNoNotaDinas($id_jenis_sub, $year);
        // return view('frontend.footer.create', compact('no_urut', 'year'));
    }

    public function store(Request $request)
    {
        // return redirect('https://google.com');
    }

    public function show($id)
    {
        // return Produk_hukum::with(['jenis_peraturan', 'jenis_peraturan_sub', 'upload_files'])->whereid_produk_hukum($id)->firstOrFail();
    }

    public function edit($id)
    {
        $data = Portal_Footer::where('id','=',$id)->get();

        return view('frontend.footer.edit', compact('data'), ['alert' => '']);
    }

    public function update(Request $request, $id)
    {
        Portal_Footer::where('id', $id)->update([
            'kiri_judul'        => $request->kiri_judul,
            'kiri_deskripsi'    => $request->kiri_deskripsi,
            'kanan_judul'       => $request->kanan_judul,
            'kanan_email'       => $request->kanan_email,
            'kanan_telepon'     => $request->kanan_telepon,
            'kanan_alamat'      => $request->kanan_alamat,
        ]);

        $data = Portal_Footer::where('id','=',$id)->get();
        // return response()->json(['message' => 'Data berhasil diubah']);
        return view('frontend.footer.edit', compact('data'), ['alert' => 'Data berhasil diubah']);
        // return redirect('https://google.com');
    }

    public function destroy($id)
    {
        //
    }
}