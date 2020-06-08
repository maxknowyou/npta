<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Account;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function getview()
    {
        return view('admin.user.user');
    }
    public function getUser()
    {
        $count1 = 1;
        $posts = Account::get();
        $data = [];
        foreach ($posts as $post) {
            $data2 = [];
            
            array_push($data2, $count1++, $post->name,$post->email,$post->role,$post->active,$post->id);
            array_push($data,$data2);
        }
        echo json_encode($data);
    }
    public function PrepareEdit(Request $request)
    {
        $account = Account::where('id', $request->input('id'))->first();
        echo json_encode($account);
    }
    public function Edit(Request $request)
    {
        
         $account = Account::where('id', $request->input('id'))->first();
        $account->name = $request->get('username');
        //$account->password = Hash::make($request->get('pwd'));
        $account->email = $request->get('email');
        $account->role = $request->get('role');
        
        $account->save();
        $mess = true;
        echo json_encode($mess);
    }
    public function Delete(Request $request)
    {
        $account = Account::where('id', $request->input('id'))->first();
        $account->active = 0;
        $account->save();
        $mess = true;
        echo json_encode($mess);
    }
    public function AddNew(Request $request)
    {
       $account = new Account([
            'name' => $request->get('username'),
            'password' => Hash::make($request->get('pwd')),
            'active' => 1,
            'role' => $request->get('role'),
            'email' => $request->get('email'),
        ]);
        $account->save();
        
        $mess = true;
        echo json_encode($mess);
    }
}