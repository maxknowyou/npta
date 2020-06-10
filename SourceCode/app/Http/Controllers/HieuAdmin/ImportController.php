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
use Excel;
use App\BookImport;
class ImportController extends Controller
{
public function __construct()
    {
        $this->middleware('auth');
    }
   
    public function import(Request $request)
    {
        $path = $request->file('file')->getRealPath();
        Excel::import(new BookImport, request()->file('file'));
        echo json_encode(true);
    }
    
   
}