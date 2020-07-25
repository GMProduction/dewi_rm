<?php

namespace App\Http\Controllers\Transaction;

use App\Helper\CustomController;
use App\Http\Controllers\Controller;
use App\Model\Diagnosa;
use App\Model\Dokter;
use App\Model\Obat;
use App\Model\Pasien;
use App\Model\Resep;
use App\Model\Spesialis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResepController extends CustomController
{
    //
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $resep = DB::table('resep as r')
            ->select(['diagnosa.no_diagnosa'])
            ->join('diagnosa', 'r.diagnosa_id', '=', 'diagnosa.id')
            ->selectRaw('SUM(harga * qty) as total')
            ->groupBy('diagnosa_id')->get();
        return view('transaksi.resep.index')->with(['resep' => $resep]);
    }

    public function addForm()
    {
        $diagnosa = Diagnosa::all();
        $obat = Obat::all();
        $resep = Resep::with('obat')->where('diagnosa_id', '=', null)->get();
        return view('transaksi.resep.add')->with(['diagnosa' => $diagnosa, 'obat' => $obat, 'resep' => $resep]);
    }

    public function add()
    {
        $obat = Obat::findOrFail($this->postField('obat'));
        $data = [
            'obat_id' => $this->postField('obat'),
            'qty' => $this->postField('qty'),
            'harga' => $obat->harga,
        ];
        $this->insert(resep::class, $data);
        return redirect()->back()->with(['success' => 'success']);
    }
    public function save()
    {
        $resep  = Resep::where('diagnosa_id', '=', null)->update(['diagnosa_id' => $this->postField('diagnosa')]);
        return redirect('/admin/');
    }

    public function destroyObat($id)
    {
        try {
            Resep::destroy($id);
            return $this->jsonResponse('success delete', 200);
        } catch (\Exception $e) {
            return $this->jsonResponse('Failed delete', 500);
        }
    }
}
