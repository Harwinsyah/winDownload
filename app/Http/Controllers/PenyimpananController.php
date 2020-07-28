<?php

namespace App\Http\Controllers;

use App\Penyimpanan;
use App\Film;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use DataTables;

class PenyimpananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        if($request->ajax()) {
            $data = Penyimpanan::all();
            return DataTables::of($data)->addIndexColumn()->addColumn('aksi', function($row){
                $btn = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm edit_penyimpanan"><span class="fa fa-edit"></span></a>';
                $btn = $btn. ' <a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Delete" class="delete btn btn-danger btn-sm hapus_penyimpanan"><span class="fa fa-trash"></span></a>';
                return $btn;
            })->addColumn('cap', function($row){                
                $cap = Film::where('penyimpanan', 'like', $row->hdd)->sum('ukuran');
                return $cap;
            })
            ->rawColumns(['aksi', 'cap'])->make(true);
        } return view('penyimpanan', ['penyimpanan' => $request]);
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
        Penyimpanan::updateOrCreate(['id' => $request->penyimpanan_id], ['hdd' => $request->hdd, 'ket' => $request->ket]);        
        return response()->json(['status' => 'Data Berhasil Ditambahkan.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Penyimpanan  $penyimpanan
     * @return \Illuminate\Http\Response
     */
    public function show(Penyimpanan $penyimpanan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Penyimpanan  $penyimpanan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $penyimpanan = Penyimpanan::find($id);
        return response()->json($penyimpanan);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Penyimpanan  $penyimpanan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Penyimpanan $penyimpanan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Penyimpanan  $penyimpanan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Penyimpanan::find($id)->delete();
        return response()->json(['status', 'Data Produk Berhasil Di Hapus']);
    }

    public function get_penyimpanan(Request $request){
        $search = $request->search;
        if($search == ''){
           $penyimpanan = Penyimpanan::orderby('hdd','asc')->select('id','hdd')->limit(5)->get();
        }else{
           $penyimpanan = Penyimpanan::orderby('hdd','asc')->select('id','hdd')->where('hdd', 'like', '%' .$search . '%')->limit(5)->get();
        }
        $response = array();
        foreach($penyimpanan as $p){
           $response[] = array("id"=>$p->hdd, "text"=>$p->hdd);
        }
        echo json_encode($response);
        exit;
    }    
}
