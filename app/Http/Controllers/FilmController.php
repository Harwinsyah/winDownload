<?php

namespace App\Http\Controllers;

use App\Film;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use App\Imports\FilmImport;
use App\Exports\FilmExport;
use Maatwebsite\Excel\Facades\Excel;
use Validator;
use DataTables;

class FilmController extends Controller
{
    public function index(Request $request) {
        $duplikat = DB::table('film')->select('*', DB::raw('count(*) as total'))->groupBy('desc')->get();
        if($request->ajax()) {
            $data = Film::all();
            return DataTables::of($data)->addIndexColumn()->addColumn('aksi', function($row){
                $btn = '<a href="javascript:void(0)" data-id="'.$row->id.'" class="info btn btn-warning btn-sm info_film"><span class="fa fa-search"></span></a>';
                $btn = $btn. ' <a href="javascript:void(0)" data-id="'.$row->id.'" class="edit btn btn-primary btn-sm edit_film"><span class="fa fa-edit"></span></a>';
                $btn = $btn. ' <a href="javascript:void(0)" data-id="'.$row->id.'" class="delete btn btn-danger btn-sm hapus_film"><span class="fa fa-trash"></span></a>';
                return $btn;
            })->rawColumns(['aksi'])->make(true);
        } return view('film', ['film' => $request, 'duplikat' => $duplikat]);
    }

    public function pindah(Request $request) {
        $ids = $request->pindah_film;

        if($request->pindah_jenis == null) {
            DB::table('film')->whereIn('id', $ids)->update([
                'penyimpanan' => $request->pindah_hdd
            ]);
            return response()->json(['success' => 'Data Berhasil Ditambahkan.']);
        } else {
            DB::table('film')->whereIn('id', $ids)->update([
                'penyimpanan' => $request->pindah_hdd,
                'jenis' => $request->pindah_jenis,
            ]);
            return response()->json(['success' => 'Data Berhasil Ditambahkan.']);
        }
    }

    public function store(Request $request)
    {
        if ($request->genre == null) {
            $genre = $request->genre2;
        } else {
            $genre_multiple = implode(', ', $request->genre);
            $genre = $genre_multiple.', '.$request->genre2;
        }        

        if ($request->penyimpanan == null) {
            $penyimpanan = $request->penyimpanan_hidden;
        } else {
            $penyimpanan = $request->penyimpanan;
        }

        if ($request->ukuran == null) {
            $ukuran = 0;
        } else {
            $ukuran = $request->ukuran;
        }        

        $desc = $request->judul . " (" . $request->tahun . ") " . $request->kualitas;

        Film::updateOrCreate(['id' => $request->film_id], [
            'judul' => $request->judul, 
            'desc' => $desc, 
            'tahun' => $request->tahun,
            'kualitas' => $request->kualitas,
            'genre' => $genre,
            'subtitle' => $request->subtitle,
            'negara' => $request->negara,
            'ukuran' => $ukuran,
            'sinopsis' => $request->sinopsis,
            'status' => $request->status,
            'penyimpanan' => $penyimpanan,
            'jenis' => $request->jenis,
            'episode' => $request->episode,
            'rating' => $request->rating,
            'sub_link' => $request->sub_link,
            'film_link' => $request->film_link,
            'release' => $request->release,
            'poster' => $request->poster,
            'ket' => $request->ket
        ]);
            
        return response()->json(['success' => 'Data Berhasil Ditambahkan.']);
    }    

    public function edit($id)
    {
        $film = Film::find($id);
        return response()->json($film);
    }

    public function destroy($id)
    {
        Film::find($id)->delete();
        return response()->json(['success', 'Data Produk Berhasil Di Hapus']);
    }

    public function import(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);
        Excel::import(new FilmImport,request()->file('file'));
        return redirect('/film')->with('status', 'Excel Import Data Berhasil');
    }

    public function export()
    {
        return Excel::download(new FilmExport, 'Film.xlsx');
    }

    public function get_film(Request $request){
        $search = $request->search;
        if($search == ''){
           $film = Film::orderby('desc','asc')->select('id', 'desc', 'tahun', 'kualitas', 'ukuran', 'penyimpanan', 'status')->limit(5)->get();
        }else{
           $film = Film::orderby('desc','asc')->select('id', 'desc', 'tahun', 'kualitas', 'ukuran', 'penyimpanan', 'status')->where('desc', 'like', '%' .$search . '%')->limit(10)->get();
        }
        $response = array();
        foreach($film as $p){
           $response[] = array("id"=>$p->desc, "text"=>$p->desc. " - "  .$p->ukuran."GB - ".$p->penyimpanan . " - " . $p->status);
        }
        echo json_encode($response);
        exit;
    }    
    public function cari_film(Request $request){
        $search = $request->search;
        if($search == ''){
           $film = Film::orderby('desc','asc')->select('id', 'desc', 'tahun', 'kualitas', 'ukuran', 'penyimpanan', 'status')->limit(5)->get();
        }else{
           $film = Film::orderby('desc','asc')->select('id', 'desc', 'tahun', 'kualitas', 'ukuran', 'penyimpanan', 'status')->where('desc', 'like', '%' .$search . '%')->limit(20)->get();
        }
        $response = array();
        foreach($film as $p){
           $response[] = array("id"=>$p->id, "text"=>$p->desc. " - "  .$p->ukuran."GB - ".$p->penyimpanan . " - " . $p->status);
        }
        echo json_encode($response);
        exit;
    }    
}
