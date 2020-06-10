<?php
namespace App\Http\Controllers\HieuAdmin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Student;
use App\Card;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function getview()
    {
        return view('Hieuadmin.student.student');
    }
    public function getlist()
    {
        $count1 = 1;
        $posts = Card::get();
        $students = Student::get();
        $data = [];
        foreach ($students as $student) {
            $data2 = [];
            array_push($data2, $count1++, 
                        $student->name,
                        $student->code,
                        $student->dob,
                        $student->sex,
                        $posts->where('id',$student->cardid)->first()->name,
                        $student->start,
                        $student->active,
                        $student->id);
            array_push($data,$data2);
        }
        echo json_encode($data);
    }
    public function getcardlist()
    {
        $posts = Card::get();
        echo json_encode($posts);
    }
    public function PrepareEdit(Request $request)
    {
        $account = Student::where('id', $request->input('id'))->first();
        echo json_encode($account);
    }
    public function Edit(Request $request)
    {
        $account = Student::where('id', $request->input('id'))->first();
        if($request->file('image') != null)
        {
            $user_image = $request->file('image')->getClientOriginalName();
            $imageName = rand(0, 1000) . '-' . '123' .  $user_image;
             $imagePath = 'user-image/' . $imageName;
             $request->file('image')->move(public_path('/user-image'), $imageName);
             $account->image = $imagePath;
        }
        
       
        $account->name = $request->get('name');
        $account->code = $request->get('code');
        $account->sex = $request->get('sex');
        $account->dob = $request->get('dob');
        $account->start = $request->get('start');
        $account->end = $request->get('end');
        $account->cardid = $request->get('card');
        $account->save();
        $mess = true;
        echo json_encode($mess);
    }
    public function Delete(Request $request)
    {
        $account = Student::where('id', $request->input('id'))->first();
        $account->active = 0;
        $account->save();
        $mess = true;
        echo json_encode($mess);
    }
    public function AddNew(Request $request)
    {
        $imagePath = null;
        if($request->file('image') != null)
        {
             $user_image = $request->file('image')->getClientOriginalName();
             $imageName = rand(0, 1000) . '-' . '123' .  $user_image;
             $imagePath = 'user-image/' . $imageName;
             $request->file('image')->move(public_path('/user-image'), $imageName);
            
        }
        $account = new Student([
            'name' => $request->get('name'),
            'code' => $request->get('code'),
            'cardid' => $request->get('card'),
            'dob' => $request->get('dob'),
            'sex' => $request->get('sex'),
            'start' => $request->get('start'),
            'end' => $request->get('end'),
            'active' => 1,
            'image' => $imagePath,
        ]);
        $account->save();
        
        $mess = true;
        echo json_encode($mess);
    }
}