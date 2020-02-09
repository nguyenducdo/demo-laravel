<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('getJson','MyController@getJson');
View::share(['sharedName'=>'Laravel','sharedName2'=>'PHP']);
Route::get('getView/{name}','MyController@getView');

Route::get('course/{course}','MyController@getCourse');

// database
Route::get('database',function(){
	// Schema::create('loaisanpham',function($table){
	// 	$table->increments('id');
	// 	$table->string('ten');
	// });
	Schema::create('theloai',function($table){
		$table->increments('id');
		$table->string('ten')->nullable();
		$table->string('nsx',200)->default('Nha san xuat');
	});

	echo 'done';
});

Route::get('productdb',function(){
	Schema::create('sanpham',function($table){
		$table->increments('id');
		$table->string('ten');
		$table->float('gia');
		$table->integer('soluong')->default(0);
		$table->integer('id_loaisanpham')->unsigned();
		$table->foreign('id_loaisanpham')->references('id')->on('loaisanpham');
	});
	echo 'done';
});

Route::get('dropcolumn',function(){
	Schema::table('sanpham',function($table){
		$table->dropColumn('id_loaisanpham');
	});
	echo 'done';
});

Route::get('addcolumn',function(){
	Schema::table('theloai',function($table){
		$table->string('nsx')->default('Nha san xuat');
	});
	echo 'done';
});


Route::get('addcolumn2',function(){
	Schema::table('sanpham',function($table){
		$table->integer('id_loaisanpham')->unsigned();
	});
});

// Route::get('modifycolumn',function(){
// 	Schema::table('sanpham',function($table){
// 		$table->integer('soluong')->default(1)->change();
// 	});
// });

Route::get('rename',function(){
	Schema::rename('theloai', 'loai');
	echo 'done';
});

Route::get('drop',function(){
	// Schema::drop('user');
	Schema::dropIfExists('user');
	Schema::dropIfExists('sanpham');
	Schema::dropIfExists('loaisanpham');
	Schema::dropIfExists('loai');
	echo 'done';
});

Route::get('create',function(){
	Schema::create('user',function($table){
		$table->increments('id');
		$table->string('username');
	});
	echo 'done';
});

Route::get('qbuilder/get',function(){
	$data = DB::table('sanpham')->get();
	foreach ($data as $row) {
		foreach($row as $column => $value){
			echo $column . ' : ' . $value . '<br>';
			
		}
		echo '<hr>';
	}
});

Route::get('qbuilder/where',function(){
	$data = DB::table('sanpham')->where('id','=',3)->get();
	foreach ($data as $row) {
		foreach($row as $column => $value){
			echo $column . ' : ' . $value . '<br>';
			
		}
		echo '<hr>';
	}
});

Route::get('qbuilder/select',function(){
	$data = DB::table('sanpham')->select(['name'])->where('id', 2)->get();
	foreach ($data as $row) {
		foreach($row as $column => $value){
			echo $column . ' : ' . $value . '<br>';
			
		}
		echo '<hr>';
	}
});

Route::get('qbuilder/raw',function(){
	$data = DB::table('sanpham')->select(DB::raw('id, name as tensp'))->where('id', 2)->get();
	foreach ($data as $row) {
		foreach($row as $column => $value){
			echo $column . ' : ' . $value . '<br>';
			
		}
		echo '<hr>';
	}
});

Route::get('qbuilder/order',function(){
	$data = DB::table('sanpham')->select(DB::raw('id, name as tensp'))->orderBy('id','desc')->skip(1)->take(2)->get();
	foreach ($data as $row) {
		foreach($row as $column => $value){
			echo $column . ' : ' . $value . '<br>';
			
		}
		echo '<hr>';
	}
});

Route::get('qbuilder/update',function(){
	DB::table('sanpham')->where('id',1)->update(['name'=>'laptop thinkpad']);
	echo 'done';
});


Route::get('qbuilder/increment/{value}',function($value){
	DB::table('sanpham')->where('id',1)->increment('soluong',$value);
});

Route::get('qbuilder/decrement/{value}',function($value){
	DB::table('sanpham')->where('id',1)->decrement('soluong',$value);
});

Route::get('qbuilder/delete/{id}',function($id){
	DB::table('sanpham')->where('id',$id)->delete();
});

Route::get('qbuilder/truncate',function(){
	DB::table('sanpham')->truncate();
});

Route::get('model/sanpham/insert/{name}',function($name){
	$sp = new App\SanPham();
	$sp->name = $name;
	$sp->soluong = 100;
	$sp->save();
	echo 'done';
});

Route::get('model/sanpham/all',function(){
	// $sp = App\SanPham::find(5)->toJson();
	$sp = App\SanPham::all()->toArray();
	var_dump($sp);
});

Route::get('model/sanpham/get/{name}',function($name){
	$sp = App\SanPham::where('name',$name)->get()->toArray();
	var_dump($sp);
	// echo $sp[0]['id'];
});

Route::get('model/sanpham/destroy/{id}',function($id){
	App\SanPham::destroy($id);
	echo 'done';
});

Route::get('model/relation/sanpham/{id}',function($id){
	$sp = App\SanPham::find($id)->loaisanpham->toArray();
	var_dump($sp);
});

Route::get('model/relation/loaisp/{id}',function($id){
	$lsp = App\LoaiSP::find($id)->sanpham->toArray();
	var_dump($lsp);
});


// middleware

Route::get('diem',function(){
	echo 'Ban da co diem <br>';
	echo '<h3>';
	echo $_REQUEST['diem'];
	echo '</h3>';
})->middleware('MyMiddleware')->name('diem');

Route::get('loi',function(){
	echo "Ban chua co diem";
})->name('loi');

//auth

Route::get('login',function(){
	return view('login');
});

Route::post('login','MyController@login')->name('login1');

Route::get('logout','MyController@logout');

//Session
Route::group(['middleware'=>['web']],function(){
	Route::get('session',function(){
		Session::put('course','laravel');
		// Session::forget('course');
		Session::flash('mess','flash session');
		echo "done";
		echo '<br>';
		echo Session::get('mess');
		echo "<br>";
		echo Session::get('course'). ' - ' . session('course');
		echo '<br>';
		if(Session::has('course')){
			echo "da co session";

		}else{
			echo "session course ko ton tai";
		}
	});

	Route::get('session/flash',function(){
		echo Session::get('mess');
	});
	Route::get('session/flash2',function(){
		echo Session::get('mess');
	});
	//De o ngoai van ok
});


// pagination

Route::get('sanpham','SanPhamController@index');