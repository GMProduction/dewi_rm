<?php

namespace App\Http\Controllers\User;

use App\Helper\CustomController;
use App\Http\Controllers\Controller;
use App\Model\Dokter;
use App\Model\Spesialis;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DokterController extends CustomController
{
    //
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $dokters = Dokter::with(['user', 'spesialis'])->get();
        return view('main.dokter.index')->with(['dokters' => $dokters]);
    }

    public function addForm()
    {
        $spesialis = Spesialis::all();
        return view('main.dokter.add')->with(['spesialis' => $spesialis]);
    }

    public function editForm($id)
    {
        $dokters = Dokter::with(['user', 'spesialis'])->where('id', '=', $id)->firstOrFail();
        $spesialis = Spesialis::all();
        return view('main.dokter.edit')->with(['dokter' => $dokters, 'spesialis' => $spesialis]);
    }

    public function add()
    {
        $data = [
            'username' => $this->postField('username'),
            'password' => Hash::make($this->postField('password')),
            'level' => 'dokter'
        ];

        $user = $this->insert(User::class, $data);
        $profile = [
            'user_id' => $user->id,
            'nama' => $this->postField('nama'),
            'spesialis_id' => $this->postField('spesialis')
        ];
        $this->insert(Dokter::class, $profile);
        return redirect()->back()->with(['success' => 'Success']);
    }

    public function patch()
    {
        $data = [
            'username' => $this->postField('username'),
        ];

        $user = User::find($this->postField('id'));
        $this->customUpdate($user, $data);
        $dataprofile = [
            'nama' => $this->postField('nama'),
            'spesialis_id' => $this->postField('spesialis')
        ];
        $profile = Dokter::where('user_id', '=', $this->postField('id'))->firstOrFail();
        $this->customUpdate($profile, $dataprofile);
        return redirect()->back()->with(['success' => 'Success']);
    }

    public function destroy($id)
    {
        try {
            User::destroy($id);
            return $this->jsonResponse('success delete', 200);
        }catch (\Exception $e){
            return $this->jsonResponse('Failed delete', 500);
        }
    }
}
