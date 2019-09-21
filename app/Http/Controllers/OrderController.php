<?php

namespace App\Http\Controllers;

use App\Orderan;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Redirect, Response;

class OrderController extends Controller
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

    public function createOrder()
    {
        return view('pesanan.index');
    }

    public function detailOrder($orderId)
    {
        $order = $orderId;
        $datap = "";
        $i = 1;
        $data = DB::table('pesanans')
            ->select('*')
            ->join('orderans', 'pesanans.id_order', '=', 'orderans.order')
            ->where('id_order', '=', $order)
            ->get();
        foreach ($data as $item) {
            $datap .=   '<tr>
                            <td class="text-center">' . $i++ . '</td>
                            <td class="text-center">' . $item->produks . '</td>
                            <td class="text-center">' . $item->qty . '</td>
                            <td class="text-center">' . number_format($item->subtotal) . '</td>
                        </tr>';
            $total = '<td colspan="3" align="center"><b>Total<b></td>
            <td>
                <div name="totals" id="totalsi" class="text-center">Rp.' . number_format($item->order_total) . '</div>
            </td>';
        }
        return response::json([
            'nama_produk' => $datap,
            'order_id'  => $order,
            'order_total'  => $total
        ]);
    }

    function daftarOrder(Request $request)
    {
        if (request()->ajax()) {
            if (!empty($request->from_date)) {
                $data = DB::table('orderans')
                    ->whereBetween('order_date', array($request->from_date, $request->to_date))
                    ->get();
            } else {
                $data = DB::table('orderans')->get();
            }

            return datatables()->of($data)
                ->setRowClass('{{ $id % 2 == 0 ? "alert-success" : "alert-warning" }}')
                ->addColumn('action', 'button.action_order')
                ->editColumn('order_total', function ($data) {
                    return 'Rp.' . number_format($data->order_total);
                })
                ->make(true);
        }
        return view('orderan.index');
    }

    // public function getOrder()
    // {
    //     return DataTables::of(
    //         DB::table('orders')->select('order_id', 'order_costumer_name', 'order_item', 'order_value', 'order_date')->get()
    //     )
    //         ->setRowClass('{{ $order_id % 2 == 0 ? "alert-success" : "alert-warning" }}')
    //         ->make(true);
    // }

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
        //
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
        //
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
        //
    }
}
