<?php

namespace App\Http\Controllers\Main;

use App\Helper\CustomController;
use App\Http\Controllers\Controller;
use App\Model\Obat;
use Illuminate\Http\Request;

class ObatController extends CustomController
{
    //
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $obat = Obat::all();
        return view('main.obat.index')->with(['obat' => $obat]);
    }

    public function addForm()
    {
        return view('main.obat.add');
    }

    public function editForm($id)
    {
        $obat = Obat::where('id', '=', $id)->firstOrFail();
        return view('main.obat.edit')->with(['obat' => $obat]);
    }

    public function add()
    {
        $data = [
            'nama' => $this->postField('name'),
            'harga' => $this->postField('harga'),
        ];

        $this->insert(Obat::class, $data);
        return redirect()->back()->with(['success' => 'Success']);
    }

    public function patch()
    {
        $data = [
            'nama' => $this->postField('name'),
            'harga' => $this->postField('harga'),
        ];
        $this->update(Obat::class, $data);
        return redirect()->back()->with(['success' => 'Success']);
    }

    public function destroy($id)
    {
        try {
            Obat::destroy($id);
            return $this->jsonResponse('success delete', 200);
        } catch (\Exception $e) {
            return $this->jsonResponse('Failed delete', 500);
        }
    }
}
