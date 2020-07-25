<?php

namespace App\Http\Controllers\Transaction;

use App\Helper\CustomController;
use App\Http\Controllers\Controller;
use App\Model\Diagnosa;
use App\Model\Dokter;
use App\Model\Pasien;
use App\Model\Spesialis;
use Illuminate\Http\Request;

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
