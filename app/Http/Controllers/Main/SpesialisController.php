<?php

namespace App\Http\Controllers\Main;

use App\Helper\CustomController;
use App\Http\Controllers\Controller;
use App\Model\Spesialis;
use Illuminate\Http\Request;

class SpesialisController extends CustomController
{
    //
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $spesialis = Spesialis::all();
        return view('main.spesialis.index')->with(['spesialis' => $spesialis]);
    }

    public function addForm()
    {
        return view('main.spesialis.add');
    }

    public function editForm($id)
    {
        $spesialis = Spesialis::where('id', '=', $id)->firstOrFail();
        return view('main.spesialis.edit')->with(['spesialis' => $spesialis]);
    }

    public function add()
    {
        $data = [
            'name' => $this->postField('name'),
        ];

        $this->insert(Spesialis::class, $data);
        return redirect()->back()->with(['success' => 'Success']);
    }

    public function patch()
    {
        $data = [
            'name' => $this->postField('name'),
        ];
        $this->update(Spesialis::class, $data);
        return redirect()->back()->with(['success' => 'Success']);
    }

    public function destroy($id)
    {
        try {
            Spesialis::destroy($id);
            return $this->jsonResponse('success delete', 200);
        } catch (\Exception $e) {
            return $this->jsonResponse('Failed delete', 500);
        }
    }
}
