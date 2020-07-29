<?php

namespace App\Http\Controllers\Transaction;

use App\Helper\CustomController;
use App\Http\Controllers\Controller;
use App\Model\Diagnosa;
use App\Model\Dokter;
use App\Model\Pasien;
use App\Model\Spesialis;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class DiagnosaController extends CustomController
{
    //

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $diagnosa = Diagnosa::with(['dokter', 'pasien'])->get();
//        dd($diagnosa->toArray());
        return view('transaksi.diagnosa.index')->with(['diagnosa' => $diagnosa]);
    }

    public function formLaporan()
    {
        return view('main.laporan.diagnosa');
    }
    public function laporan()
    {
        $tgl1 = $this->field('tgl1') ?? Carbon::now();
        $tgl2 = $this->field('tgl2') ?? Carbon::now();
        $diagnosa = Diagnosa::with(['dokter', 'pasien'])->whereBetween('created_at', [$tgl1, $tgl2])->get();
        return DataTables::of($diagnosa)
            ->addIndexColumn()
            ->editColumn('diagnosa', function ($diagnosa) {
                return hex2bin($diagnosa->diagnosa);
            })
            ->editColumn('pasien.nama', function ($diagnosa) {
                return hex2bin($diagnosa->pasien->nama);
            })
            ->make(true);
    }

    public function cetak()
    {
        $tgl1 = $this->field('tgl1') ?? Carbon::now();
        $tgl2 = $this->field('tgl2') ?? Carbon::now();
        $diagnosa = Diagnosa::with(['dokter', 'pasien'])->whereBetween('created_at', [$tgl1, $tgl2])->get();
        return $this->convertToPdf('cetak.diagnosa', ['diagnosa' => $diagnosa, 'tgl1' => $tgl1, 'tgl2' => $tgl2]);
    }

    public function addForm()
    {
        $dokter = Dokter::all();
        $pasien = Pasien::all();
        return view('transaksi.diagnosa.add')->with(['dokter' => $dokter, 'pasien' => $pasien]);
    }

    public function add()
    {
        $data = [
            'dokter_id' => $this->postField('dokter'),
            'pasien_id' => $this->postField('pasien'),
            'diagnosa' => bin2hex($this->postField('diagnosa')),
            'no_diagnosa' => 'DIAG-' . date('YmdHis'),
        ];
        $this->insert(Diagnosa::class, $data);
        return redirect('/admin/diagnosa');
    }
}
