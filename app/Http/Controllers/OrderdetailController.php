<?php

namespace App\Http\Controllers;

use App\OrderDetail;
use App\Order;
use Illuminate\Http\Request;
use DataTables;

class OrderdetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        if($request->ajax()) {
            $data = OrderDetail::all();            
            return DataTables::of($data)->addIndexColumn()->addColumn('aksi', function($row){
                $btn = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm edit_order_detail"><span class="fa fa-edit"></span></a>';
                $btn = $btn. ' <a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Delete" class="delete btn btn-danger btn-sm hapus_order_detail"><span class="fa fa-trash"></span></a>';
                return $btn;
            })->addColumn('link', function($row){
                if ($row->link == null) {
                    $link = $row->judul;
                } else {
                    $link = '<a href="'.$row->link.'" target="blank">'.$row->judul.'</a>';
                }
                return $link;
            })->rawColumns(['aksi', 'link'])->make(true);
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
        $now = \Carbon\Carbon::now();
        $tahun = $now->format('Y-m-d');

        if($request->order_detail_ready == "Ready"){
            OrderDetail::updateOrCreate(['id' => $request->order_ready_id],[                
                'status' => $request->order_detail_ready
            ]);            
            
            return response()->json(['success' => 'Data Member Berhasil Ditambahkan']);
        } else {

            if ($request->film_detail == null) {
                $film = $request->film_detail_2;
            } else {
                $film = $request->film_detail;
            }
            
            OrderDetail::updateOrCreate(['id' => $request->order_detail_ready_id],[
                'invoice' => $request->invoice,
                'judul' => $film,
                'ukuran' => $request->ukuran_detail,
                'lokasi' => $request->lokasi_detail,
                'ket' => $request->keterangan_detail,
                'status' => $request->status_detail,
                'link' => $request->link_download,
                'tgl' => $tahun
                ]);
            
            $ukuran = OrderDetail::where('invoice', $request->invoice)->sum('ukuran');

            Order::updateOrCreate(['id' => $request->id_order], [
                'ukuran' => $ukuran,
                'bayar' => $ukuran * 2000
            ]);
                
                return response()->json(['success' => 'Data Member Berhasil Ditambahkan']);
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\OrderDetail  $orderDetail
     * @return \Illuminate\Http\Response
     */
    public function show(OrderDetail $orderDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\OrderDetail  $orderDetail
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = OrderDetail::find($id);
        return response()->json($order);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\OrderDetail  $orderDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrderDetail $orderDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\OrderDetail  $orderDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        OrderDetail::find($id)->delete();
        return response()->json(['success', 'Data Promo Berhasil Di Hapus']);
    }
}
