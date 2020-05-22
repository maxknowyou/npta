<?php

namespace App\Http\Controllers\HieuAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Book;
use App\Genre;
use App\GOB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class BookController extends Controller
{
    public function getview()
    {
        return view('Hieuadmin.book.book');
    }
    public function getlist()
    {
        $count1 = 1;
        $posts = Book::where('active',1)->get();
        $data = [];
        foreach ($posts as $post) {
            $data2 = [];
            array_push($data2, $count1++, $post->name,$post->author,$post->bookshelves,$post->total,$post->active,$post->id);
            array_push($data,$data2);
        }
        echo json_encode($data);
    }
    public function getgenrelist()
    {
        $posts = Genre::get();
        echo json_encode($posts);
    }
    public function PrepareEdit(Request $request)
    {
        $books = Book::where('id', $request->input('id'))->where('active',1)->first();
        $gob = GOB::where('bookid',$request->input('id'))->where('active',1)->get();
        $data = [];
        foreach ($gob as $genre) {
            array_push($data,$genre->genreid);
        }
        $json_data = array(
            "book"   => $books,  
            "gob"    => $data,  
            );
        echo json_encode($json_data);
    }
    public function Edit(Request $request)
    {
        $book = Book::where('id', $request->input('id'))->first();
        $book->name = $request->get('name');
        $book->bookshelves = $request->get('shelf');
        $book->author = $request->get('author');
        $book->total = $request->get('total');
        $book->description = $request->get('des');
        $book->save();
        $gob = GOB::where('bookid',$request->input('id'))->where('active',1)->get();
        
        foreach ($gob as $genre) {
            
            if(!in_array(strval($genre->genreid),$request->get('genre')))
            {
                $genre->active = 0;
                $genre->save();
            }
        }
        foreach ($request->get('genre') as $genre) {
            $de = $gob->where('genreid',(int)$genre)->first();
            if($de == null)
            {
                $gob = new GOB([
                    'bookid' =>$request->input('id'),
                    'genreid' => (int)$genre,
                    'active' => 1,
                ]);
                $gob->save();
            }
        }
        
        $mess = true;
        echo json_encode($mess);
    }
    public function Delete(Request $request)
    {
        $book = Book::where('id', $request->input('id'))->first();
        $book->active = 0;
        $book->save();
        $mess = true;
        echo json_encode($mess);
    }
    public function AddNew(Request $request)
    {
        $book = new Book([
            'name' => $request->get('name'),
            'bookshelves' => $request->get('shelf'),
            'active' => 1,
            'author' => $request->get('author'),
            'total' => $request->get('total'),
            'description' => $request->get('des'),
        ]);
        $book->save();
        $id = $book->id;
        
        foreach ($request->get('genre') as $genre) {
            $gob = new GOB([
                'bookid' =>$id,
                'genreid' => (int)$genre,
                'active' => 1,
                
            ]);
            $gob->save();
        }
        $mess = true;
        echo json_encode($mess);
    }
}