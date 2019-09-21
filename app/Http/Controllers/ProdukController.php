<?php

namespace App\Http\Controllers;

use App\Produk;
use App\Kategori;
use App\Notifications\NewProdukNotification;
use App\Orderan;
use App\Pesanan;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Redirect, Response;
use Illuminate\Support\Facades\DB;
use Validator;
use Intervention\Image\Image;
use Illuminate\Support\Carbon;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function uploadImage()
    {
        return view('produk.upload');
    }

    public function submitProduk(Request $request)
    {
        if ($request->ajax()) {
            $rules = array(
                'produk.*'  =>  'required',
                'qty.*'     =>  'required',
                'price.*'     =>  'required'
            );
            $error = Validator::make($request->all(), $rules);
            if ($error->fails()) {
                return response()->json([
                    'error'     =>  $error->errors()->all()
                ]);
            }
            $produk = $request->produk;
            $qty = $request->qty;
            $satuan = $request->satuan;
            $subtotal = $request->price;
            $total = $request->total;
            // $total = "Rp." . $total;

            // Get the last order id
            $lastorderId = Orderan::orderBy('id', 'desc')->first()->order;
            // Get last 3 digits of last order id
            $lastIncreament = substr($lastorderId, -3);
            // Make a new order id with appending last increment + 1
            $newOrderId = 'PSN' . date('Ymd') . str_pad($lastIncreament + 1, 3, 0, STR_PAD_LEFT);
            $todai = date('Ymd');
            $data_orderan = array(
                'order'     =>      $newOrderId,
                'order_total'   =>  str_replace(',', '', $total),
                // substr($total, 3) 
                'order_date'    =>  $todai,
            );
            Orderan::insert($data_orderan);

            for ($count = 0; $count < count($produk); $count++) {
                $data = array(
                    'produks'       =>  $produk[$count],
                    'qty'           =>  $qty[$count],
                    'subtotal'      =>  $subtotal[$count],
                    'id_order'      => $newOrderId,
                    'created_at'    => Carbon::now(),
                    'updated_at'    => Carbon::now(),
                );
                $insert_data[] = $data;
            }
            $datap = "";
            for ($count = 0; $count < count($produk); $count++) {
                $datap .= "<tr>";
                $datap .= '
                        <td>' . $produk[$count] . '</td>
                        <td class="text-center">' . $qty[$count] . '</td>
                        <td class="text-center divide">' . number_format($satuan[$count])  . '</td>
                        <td class="text-center divide">' . number_format($subtotal[$count]) . '</td>
                ';
                $datap .= '</tr>';
            }
            Pesanan::insert($insert_data);
            return response()->json([
                'success'   => '<strong>Suksess..!!!</strong> Data berhasil di simpan...',
                'pesanan'   => $datap,
                'total'     => $total,
                'order_id'  => $newOrderId
            ]);
        }
    }

    function getNameProduk($id)
    {
        $ids_produk = $id;
        // $nameProduk = Produk::find($ids_produk);
        $nameProduk = DB::table('produks')->select('name')->where('id', '=', $ids_produk)->get();

        return $nameProduk;
    }

    public function getPrice($id)
    {
        $name_Produk = $id;
        $data = DB::table('produks')
            ->select('price')
            ->where('name', '=', $name_Produk)
            ->get();
        foreach ($data as $item) {
            $output = $item->price;
        }

        return response::json($output);
    }

    function insertOrder(Request $request)
    {
        if ($request->ajax()) {
            $rules = array(
                'produk.*'  => 'required',
                'qty.*'  => 'required',
                'harga.*'   => 'required'
            );
            $error = Validator::make($request->all(), $rules);
            if ($error->fails()) {
                return response()->json([
                    'error'  => $error->errors()->all()
                ]);
            }

            $produk = $request->produk;
            $qty = $request->qty;
            $harga = $request->harga;

            $total = 'aaa';
            for ($count = 0; $count < count($produk); $count++) {
                $data = array(
                    'name_produk' => $produk[$count],
                    'qty'  => $qty[$count],
                    'jumlah'  => $harga[$count],
                    'total'  => $total[$count]
                );
                $insert_data[] = $data;
            }

            Pesanan::insert($insert_data);
            return response()->json([
                'success'  => 'Data Added successfully.'
            ]);
        }
    }


    public function ambilProduk()
    {
        $produk = Produk::all();
        $cats = "";
        foreach ($produk as $item) {
            $cats .= '<option value="' . $item->name . '">' . $item->name . '</option>';
            $harga = $item->price;
        }
        return response::json(array('cats' => $cats, 'price' => $harga));
    }


    public function produkDetail($id)
    {
        $id_produk = $id;
        // $data = Produk::find($id_produk);
        $data = DB::table('produks')
            ->join('kategoris', 'produks.kategoris_id', '=', 'kategoris.id')
            ->select('produks.*', 'produks.thumb as thumb', 'produks.name as name', 'produks.deskripsi', 'kategoris.nm_kategori', 'produks.price as price', 'produks.updated_at')
            ->where('produks.id', '=', $id_produk)
            ->get();
        foreach ($data as $item) {
            $output = '<p><img src="images/' . $item->thumb . '" class="img-responsive img-thumbnail" width="200" height="100"/> </p>
                        
                        <ul><li><label> Name :</label> ' . $item->name . '</li>
                        <li><label> Harga :</label> ' . $item->price . '</li>
                        <li><label> Kategori :</label> ' . $item->nm_kategori . '</li>
                        <li><label> Deskripsi :</label> ' . $item->deskripsi . '</li>
                        </ul>';
        }

        return response::json($output);
    }
    public function getKategori()
    {
        $allKategori = Kategori::all();
        $category = array();
        foreach ($allKategori as $kategori) {
            $category[$kategori->id] = $kategori->nm_kategori;
        }
        return Response::json(['kategori' => $category]);
    }

    public function postUpload(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'select_file' =>    'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        if ($validation->passes()) {
            $image = $request->file('select_file');
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $new_name);
            return response()->json([
                'message'       => 'Image Upload Successfully',
                'uploaded_image'  =>  '<img src="/images/' . $new_name . '" class="img-thumbnail" width="100" height="100" />',
                'class_name'    =>  'alert-success'
            ]);
        } else {
            return response()->json([
                'message'       => $validation->errors()->all(),
                'uploaded_image'  =>  '',
                'class_name'    =>  'alert-danger'
            ]);
        }
    }

    public function daftarproduk()
    {
        $produk = Produk::find(62);
        // $tanggal = $produk->created_at->toDateString();
        // $sekarang = Carbon::now()->toDateString();
        // dd($sekarang);
        return view('produk.index');
    }

    public function getProduk()
    {
        return DataTables::of(
            DB::table('produks')
                ->join('kategoris', 'produks.kategoris_id', '=', 'kategoris.id')
                ->select('produks.id', 'produks.name', 'kategoris.nm_kategori', 'produks.price', 'produks.updated_at', 'produks.created_at')
                ->get()
        )
            ->setRowClass('{{ $id % 2 == 0 ? "alert-success" : "alert-warning" }}')
            ->editColumn('name', '<a href="#" class="metan" data-toggle="popover" class="hover" id="{{$id}}">{{$name}}</a>')
            ->escapeColumns([])
            ->addColumn('action', 'button.action_produk')
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'select_file' =>    'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        if ($request->all()) {
            if ($request->hasFile('select_file')) {
                $image = $request->file('select_file');
                $new_name = rand() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $new_name);
                $produk_id = $request->id_produk;
                $produk = Produk::updateOrCreate(
                    ['id' => $produk_id],
                    [
                        'name'          =>  $request->name_produk,
                        'kategoris_id'  =>  $request->kate,
                        'price'         =>  $request->harga,
                        'thumb'         =>  $new_name,
                        'deskripsi'     =>  $request->deskripsi
                    ]
                );
            } else {
                $produk_id = $request->id_produk;
                $produk = Produk::updateOrCreate(
                    ['id' => $produk_id],
                    [
                        'name'          =>  $request->name_produk,
                        'kategoris_id'  =>  $request->kate,
                        'price'         =>  $request->harga,
                        'deskripsi'     =>  $request->deskripsi
                    ]
                );
            }

            $adminn = User::find(2);
            $adminn->notify(new NewProdukNotification($produk));

            return response()->json([
                'produk'        => $produk,
                'message'       => 'data Produk insert Successfully',
                // 'uploaded_image'  =>  '<img src="/images/' . $new_name . '" class="img-thumbnail" width="100" height="100" />',
                'class_name'    =>  'alert alert-success'
            ]);
        } else {
            return response()->json([
                'message'       => $validation->errors()->all(),
                'uploaded_image'  =>  '',
                'class_name'    =>  'alert alert-danger'
            ]);
        }
        // $nama = $new_name;

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $where = array('id' => $id);

        $produk  = Produk::where($where)->first();
        $roll = DB::table('produks')
            ->join('kategoris', 'produks.kategoris_id', '=', 'kategoris.id')
            ->where('produks.id', $where)
            ->select('kategoris.id', 'kategoris.nm_kategori')
            ->get();

        foreach ($roll as $rol) {
            $rolid = $rol->id;
        }

        $allKate = Kategori::all();
        $cats = array();
        foreach ($allKate as $kate) {
            $cats[$kate->id] = $kate->nm_kategori;
        }
        return Response::json(array('produk' => $produk, 'kategori' => $rolid, 'cats' => $cats));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $produk = Produk::where('id', $id)->delete();
        return Response::json($produk);
    }
}
