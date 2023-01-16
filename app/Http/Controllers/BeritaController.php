<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

use App\Models\Portal_Berita;
use App\Models\Portal_Footer;
use App\Models\Produk_hukum;

use DataTables;

class BeritaController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Portal_Berita::select('id_news','id_kategory','title','hits_count','created_at','updated_at')
                    ->orderBy('id_news','desc')
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
                            <a href="berita/'.$p->id_news.'/edit" class="btn btn-primary btn-sm"><i class="fas fa-fw fa-pen"></i></a>
                            <a href="#" class="btn btn-danger btn-sm"><i class="fas fa-fw fa-trash"></i></a>';
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

        return view('frontend.berita.index');
    }

    public function create()
    {
        $no_urut = Portal_Berita::orderBy('id_news','desc')->limit(1)->get();

        $year = date('Y-m-d');
        // $nomor = $this->getNoNotaDinas($id_jenis_sub, $year);
        return view('frontend.berita.create', compact('no_urut', 'year'));
    }

    public function store(Request $request)
    {

    }

    public function show($id)
    {
        // return Produk_hukum::with(['jenis_peraturan', 'jenis_peraturan_sub', 'upload_files'])->whereid_produk_hukum($id)->firstOrFail();
    }

    public function edit($id)
    {
        $data = Portal_Berita::where('id_news','=',$id)->get();

        return view('frontend.berita.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        Portal_Footer::where('id', 1)->update([
            'kiri_judul'        => $request->kiri_judul,
            'kiri_deskripsi'    => $request->kiri_deskripsi,
            'kanan_judul'       => $request->kanan_judul,
            'kanan_email'       => $request->kanan_email,
            'kanan_telepon'     => $request->kanan_telepon,
            'kanan_alamat'      => $request->kanan_alamat,
        ]);

        return response()->json(['message' => "Berhasil ubah data."]);
        // return view('frontend.footer.edit', compact('data'))->with('Berhasil ubah data');
    }

    public function destroy($id)
    {
        //
    }

    public function berita($slug)
    {
        $post = Post::where('slug', $slug)->where('type', 'blog')->first();
        $breadcrumbs = ['Blog', $post->title];
        if (!$post || $post->status == "Draft") {
            return abort(404);
        }
        return view('front.blog.details', compact('post', 'breadcrumbs'));
    }
    public function berita_all()
    {
        $title = "All Posts";
        $posts = Post::orderBy('id', 'DESC')->where(['type' => 'blog', 'status' => 'Publish'])->with(['category'])->paginate(5);
        // dd($posts);
        $breadcrumbs = ['Blog'];
        return view('front.blog.all', compact('posts', 'breadcrumbs', 'title'));
    }
    public function berita_category($slug)
    {
        $category = Category::where('slug', $slug)->first();
        if (!$category) {
            return abort(404);
        }
        $title = "Category Blog " . $category->nama;
        $posts = Post::orderBy('id', 'DESC')->where(['type' => 'blog', 'status' => 'Publish', 'post_category_id' => $category->id])->with(['category'])->paginate(5);
        // dd($posts);
        $breadcrumbs = ['Blog', 'Category ' . $category->nama];
        return view('front.blog.all', compact('posts', 'breadcrumbs', 'title'));
    }
}
