<?php

namespace App\Http\Controllers\User;

use App\Helper\CustomController;
use App\Http\Controllers\Controller;
use App\Model\Pasien;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PasienController extends CustomController
{
    //
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $pasiens = Pasien::with('user')->get();
        return view('main.pasien.index')->with(['pasiens' => $pasiens]);
    }

    public function addForm()
    {
        return view('main.pasien.add');
    }

    public function editForm($id)
    {
        $pasien = Pasien::with('user')->where('id', '=', $id)->firstOrFail();
        return view('main.pasien.edit')->with(['pasien' => $pasien]);
    }

    public function add()
    {
        $data = [
            'username' => $this->postField('username'),
            'password' => Hash::make($this->postField('password')),
            'level' => 'pasien'
        ];

        $user = $this->insert(User::class, $data);
        $profile = [
            'user_id' => $user->id,
            'nama' => bin2hex($this->postField('nama')),
            'alamat' => $this->postField('alamat'),
            'tgl_lahir' => $this->postField('tanggal'),
            'jenis_kelamin' => $this->postField('jenis_kelamin'),
        ];
        $this->insert(Pasien::class, $profile);
        return redirect()->back()->with(['success' => 'Berhasil Menyimpan Data Pasien!']);
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
            'alamat' => $this->postField('alamat'),
            'tgl_lahir' => $this->postField('tanggal'),
            'jenis_kelamin' => $this->postField('jenis_kelamin'),
        ];
        $profile = Pasien::where('user_id', '=', $this->postField('id'))->firstOrFail();
        $this->customUpdate($profile, $dataprofile);
        return redirect()->back()->with(['success' => 'Berhasil Menyimpan Data Pasien!']);
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
