<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Produk_hukum;
use App\Models\Instansi;
use App\Models\Jenis_peraturan;
use App\Models\Jenis_peraturan_sub;
use DataTables;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $title = "Laporan Produk Hukum";
        $ftahun_pembuatan = ($request->ftahun_pembuatan == null ? date('Y') : $request->ftahun_pembuatan);
        $finstansiname = $request->finstansiname;
        $fid_jenis = $request->fid_jenis;
        $fid_jenis_sub = $request->fid_jenis_sub;
        $fstatus = $request->fstatus;

        $filter = ($request->filter ? true : false);
        if ($request->ajax() && $filter == true) {
            $where = [];
            $where['jndih_produk_hukum.id_jenis'] = $fid_jenis;
            if($ftahun_pembuatan != ''){
                $where['jndih_produk_hukum.tahun_pembuatan'] = $ftahun_pembuatan;
            }
            if($finstansiname != ''){
                $where['jndih_produk_hukum.instansiname'] = $finstansiname;
            }
            if($fid_jenis_sub != ''){
                $where['jndih_produk_hukum.id_jenis_sub'] = $fid_jenis_sub;
            }
            if($fstatus != ''){
                switch($fstatus){
                    case 1:
                        $where['jndih_produk_hukum.is_pending'] = '1';
                        break;
                    case 2:
                        $where['jndih_produk_hukum.is_pending'] = '2';
                        break;
                    case 3:
                        $where['jndih_produk_hukum.is_pending'] = '0';
                        $where['jndih_produk_hukum.is_autenticate'] = '0';
                        break;
                    case 4:
                        $where['jndih_produk_hukum.is_pending'] = '0';
                        $where['jndih_produk_hukum.is_autenticate'] = '1';
                        break;
                }
            }

            $data = Produk_hukum::select(
                        'jndih_produk_hukum.*',
                        'm_jenis_peraturan_sub.name as n_sub')
                    ->join('m_jenis_peraturan_sub', 'jndih_produk_hukum.id_jenis_sub', '=', 'm_jenis_peraturan_sub.id_jenis_sub')
                    ->where($where)
                    ->orderBy('tahun_pembuatan', 'DESC')
                    ->orderBy('tgl_booking', 'DESC')
                    ->get();
            return DataTables::of($data)
                    ->editColumn('id', function($p){
                        return "<input type='checkbox' name='cbox[]' value='".$p->id_produk_hukum."' />";
                    })
                    ->editColumn('tentang', function($p){
                        return '<a href="#" onclick="show('.$p->id_produk_hukum.')">'.$p->tentang.'</a>';
                    })
                    ->editColumn('tgl_booking', function($p){
                        if($p->tgl_booking == "")
                            return '-';
                        return \Carbon\Carbon::parse($p->tgl_booking)->isoFormat('D MMM Y');
                    })
                    ->addColumn('n_status', function($p){
                        $status = '';
                        if($p->is_pending == 1){
                            $status = '<span class="badge badge-secondary">Pengajuan</span>';
                        }else if($p->is_pending == 2){
                            $status = '<span class="badge badge-warning">Diproses </span>';
                        }else if($p->is_pending == 0){
                            if($p->is_autenticate == 0){
                                $status = '<span class="badge badge-info">Proses Autentifikasi<br/> Produk Hukum</span>';
                            }else{
                                if($p->is_finish == 0){
                                    $status = '<span class="badge badge-info">Proses Akhir Autentifikasi</span>';
                                }else{
                                    $status = '<span class="badge badge-success">Selesai</span>';
                                    if($p->is_private == 1)
                                        $status .= '<br/><small><i class="text-muted"> Bersifat rahasia</i></small>';
                                }
                            }
                        }
                        return $status;
                    })
                    ->addIndexColumn()
                    ->rawColumns(['id', 'tentang', 'n_status'])
                    ->make(true);
        }


        $instansi = Instansi::orderBy('name', 'asc')->get();
        $peraturans = Jenis_peraturan::limit(1)->get();
        $peraturan_subs = Jenis_peraturan_sub::whereid_jenis($peraturans->first()->id_jenis)->whereIn('id_jenis_sub', [2,3,5])->get();
        $status = Produk_hukum::status();

        return view('report.index', compact('ftahun_pembuatan', 'finstansiname', 'fid_jenis', 'fid_jenis_sub', 'fstatus',
            'title', 'instansi', 'peraturans', 'peraturan_subs', 'status', 'filter'));
    }
}