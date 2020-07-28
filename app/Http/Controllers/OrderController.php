<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderDetail;
use Illuminate\Http\Request;
use DataTables;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        if($request->ajax()) {
            $data = Order::all();
            return DataTables::of($data)->addIndexColumn()->addColumn('aksi', function($row){
                $btn = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm edit_order"><span class="fa fa-edit"></span></a>';
                $btn = $btn. ' <a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Order" class="edit btn btn-warning btn-sm orderan"><span class="fa fa-search"></span></a>';
                $btn = $btn. ' <a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Delete" class="delete btn btn-danger btn-sm hapus_order"><span class="fa fa-trash"></span></a>';
                return $btn;
            })->rawColumns(['aksi'])->make(true);
        } return view('order', ['order' => $request]);
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
        if($request->nama_pelanggan == null) {
            $nama = $request->nama_pelanggan_order;
        } else {
            $nama = $request->nama_pelanggan;
        }
        $now = \Carbon\Carbon::now();
        $tahun = $now->format('Y-m-d');
        $penjualanDetail = Order::where('tgl', $tahun)->count();

        if ($request->invoice_order == null) {
            $invoice = 'PJ'.$now->format('ymd').$request->kasir_id.$penjualanDetail."MD";
        } else {
            $invoice = $request->invoice_order;
        }

        Order::updateOrCreate(['id' => $request->order_id], [
            'tgl' => $tahun,
            'nama_pelanggan' => $nama,
            // 'ambil' => $request->ambil,
            // 'ukuran' => $request->ukuran,
            // 'bayar' => $request->ukuran * 2000,
            'status' => $request->status,
            'ket' => $request->keterangan,
            'invoice' => $invoice
        ]);

        // OrderDetail::updateOrCreate(['id' => $request->order_detail_id],[
        //     'invoice' => $request->invoice,
        //     'judul' => $request->film,
        //     'tgl' => $tahun,
        //     'ket' => $request->ket
        // ]);

        return response()->json(['success' => 'Data Member Berhasil Ditambahkan']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = Order::find($id);
        return response()->json($order);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        Order::find($id)->delete();        
        return response()->json(['success', 'Data Promo Berhasil Di Hapus']);
    }
}
