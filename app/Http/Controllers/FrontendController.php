<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\Models\Portal_Opini;
use App\Models\Produk_hukum;
use App\Models\Jenis_peraturan_sub;
use App\Models\Portal_Menu;
use App\Models\Portal_SubMenu;
use App\Models\Portal_Sub_SubMenu;
use App\Models\Portal_Pages;
use App\Models\Portal_Berita;
use App\Models\Portal_Footer;

class FrontendController extends Controller
{
    public function index(){
        $menu           = Portal_Menu::orderBy('no_urut','asc')->get();
        $submenu        = Portal_SubMenu::orderBy('no_urut','asc')->get();
        $sub_submenu    = Portal_Sub_SubMenu::orderBy('no_urut','asc')->get();
        $opini          = Portal_Opini::limit(6)->get();
        $produk_hukum   = Produk_hukum::orderBy('tgl_penetapan','desc')->limit(6)->get();
        $nama_peraturan = Jenis_peraturan_sub::all();
        $berita         = Portal_Berita::orderBy('id_news','desc')->limit(8)->get();
        $footer         = Portal_Footer::all();

        $perda  = Produk_hukum::where('id_jenis','=','1')->where('id_jenis_sub','=','2')->count();
        $perwal = Produk_hukum::where('id_jenis','=','1')->where('id_jenis_sub','=','3')->count();
        $kepwal = Produk_hukum::where('id_jenis','=','1')->where('id_jenis_sub','=','5')->count();
        $se     = Produk_hukum::where('id_jenis','=','7')->where('id_jenis_sub','=','30')->count();

        return view('frontend.home', compact('menu','submenu','sub_submenu','opini','produk_hukum','nama_peraturan','berita','footer','perda','perwal','kepwal','se'));
    }

    public function pages(){
        $menu           = Portal_Menu::orderBy('no_urut','asc')->get();
        $submenu        = Portal_SubMenu::orderBy('no_urut','asc')->get();
        $sub_submenu    = Portal_Sub_SubMenu::orderBy('no_urut','asc')->get();
        $pages          = Portal_Pages::all();
        $footer         = Portal_Footer::all();

        return view('frontend.pages', compact('menu','submenu','sub_submenu','pages','footer'));
    }

    public function page($slug)
    {
        $post = Post::where('slug', $slug)->where('type', 'page')->first();
        $breadcrumbs = ['Page', $post->title];
        if (!$post || $post->status == "Draft") {
            return abort(404);
        }
        return view('front.custom_page.page', compact('post', 'breadcrumbs'));
    }
}
