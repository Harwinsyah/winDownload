<?php

namespace App\Http\Controllers;

use App\Accounting;
use Illuminate\Http\Request;
use DataTables;

class AccountingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        if($request->ajax()) {
            $data = Accounting::all();
            return DataTables::of($data)->addIndexColumn()->addColumn('aksi', function($row){
                $btn = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm edit_accounting"><span class="fa fa-edit"></span></a>';
                $btn = $btn. ' <a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Delete" class="delete btn btn-danger btn-sm hapus_accounting"><span class="fa fa-trash"></span></a>';
                return $btn;
            })->rawColumns(['aksi'])->make(true);
        } return view('accounting', ['accounting' => $request]);
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
        Accounting::updateOrCreate(['id' => $request->accounting_id], [
            'desc' => $request->desc, 
            'pemasukan' => $request->pemasukan, 
            'pengeluaran' => $request->pengeluaran, 
            'tgl' => $request->tgl, 
            'ket' => $request->ket
            ]);
        return response()->json(['success' => 'Data Berhasil Ditambahkan.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Accounting  $accounting
     * @return \Illuminate\Http\Response
     */
    public function show(Accounting $accounting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Accounting  $accounting
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $accounting = Accounting::find($id);
        return response()->json($accounting);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Accounting  $accounting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Accounting $accounting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Accounting  $accounting
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Accounting::find($id)->delete();
        return response()->json(['success', 'Data Produk Berhasil Di Hapus']);
    }
}
