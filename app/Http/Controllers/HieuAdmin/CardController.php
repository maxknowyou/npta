<?php

namespace App\Http\Controllers\HieuAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Card;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class CardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function getview()
    {
        return view('Hieuadmin.card.card');
    }
    public function getlist()
    {
        $count1 = 1;
        $posts = Card::get();
        $data = [];
        foreach ($posts as $post) {
            $data2 = [];
            
            array_push($data2, $count1++, $post->name,$post->totalborrow,$post->validity,$post->valday,$post->active,$post->id);
            

            array_push($data,$data2);
        }
        echo json_encode($data);
    }
    public function PrepareEdit(Request $request)
    {
        $account = Card::where('id', $request->input('id'))->first();
        echo json_encode($account);
    }
    public function Edit(Request $request)
    {
        $account = Card::where('id', $request->input('id'))->first();
        $account->name = $request->get('name');
        $account->totalborrow = $request->get('totalborrow');
        $account->validity = $request->get('validity');
        $account->valday = $request->get('valday');
        $account->save();
        $mess = true;
        echo json_encode($mess);
    }
    public function Delete(Request $request)
    {
        $account = Card::where('id', $request->input('id'))->first();
        $account->active = 0;
        $account->save();
        $mess = true;
        echo json_encode($mess);
    }
    public function AddNew(Request $request)
    {
        $account = new Card([
            'name' => $request->get('name'),
            'totalborrow' => $request->get('totalborrow'),
            'validity' => $request->get('validity'),
            'valday' => $request->get('valday'),
            'active' => 1,
        ]);
        $account->save();
        
        $mess = true;
        echo json_encode($mess);
    }
}