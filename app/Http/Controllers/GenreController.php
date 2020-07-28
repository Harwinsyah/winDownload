<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Genre;
use App\Imports\GenreImport;
use App\Exports\GenreExport;
use Maatwebsite\Excel\Facades\Excel;
use Validator;
use DataTables;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        if($request->ajax()) {
            $data = Genre::all();
            return DataTables::of($data)->addIndexColumn()->addColumn('aksi', function($row){
                $btn = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm edit_genre"><span class="fa fa-edit"></span></a>';
                $btn = $btn. ' <a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Delete" class="delete btn btn-danger btn-sm hapus_genre"><span class="fa fa-trash"></span></a>';
                return $btn;
            })->rawColumns(['aksi'])->make(true);
        } return view('genre', ['genre' => $request]);
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
        Genre::updateOrCreate(['id' => $request->genre_id], ['nama' => $request->nama, 'ket' => $request->ket]);
        return response()->json(['success' => 'Data Berhasil Ditambahkan.']);
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
        $genre = Genre::find($id);
        return response()->json($genre);
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
        Genre::find($id)->delete();
        return response()->json(['success', 'Data Produk Berhasil Di Hapus']);
    }

    public function import(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);
        Excel::import(new GenreImport,request()->file('file'));
        return redirect('/genre')->with('status', 'Excel Import Data Berhasil');
    }

    public function export()
    {
        return Excel::download(new GenreExport, 'Genre.xlsx');
    }

    public function get_genre(Request $request){
        $search = $request->search;
        if($search == ''){
           $genre = Genre::orderby('nama','asc')->select('id','nama')->limit(5)->get();
        }else{
           $genre = Genre::orderby('nama','asc')->select('id','nama')->where('nama', 'like', '%' .$search . '%')->limit(5)->get();
        }
        $response = array();
        foreach($genre as $p){
           $response[] = array("id"=>$p->nama, "text"=>$p->nama);
        }
        echo json_encode($response);
        exit;
    }    
}