<?php

namespace App\Http\Controllers\Laporan;

use App\Helper\CustomController;
use App\Http\Controllers\Controller;
use App\Model\Diagnosa;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class RekamMedisController extends CustomController
{
    //
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        return view('main.laporan.rekam');
    }

    public function laporan()
    {
        $tgl1 = $this->field('tgl1') ?? Carbon::now();
        $tgl2 = $this->field('tgl2') ?? Carbon::now();
        $diagnosa = Diagnosa::with(['dokter.spesialis', 'pasien', 'resep.obat'])->get();
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
//        $filter = $this->field('filter') ?? '';
        $diagnosa = Diagnosa::with(['dokter.spesialis', 'pasien', 'resep.obat'])->get();
        return $this->convertToPdf('cetak.fullrekam', ['diagnosa' => $diagnosa, 'tgl1' => $tgl1, 'tgl2' => $tgl2]);
    }
}
