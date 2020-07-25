<?php

namespace App\Http\Controllers\User;

use App\Helper\CustomController;
use App\Http\Controllers\Controller;
use App\Model\Admin;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends CustomController
{
    //
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $admin = Admin::with(['user'])->get();
        return view('main.admin.index')->with(['admin' => $admin]);
    }

    public function addForm()
    {
        return view('main.admin.add');
    }

    public function editForm($id)
    {
        $admin = Admin::with('user')->where('id', '=', $id)->firstOrFail();
        return view('main.admin.edit')->with(['admin' => $admin]);
    }

    public function add()
    {
        $data = [
            'username' => $this->postField('username'),
            'password' => Hash::make($this->postField('password')),
            'level' => 'admin'
        ];

        $user = $this->insert(User::class, $data);
        $profile = [
            'user_id' => $user->id,
            'nama' => $this->postField('nama'),
        ];
        $this->insert(Admin::class, $profile);
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
            'user_id' => $user->id,
            'nama' => $this->postField('nama'),
        ];
        $profile = Admin::where('user_id', '=', $this->postField('id'))->firstOrFail();
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
