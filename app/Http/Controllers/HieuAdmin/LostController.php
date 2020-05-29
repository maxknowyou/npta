<?php

namespace App\Http\Controllers\HieuAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Lost;
use App\Book;
use App\Student;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class LostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function getview()
    {
        return view('Hieuadmin.lost.lost');
    }
    public function getlist()
    {
        $count1 = 1;
        $books = Book::get();
        $students = Student::get();
        $posts = Lost::get();
        $data = [];
        foreach ($posts as $post) {
            $data2 = [];
            
            array_push($data2, $count1++,
            $students->where('id',$post->studentid)->first()->name,
            $books->where('id',$post->bookid)->first()->name,            
            $post->time,$post->status,$post->active,$post->id);
            

            array_push($data,$data2);
        }
        echo json_encode($data);
    }
    public function PrepareEdit(Request $request)
    {
        $account = Lost::where('id', $request->input('id'))->first();
        echo json_encode($account);
    }
    public function Edit(Request $request)
    {
        $account = Lost::where('id', $request->input('id'))->first();
        $account->studentid = $request->get('student');
        $account->bookid = $request->get('book');
        $account->status = $request->get('status');
        $account->time = $request->get('time');
        $account->save();
        $mess = true;
        echo json_encode($mess);
    }
    public function Delete(Request $request)
    {
        $account = Lost::where('id', $request->input('id'))->first();
        $account->active = 0;
        $account->save();
        $mess = true;
        echo json_encode($mess);
    }
    public function AddNew(Request $request)
    {
        foreach ($request->get('book') as $book) {
            $account = new Lost([
                'studentid' => $request->get('student'),
                'bookid' => (int)$book,
                'amount' => 1,
                'time' => $request->get('time'),
                'status' => $request->get('status'),
                'active' => 1,
            ]);
            $account->save();
        }
        
        $mess = true;
        echo json_encode($mess);
    }
}