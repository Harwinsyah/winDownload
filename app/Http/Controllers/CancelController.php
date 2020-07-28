<?php

namespace App\Http\Controllers;

use App\Cancel;
use Illuminate\Http\Request;
use DataTables;

class CancelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        if($request->ajax()) {
            $data = Cancel::all();
            return DataTables::of($data)->addIndexColumn()->addColumn('aksi', function($row){
                $btn = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm edit_cancel"><span class="fa fa-edit"></span></a>';
                $btn = $btn. ' <a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Delete" class="delete btn btn-danger btn-sm hapus_cancel"><span class="fa fa-trash"></span></a>';
                return $btn;
            })->rawColumns(['aksi'])->make(true);
        } return view('cancel', ['cancel' => $request]);
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
        Cancel::updateOrCreate(['id' => $request->cancel_id], ['cancel' => $request->cancel, 'ket' => $request->ket]);
        return response()->json(['status' => 'Data Berhasil Ditambahkan.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cancel  $cancel
     * @return \Illuminate\Http\Response
     */
    public function show(Cancel $cancel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cancel  $cancel
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cancel = Cancel::find($id);
        return response()->json($cancel);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cancel  $cancel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cancel $cancel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cancel  $cancel
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cancel::find($id)->delete();
        return response()->json(['status', 'Data Produk Berhasil Di Hapus']);
    }
}
