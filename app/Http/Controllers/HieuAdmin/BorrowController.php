<?php
namespace App\Http\Controllers\HieuAdmin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Student;
use App\Card;
use App\Book;
use App\Borrow;
use App\Lost;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class BorrowController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function getview()
    {
        return view('Hieuadmin.borrow.borrow');
    }
    public function getlist()
    {
        $count1 = 1;
        $books = Book::get();
        $students = Student::get();
        $list = Borrow::get();
        $data = [];
        foreach ($list as $item) {
            $data2 = [];
            array_push($data2, $count1++, 
                        $students->where('id',$item->studentid)->first()->name,
                        $books->where('id',$item->bookid)->first()->name,
                        $item->from,
                        $item->to,
                        $item->status,
                        $item->returnday != null ? $item->returnday : '--',
                        $item->active,
                        $item->id);
            array_push($data,$data2);
        }
        echo json_encode($data);
    }
    public function getdetaillist()
    {
        $book = Book::get();
        $student = Student::get();
        $card = Card::get();
        $data = [];
        foreach ($student as $item) {
            $data2 = [];
            array_push($data2, 
                        $item->id,
                        $item->name,
                        $card->where('id',$item->cardid)->first()->valday,
                        );
            array_push($data,$data2);
        }
        $json_data = array(
            "book"   => $book,  
            "student"    => $data,  
            );
        echo json_encode($json_data);
    }
    
    public function PrepareEdit(Request $request)
    {
        $account = Borrow::where('id', $request->input('id'))->first();
        echo json_encode($account);
    }
    public function Edit(Request $request)
    {
        $account = Borrow::where('id', $request->input('id'))->first();
        $account->studentid = $request->get('student');
        $account->bookid = $request->get('book');
        $account->from = $request->get('from');
        $account->to = $request->get('to');
        $account->status = $request->get('status');
        if($request->get('status') == 2)
        {
            $account->returnday = $request->get('returnday');
        }
        $account->save();
        $mess = true;
        echo json_encode($mess);
    }
    public function Delete(Request $request)
    {
        $account = Borrow::where('id', $request->input('id'))->first();
        $account->active = 0;
        $account->save();
        $mess = true;
        echo json_encode($mess);
    }
    public function Lost(Request $request)
    {
        $account = Borrow::where('id', $request->input('id'))->first();
        $account->status = 3;
        $account->save();
        $lost = new Lost([
            'studentid' => $account->studentid,
            'bookid' => $account->bookid,
            'amount' => 1,
            'status' => 1,
            'time' => date("Y-m-d"),
            'active' => 1,
        ]);
        $lost->save();
        $mess = true;
        echo json_encode($mess);
    }
    public function Return(Request $request)
    {
        $account = Borrow::where('id', $request->input('id'))->first();
        $account->status = 2;
        $account->returnday = date("Y-m-d");
        $account->save();
        $mess = true;
        echo json_encode($mess);
    }
    public function AddNew(Request $request)
    {
        foreach ($request->get('book') as $book) {
            $account = new Borrow([
                'studentid' => $request->get('student'),
                'bookid' => (int)$book,
                'amount' => 1,
                'from' => $request->get('from'),
                'to' => $request->get('to'),
                'status' => $request->get('status'),
                'active' => 1,
            ]);
            $account->save();
        }
        $mess = true;
        echo json_encode($mess);
    }
}