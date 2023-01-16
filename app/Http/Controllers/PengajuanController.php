<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

use App\Models\Jenis_peraturan;
use App\Models\Jenis_peraturan_sub;
use App\Models\Jenis_peraturan_sub_syarat;
use App\Models\Auto_number;
use App\Models\Produk_hukum;
use App\Models\Upload_file;
use DataTables;

class PengajuanController extends Controller
{
    public function index(Request $request)
    {	
        if ($request->ajax()) {
            $data = Produk_hukum::select(
                        'jndih_produk_hukum.*',
                        'm_jenis_peraturan_sub.name as n_sub')
                    ->join('m_jenis_peraturan_sub', 'jndih_produk_hukum.id_jenis_sub', '=', 'm_jenis_peraturan_sub.id_jenis_sub')
                    ->whereinstansiname(Auth::user()->instansiname)
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
                                $status = '<span class="badge badge-info">Proses Autentifikasi<br/>Produk Hukum</span>';
                            }else{
                                if($p->is_finish == 0){
                                    $status = '<span class="badge badge-info">Proses Akhir Autentifikasi</span>';
                                }else{
                                    $status = '<span class="badge badge-success">Selesai</span>';
                                    if($p->is_private == 1)
                                        $status .= '<br/><small><i class="text-muted">Bersifat rahasia</i></small>';
                                }
                            }
                        }
                        return $status;
                    })
                    ->addIndexColumn()
                    ->rawColumns(['id', 'tentang', 'n_status'])
                    ->make(true);
        }

        return view('pengajuan.index');
    }

    public function create()
    {
        $peraturans = Jenis_peraturan::limit(1)->get();
        $peraturan_subs = Jenis_peraturan_sub::whereid_jenis($peraturans->first()->id_jenis)->whereIn('id_jenis_sub', [2,3,5])->get();
        $id_jenis_sub = $peraturan_subs->first()->id_jenis_sub;
        $peraturan_sub_syarats = Jenis_peraturan_sub_syarat::whereid_jenis_sub($id_jenis_sub)->wherec_show(1)->orderBy('seq', 'asc')->get();

        $year = date('Y-m-d');
        $nomor = $this->getNoNotaDinas($id_jenis_sub, $year);
        return view('pengajuan.create', compact('peraturans', 'peraturan_subs', 'peraturan_sub_syarats',
            'year', 'nomor'));
    }

    public function store(Request $request)
    {

        // Validate
        $request->validate([
            'tentang' => 'required',
            'id_jenis' => 'required',
            'id_jenis_sub' => 'required',
            'tgl_booking' => 'required',
            'tahun_pembuatan' => 'required',
            'instansiname' => 'required',
	        'narahubung' => 'required'
        ]);

        // Cek Tentang & Tahun & Instansi
        $c = Produk_hukum::wheretentang($request->tentang)
                    ->whereid_jenis_sub($request->id_jenis_sub)
                    ->whereinstansiname($request->instansiname)
                    ->first();
        if($c)
            return response()->json(['message' => "Tentang sudah pernah disimpan."], 422);

        // Cek Uploadan
        $rules = [];
        $peraturan_sub_syarats = Jenis_peraturan_sub_syarat::whereid_jenis_sub($request->id_jenis_sub)->wherec_show(1)->orderBy('seq', 'asc')->get();
        foreach($peraturan_sub_syarats as $sub){
            if($sub->c_required)
            {
                // $request->validate(['syarat.'.$peraturan_sub_syarat->id_jenis_sub_syarat => 'required|file|mimes:'.$peraturan_sub_syarat->ext]);
                $rules['syarat.'.$sub->id_jenis_sub_syarat] = 'required|file|mimes:'.$sub->ext;
            }
        }
        if(count($rules) > 0) $request->validate($rules);

        // Save
        $folder_path = "assets/".$this->global_get_random(4,10)."/";
        $no_ld = "";
        $no_tld = "";
        $no_bd = "";
        $no_tbd = "";
        $no_ll = "";
        $no_kepwal = "";
        $detail_sub = Jenis_peraturan_sub::select('name', 'id_jenis_sub', 'show_ld', 'show_tld', 'show_bd', 'show_tbd', 'show_ll', 'show_kepwal', 'show_lampiran')
                            ->whereid_jenis_sub($request->id_jenis_sub)
                            ->first();
        if($detail_sub){
            if($detail_sub->show_ld == "1"){ $no_ld = Auto_number::nomor_save("No LD"); }
            if($detail_sub->show_tld == "1"){ $no_tld = Auto_number::nomor_save("No TLD"); }
            if($detail_sub->show_bd == "1"){ $no_bd = Auto_number::nomor_save("No BD"); }
            if($detail_sub->show_tbd == "1"){ $no_tbd = Auto_number::nomor_save("No TBD"); }
            if($detail_sub->show_ll == "1"){ $no_ll = Auto_number::nomor_save("No LL"); }
            if($detail_sub->show_kepwal == "1"){ $no_kepwal = Auto_number::nomor_save("No Kepwal"); }
        }

        $user = Auth::user();
        $inp = $request->only('tentang', 'id_jenis', 'id_jenis_sub', 'tgl_booking', 'tahun_pembuatan', 'instansiname', 'note', 'narahubung');
        $inp['code_render']     = $this->renderAutoNumber();
        $inp['is_booking']      = '1';
        //$inp['no_produk_hukum'] = (int) Auto_number::nomor_save('Sub Jenis'.$request->id_jenis_sub, $request->tahun_pembuatan);
		$inp['no_produk_hukum']	= $request->no_produk_hukum;
        $inp['is_pending']      = '1';
        $inp['path_files']      = $folder_path;
        $inp['name_pemberi']    = $user->first_name.' '.$user->last_name;
        $inp['name_penerima']   = '';
        $inp['no_ld']           = (int) $no_ld;
        $inp['no_tld']          = (int) $no_tld;
        $inp['no_bd']           = (int) $no_bd;
        $inp['no_tbd']          = (int) $no_tbd;
        $inp['no_ll']           = (int) $no_ll;
        $inp['no_kepwal']       = (int) $no_kepwal;
        $inp['id_user']         = $user->id;
        $produk_hukum           = Produk_hukum::create($inp);

        $syarat = $request->syarat;
        $jenis_sub = Jenis_peraturan_sub::select('id_jenis_sub', 'initial')->whereid_jenis_sub($request->id_jenis_sub)->first();
        foreach($peraturan_sub_syarats as $sub)
        {

            if(!empty($syarat[$sub->id_jenis_sub_syarat]))
            {

                // Upload
                $type = '.'.$syarat[$sub->id_jenis_sub_syarat]->getClientOriginalExtension();
                $namafile = date('Y') . $jenis_sub->initial . 'tangselkota'.date('mdhis').$jenis_sub->id_jenis_sub.$type;
                $syarat[$sub->id_jenis_sub_syarat]->storeAs($folder_path.'skpd/', $namafile, 'sftp');

                Upload_file::create([
                    'id_produk_hukum' => $produk_hukum->id_produk_hukum,
                    'file_for' => 'skpd',
                    'filename' => $sub->name.' - '.$syarat[$sub->id_jenis_sub_syarat]->getClientOriginalName(),
                    'filename_type' => $type,
                    'filename_size' => $syarat[$sub->id_jenis_sub_syarat]->getSize(),
                    'file_name_server' => $namafile,
                    'path_files' => $folder_path,
                    'folder_files' => 'skpd/',
                    'countdownload' => 0,
                    'descriptions' => $request->ip(),
                    'is_dropable' => 1,
                    'created_at' => date('Y-m-d H:i:s')
                ]);
            }
        }

		$to_name = "JDIH";
		$to_email = env('MAIL_NOTIFICATION');
		$data = [
			'n_sub' => $detail_sub->name,
			'tentang' => $request->tentang,
			'pd' => Auth::user()->instansiname,
			'narahubung' => $request->narahubung
		];
		Mail::send('emails.mail', $data, function($message) use ($to_name, $to_email) {
			$message->to($to_email, $to_name)->subject("JDIH Tangsel | Pengajuan Produk Hukum");
			$message->from(env('MAIL_USERNAME'), "JDIH Mail Notification");
		});
		
        return response()->json(['message' => "Pengajuan berhasil terkirim."]);
    }

    public function show($id)
    {
        return Produk_hukum::with(['jenis_peraturan', 'jenis_peraturan_sub', 'upload_files'])->whereid_produk_hukum($id)->firstOrFail();
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    public function getPeraturanSub($id_jenis)
    {
        return Jenis_peraturan_sub::whereid_jenis($id_jenis)->get();
    }

    public function getPeraturanSubSyarat($id_jenis_sub)
    {
        return Jenis_peraturan_sub_syarat::whereid_jenis_sub($id_jenis_sub)->wherec_show(1)->orderBy('seq', 'asc')->get();
    }

    public function getNoNotaDinas($id_jenis_sub, $year)
    {
        return Auto_number::nomor('Sub Jenis'.$id_jenis_sub, $year);
    }

    public function renderAutoNumber()
    {
        $subject = "/JDIH/";
        $begin_string = "TANGSEL";
        $no = Auto_number::nomor_saveDigit($subject);
        $number = $begin_string.$subject.$no;
        return $number;
    }

    public function global_get_random($type=0,$panjang=10)
    {
        $kalimat = "1Qq2fWwg3eEh4jRtd5akTGFDSAZXCVBNMzsHr6JxKYLlcy7UmivP8InpOub9o";
        if($type == 1){
            $kalimat = "0123456789";
        }else if($type == 2){
            $kalimat = "ASDFGHJKLQWERTYUIOPZXCVBNM";
        }else if($type == 3){
            $kalimat = "!@#$&^*()+=[]{}ASDFGHJKLQWERTYUIOPZXCVBNMmnbvcxzasdfghjklpoiuytrewq0123456789";
        }
        $pnj = strlen($kalimat);
        //srand((double)microtime() * 1000000);
        $unikhasil="";
        for($i = 1;$i <= $panjang;$i++){
            $mulai = rand(0,$pnj);
            $unikhasil .= substr($kalimat,$mulai,1);
        }
        return $unikhasil;
    }
}
