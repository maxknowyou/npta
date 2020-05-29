<?php

namespace App\Http\Controllers\HieuAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Genre;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class GenreController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function getview()
    {
        return view('Hieuadmin.genre.genre');
    }
    public function getlist()
    {
        $count1 = 1;
        $posts = Genre::get();
        $data = [];
        foreach ($posts as $post) {
            $data2 = [];
            
            array_push($data2, $count1++, $post->name,$post->active,$post->id);
            

            array_push($data,$data2);
        }
        echo json_encode($data);
    }
    public function PrepareEdit(Request $request)
    {
        $account = Genre::where('id', $request->input('id'))->first();
        echo json_encode($account);
    }
    public function Edit(Request $request)
    {
        $account = Genre::where('id', $request->input('id'))->first();
        $account->name = $request->get('name');
        
        $account->save();
        $mess = true;
        echo json_encode($mess);
    }
    public function Delete(Request $request)
    {
        $account = Genre::where('id', $request->input('id'))->first();
        $account->active = 0;
        $account->save();
        $mess = true;
        echo json_encode($mess);
    }
    public function AddNew(Request $request)
    {
        $account = new Genre([
            'name' => $request->get('name'),
            'active' => 1,
        ]);
        $account->save();
        
        $mess = true;
        echo json_encode($mess);
    }
}