<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SanPham;
class SanPhamController extends Controller
{
    public function index(){

    	$sp = SanPham::paginate(5);

    	return view('sanpham',['sp'=>$sp]);
    }
}
