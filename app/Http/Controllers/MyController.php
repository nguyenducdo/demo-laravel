<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
// use App\User;

class MyController extends Controller
{
    //
	public function getJson(){
		$array = ['course1'=>'Laravel','course2'=>'PHP','course3'=>'ASP.net','course4'=>'HTML'];
		return response()->json($array);
	}

	public function getView($name){
		return view('folder/testView',['name1'=>$name]);
	}

	public function getCourse($course){

		// if($course == 'laravel'){
		// 	return view('pages/laravel',['course'=>$course]);
		// }else{
		// 	return view('pages/php',['course'=>$course]);
		// }
		return view('pages/laravel',['course'=>$course]);
	}

	public function login(Request $request){
		$username = $request['username'];
		$password = $request['password'];

		// $user = User::find(4);
		// Auth::login($user);
		// return view('login',['mess'=>'Dang nhap thanh cong','user'=>Auth::user()]); 

		if(Auth::attempt(['username'=>$username,'password'=>$password])){
			return view('login',['mess'=>'Dang nhap thanh cong','user'=>Auth::user()]);
		}else{
			return view('login',['mess'=>'Ten dang nhap hoac mat khau khong dung']);
		}
	}

	public function logout(){
		Auth::logout();
		return view('login');
	}
}
