<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Category;
use App\Account;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class HelloController extends Controller
{
    public function getHello()
    {
        return view('admin.hello.hello');
    }
    public function getCategory()
    {
        $count1 = 1;
        $posts = Account::get();
        $data = [];
        foreach ($posts as $post) {
            $data2 = [];
            
            array_push($data2, $count1++, $post->username,$post->email,$post->active,$post->id);
            

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
        $account->username = $request->get('username');
        $account->password = $request->get('pwd');
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
            'username' => $request->get('username'),
            'password' => $request->get('pwd'),
            'active' => 1,
            'role' => $request->get('role'),
            'email' => $request->get('email'),
        ]);
        $account->save();
        
        $mess = true;
        echo json_encode($mess);
    }
}