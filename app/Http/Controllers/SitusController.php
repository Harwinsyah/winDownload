<?php

namespace App\Http\Controllers;

use App\Situs;
use Illuminate\Http\Request;
use DataTables;

class SitusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        if($request->ajax()) {
            $data = Situs::all();
            return DataTables::of($data)->addIndexColumn()->addColumn('aksi', function($row){
                $btn = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm edit_situs"><span class="fa fa-edit"></span></a>';
                $btn = $btn. ' <a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Delete" class="delete btn btn-danger btn-sm hapus_situs"><span class="fa fa-trash"></span></a>';
                return $btn;
            })->addColumn('situs', function($row){
                $situs = '<a href="'.$row->link.'" target="_blank">'.$row->nama.'</a>';
                return $situs;
            })->rawColumns(['aksi', 'situs'])->make(true);
        } return view('situs', ['situs' => $request]);
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
        Situs::updateOrCreate(['id' => $request->situs_id], [
            'nama' => $request->nama, 
            'jenis' => $request->jenis, 
            'link' => $request->link, 
            'ket' => $request->ket
            ]);
        return response()->json(['success' => 'Data Berhasil Ditambahkan.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Situs  $situs
     * @return \Illuminate\Http\Response
     */
    public function show(Situs $situs)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Situs  $situs
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $situs = Situs::find($id);
        return response()->json($situs);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Situs  $situs
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Situs $situs)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Situs  $situs
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Situs::find($id)->delete();
        return response()->json(['success', 'Data Produk Berhasil Di Hapus']);
    }
}
