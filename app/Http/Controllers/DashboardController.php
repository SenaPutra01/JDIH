<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Produk_hukum;
use App\Models\Instansi;

class DashboardController extends Controller
{
    public function where($ins){
        $where = [];
        $where['jndih_produk_hukum.id_jenis'] = 1;
        $instansiname = Auth::user()->instansiname;
        if($instansiname != ""){
            $where['instansiname'] = $instansiname;
        }else{
            if($ins != ""){
                $where['instansiname'] = $ins;
            }
        }
        return $where;
    }

    public function index(Request $request)
    {       
        $year = ($request->year == null ? date('Y') : $request->year);

        $ins = $request->ins;
        $where = $this->where($ins);
        
        $booking = Produk_hukum::select('id_produk_hukum')
                        ->whereYear('created_at', $year)
                        ->whereis_pending('1')
                        ->where($where)
                        ->count();
        $create = Produk_hukum::select('id_produk_hukum')
                        ->whereYear('created_at', $year)
                        ->whereis_pending('2')
                        ->where($where)
                        ->count();
        $auten = Produk_hukum::select('id_produk_hukum')
                        ->whereYear('created_at', $year)
                        ->whereis_pending('0')
                        ->whereis_finish('0')
                        ->where($where)
                        ->count();
        $finish = Produk_hukum::select('id_produk_hukum')
                        ->whereYear('created_at', $year)
                        ->whereis_pending('0')
                        ->whereis_finish('1')
                        ->where($where)
                        ->count();

        $instansi = Instansi::orderBy('name', 'asc')->get();
        return view('dashboard', compact('year', 'booking', 'create', 'auten', 'finish',
            'instansi', 'ins'));
    }

    public function getAreaChart($year, $ins="")
    {
        $where = $this->where($ins);

        $res = [];
        for($i = 1; $i<13; $i++){
            $res[] = Produk_hukum::select('id_produk_hukum')
                        ->whereYear('created_at', $year)
                        ->whereMonth('created_at', $i)
                        ->where($where)
                        ->count();
        }

        return response()->json(['data' => $res]);
    }

    public function getAreaPie($year, $ins="")
    {
        $where = $this->where($ins);

        $p = Produk_hukum::selectRaw('COUNT(jndih_produk_hukum.id_produk_hukum) as c, m_jenis_peraturan_sub.name as n_sub')
                        ->whereYear('created_at', $year)
                        ->where($where)
                        ->join('m_jenis_peraturan_sub', 'jndih_produk_hukum.id_jenis_sub', '=', 'm_jenis_peraturan_sub.id_jenis_sub')
                        ->groupBy('jndih_produk_hukum.id_jenis_sub')
                        ->get();
        return response()->json(['data' => $p]);
    }

}
