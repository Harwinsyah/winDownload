<?php

namespace App\Http\Controllers;

use App\Pelanggan;
use Illuminate\Http\Request;
use DataTables;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        if($request->ajax()) {
            $data = Pelanggan::all();
            return DataTables::of($data)->addIndexColumn()->addColumn('aksi', function($row){
                $btn = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm edit_pelanggan"><span class="fa fa-edit"></span></a>';
                $btn = $btn. ' <a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Delete" class="delete btn btn-danger btn-sm hapus_pelanggan"><span class="fa fa-trash"></span></a>';
                return $btn;
            })->rawColumns(['aksi'])->make(true);
        } return view('pelanggan', ['pelanggan' => $request]);
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
        Pelanggan::updateOrCreate(['id' => $request->pelanggan_id], [
            'nama' => $request->nama, 
            'jk' => $request->jk,
            'alamat' => $request->alamat,
            'hp' => $request->hp,
            'fb' => $request->fb,
            'ig' => $request->ig,
            'wa' => $request->wa,
            'ambil' => $request->ambil,
            'harga' => $request->harga,
            'ukuran' => $request->ukuran,
            'ket' => $request->ket
            ]);
        return response()->json(['status' => 'Data Berhasil Ditambahkan.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pelanggan  $pelanggan
     * @return \Illuminate\Http\Response
     */
    public function show(Pelanggan $pelanggan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pelanggan  $pelanggan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pelanggan = Pelanggan::find($id);
        return response()->json($pelanggan);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pelanggan  $pelanggan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pelanggan $pelanggan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pelanggan  $pelanggan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Pelanggan::find($id)->delete();
        return response()->json(['status', 'Data Produk Berhasil Di Hapus']);
    }

    public function get_pelanggan(Request $request){
        $search = $request->search;
        if($search == ''){
           $pelanggan = Pelanggan::orderby('nama','asc')->select('id','nama')->limit(5)->get();
        }else{
           $pelanggan = Pelanggan::orderby('nama','asc')->select('id','nama')->where('nama', 'like', '%' .$search . '%')->limit(5)->get();
        }
        $response = array();
        foreach($pelanggan as $p){
           $response[] = array("id"=>$p->nama, "text"=>$p->nama);
        }
        echo json_encode($response);
        exit;
    }
}
