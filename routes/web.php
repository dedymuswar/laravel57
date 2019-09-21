<?php

use Spatie\Permission\Models\Role;
use App\DataTables\UserDataTable;
use App\Http\Controllers\ProdukController;
use App\User;
use App\Notifications\TaskCompleted;
use App\Orderan;

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

Route::get('/relasi', function () {

        $order = Orderan::find(7);
        dd($order->pesanans());
});

Route::get('/', function () {
        return view('welcome');
});

Route::get('/markAsRead', function () {
        auth()->user()->unreadNotifications->markAsRead();
});


Route::get('latihnotification', function () {

        //On demand notification
        $user = User::find(2);
        Notification::route('mail', 'taylor@example.com')
                ->notify(new TaskCompleted($user));
        return view('welcome');
});

Route::group(['middleware' => ['role:admin']], function () {
        //Route menu komentar
        Route::resource('comment', 'CommentController');
        Route::get('dataComment', 'CommentController@index')->name('dataComment');

        //Route Data eksport dan Import CSV
        Route::get('eksportData', 'CsvFileController@index')->name('eksportData');
        Route::get('csv_file/export', 'CsvFileController@csv_export')->name('export');
        Route::post('csv_file/import', 'CsvFileController@csv_import')->name('import');
        //Route Date Range Order
        Route::get('get-detail-order/{id}/detail', 'OrderController@detailOrder')->name('detailOrder');
        Route::get('createOrder', 'OrderController@createOrder')->name('create.Order');
        Route::get('dataOrder', 'OrderController@getOrder')->name('get.DateRange');
        Route::get('daftarOrder', 'OrderController@daftarOrder')->name('daftarOrder');

        //Route Produk
        Route::get('getPrice/{id}/edit', 'ProdukController@getPrice')->name('getPrice');
        Route::post('insertOrder', 'ProdukController@insertOrder')->name('insertOrder');

        // Route Post
        Route::get('dinamic-field', 'PostController@index');
        Route::get('getPost', 'PostController@getPost')->name('getPost');
        Route::post('insertPost', 'PostController@insert')->name('insertForm.Post');


        //Route Image Upload
        Route::get('getUpload', 'ProdukController@uploadImage')->name('getUpload');
        Route::post('postUpload', 'ProdukController@postUpload')->name('postUpload');

        //Route ajax crud datatable PRODUK
        Route::resource('ajax-crud-list-produk', 'ProdukController');
        Route::post('submitProduk', 'ProdukController@submitProduk')->name('submit.Produk');
        Route::get('ambilProduk', 'ProdukController@ambilProduk')->name('ambil.Produk');
        Route::post('ajax-crud-list-produk/store', 'ProdukController@store');
        Route::get('daftarproduk', 'ProdukController@daftarProduk')->name('daftar.produk');
        Route::get('getDetail/{id}/edit', 'ProdukController@produkDetail')->name('getDetail.produk');
        Route::post('ajax-crud-list-produk/delete/{id}', 'ProdukController@destroy');
        Route::get('getproduk', 'ProdukController@getProduk')->name('get.Produk');
        Route::get('getKategori', 'ProdukController@getKategori')->name('getKategori');

        //Route ajax crud datatable USER
        Route::resource('ajax-crud-list', 'UserController');
        Route::post('ajax-crud-list/store', 'UserController@store');
        Route::post('ajax-crud-list/delete/{id}', 'UserController@destroy');
        Route::get('getRole', 'UserController@getRoles');
        Route::get('daftaruser', 'UserController@daftaruser')->name('daftaruser');
        Route::get('getuser', 'UserController@getUser')->name('get.User');

        Route::get('/about', 'PageController@about');
        Route::get('/contact', 'PageController@contact');
        Route::get('/insert', 'PageController@insert');
        Route::get('/update', 'PageController@update');
        Route::get('/find', 'PageController@find');
        Route::get('/findwhere', 'PageController@findwhere');
        Route::get('/create', 'PageController@create');
        Route::get('/createKapal', 'PageController@createKapal');




        //Manajemen User

        Route::get('tambahuser', 'UserController@tambahuser')->name('tambahuser');
        Route::post('insertuser', 'UserController@insert')->name('insertuser');
        Route::get('user/{id}/edit', 'UserController@edit')->name('edituser');
        Route::put('user/{id}', 'UserController@update')->name('updateuser');
        Route::post('deleteuser/{id}', 'UserController@destroy')->name('destroyuser');

        Route::get('/givepermission', function () {
                //Roles
                //membuat role untuk user, 1 atau banyak sekaligus
                // auth()->user()->assignRole(['admin','operator']);

                //membuat sync atau reset role user dengan nilai baru
                // auth()->user()->syncRoles(['admin','operator']);
                // $user = User::find(6);
                // $user->assignRole('moderator');

                //cek role user
                // if(auth()->user()->hasRole('operator')){
                //     return 'Yes';
                // }

                //Permission
                // $user = auth()->user();
                // $user->givePermissionTo(['edit post', 'delete post']);

                //cek permission user
                // dd($user->hasPermissionTo('delete post'));

                $role = Role::find(1);

                //hapus permission role
                // $role->revokePermissionTo('view post');

                //get permission to role
                // $role->givePermissionTo('edit post', 'delete post');

                // cek permission roles
                // dd($role->hasPermissionTo('add post'));
                // dd($role->hasAnyPermission(['view post','delete post']));

                // Case memberikan permission spesial user tertentu
                $user = auth()->user();
                // $user->givePermissionTo('add post');
                // dd($user->can('add post'));

                // cek role user
                // if (auth()->user()->hasRole('operator')) {
                //         return 'Oke';
                // }
                $ana = $user->roles->pluck('name');
                // dd($ana);
        });
});

Route::get('/home', 'HomeController@index')->name('home');
Auth::routes();
