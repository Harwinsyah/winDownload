@extends('layouts.app')

@section('content')
    <div id="kumpulan_modal">
        <div class="modal fade" id="modal_update" tabindex="-1" role="dialog" aria-labelledby="modal_update_label" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4>Input Updetan / Downloadtan</h4>
                    </div>
                    <div class="modal-body">
                        <form name="form_update" id="form_update" enctype="multipart/form-data">                            
                            <input type="hidden" name="film_id" id="film_id" value="">
                            <input type="hidden" name="status" id="status" value="Belum Ready">                            
                            <div class="form-group">
                                <label for="judul">Judul</label>
                                <input type="text" name="judul" id="judul" class="form-control" autofocus>
                            </div>
                            <div class="form-group">
                                <label for="film_link">Link</label>
                                <input type="text" name="film_link" id="film_link" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="ket">Keterangan</label>
                                <select name="ket" id="ket" class="form-control">
                                    <option value="">- Keterangan -</option>
                                    <option value="0">Update</option>
                                    <option value="1">No Sub</option>
                                    <option value="2">Download</option>
                                </select>
                            </div>
                            <div id="simpan_tambahan">
                                <div class="form-group">
                                    <label for="tahun">Tahun</label>
                                    <input type="text" name="tahun" id="tahun" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="kualitas">Kualitas</label>
                                    <input type="text" name="kualitas" id="kualitas" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="ukuran">Ukuran</label>
                                    <input type="number" name="ukuran" id="ukuran" class="form-control">                                    
                                </div>
                                <div class="form-group">
                                    <label for="jenis">Jenis</label>
                                    <select name="jenis" id="jenis" class="form-control">
                                        <option value="">- Jenis Film -</option>
                                        <option value="Animasi">Animasi</option>
                                        <option value="Anime">Anime</option>
                                        <option value="Barat">Barat</option>
                                        <option value="Cina">Cina</option>
                                        <option value="Drama Korea">Drama Korea</option>
                                        <option value="Drama Cina">Drama Cina</option>
                                        <option value="India">India</option>
                                        <option value="Indonesia">Indonesia</option>
                                        <option value="Jepang">Jepang</option>
                                        <option value="Malaysia">Malaysia</option>
                                        <option value="Korea">Korea</option>
                                        <option value="Thailand">Thailand</option>
                                        <option value="TV Series">TV Series</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                            <div class="modal-footer">                                
                                <button class="btn btn-sm btn-success" type="submit" id="simpan_update">Simpan</button>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">        
        <h4>
            Dashboard
            <small>Maniak Download</small>
        </h4>

        <div class="card-deck">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <a href="/film" class="btn btn-lg btn-success">
                                <span class="fa fa-film fa-2x"></span>
                            </a>
                        </div>
                        <div class="col-md-8">
                            <div class="info-label">                                
                                <h6>Film</h6>
                                <b>{{ $film }}</b>
                            </div>
                        </div>
                    </div>                                        
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <a href="/order" class="btn btn-lg btn-success">
                                <span class="fa fa-coins fa-2x"></span>
                            </a>
                        </div>
                        <div class="col-md-8">
                            <div class="info-label">                                
                                <h6>Orderan</h6>
                                <b>{{ $order }}</b>
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <a href="/pelanggan" class="btn btn-lg btn-success">
                                <span class="fa fa-user-circle fa-2x"></span>
                            </a>
                        </div>
                        <div class="col-md-8">
                            <div class="info-label">                                
                                <h6>Pelanggan</h6>
                                <b>{{ $pelanggan }}</b>
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <a href="/penyimpanan" class="btn btn-lg btn-success">
                                <span class="fa fa-database fa-2x"></span>
                            </a>
                        </div>
                        <div class="col-md-8">
                            <div class="info-label">                                
                                <h6>Penyimpanan</h6>
                                <b>{{ $penyimpanan }}</b>
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-12">
                <div id="accordion">                    
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title float-left"><a href="/situs">Situs</a></h4>
                            <a data-toggle="collapse" href="#collapse-example" aria-expanded="true" aria-controls="collapse-example" id="heading-example" class="d-block">
                                <i class="fa fa-chevron-down float-right"></i>
                            </a>
                        </div>
                        <div id="collapse-example" class="collapse show" aria-labelledby="heading-example">
                            <div class="card-body">
                                <table class="table table-bordered" id="tabel_situs">
                                    <thead>
                                        <tr>
                                            <th>Situs</th>
                                            <th>Jenis</th>
                                            <th>Ket</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>                            
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"><a href="/accounting" target="_blank">Accounting</a></h4>
                    </div>
                    <div class="card-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm text-center">
                                    Pemasukan Hari Ini <br>                                    
                                    <b>Rp. {{ number_format($pemasukanhari, 0, ',', '.',) }}</b>
                                </div>
                                <div class="col-sm text-center">
                                    Pemasukan Bulan Ini <br>
                                    <b>Rp. {{ number_format($pemasukanbulan, 0, ',', '.',) }}</b>
                                </div>
                                <div class="col-sm text-center">
                                    Pengeluaran Bulan Ini <br>
                                    <b>Rp. {{ number_format($pengeluaranbulan, 0, ',', '.',) }}</b>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
        <br>
        <div class="card">
            <div class="card-header">
                <h4 class="float-left">Update / Download</h4>
                <button class="btn btn-success float-right" type="button" data-toggle="modal" data-target="#modal_update" id="btn_update">Tambah</button>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="film_detail">Cek Film Ready</label>
                    <select name="film_detail" id="film_detail" class="form-control"></select>
                </div>
                <div id="div_table">
                <table class="table table-bordered" id="tabel_update">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Keterangan</th>
                            <th>Waktu Input</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @if (!empty($update) && $update->count())                            
                            @foreach ($update as $item)
                            <tr>
                                <td class="tengah">{{ $no++ }}</td>
                                <td><a href="{{$item->film_link}}" target="_blank">{{ $item->judul }}</a></td>
                                <td class="tengah">                            
                                    @if ($item->ket == 0)
                                        Update                                    
                                    @elseif($item->ket == 1)
                                        No Subtittle        
                                    @else                            
                                        Download
                                    @endif
                                </td>
                                <td class="tengah"> {{$item->created_at}} </td>
                                <td class="tengah">
                                    <a href="javascript:void(0)" data-id="{{ $item->id }}" class="simpan btn btn-success btn-sm btn_simpan"><span class="fa fa-save"></span></a>
                                    <a href="javascript:void(0)" data-id="{{ $item->id }}" class="download btn btn-warning btn-sm btn_download"><span class="fa fa-download"></span></a>
                                    <a href="javascript:void(0)" data-id="{{ $item->id }}" class="delete btn btn-danger btn-sm hapus_update"><span class="fa fa-trash"></span></a>
                                </td>
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5" class="tengah">Tidak ada data yang mau di update atau download</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                {!! $update->links() !!}
            </div>
            </div>
        </div><br>        
    </div>
@endsection

@section('js')
    <script>
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                }
            });

            var tabel_situs = $('#tabel_situs').DataTable({
                processing: true,
                serverSide: true,
                info: false,
                ajax : "{{ route('situs.index') }}",
                columns: [                    
                    {data: 'situs', name: 'situs'},
                    {data: 'jenis', name: 'jenis'},                    
                    {data: 'ket', name: 'ket'}                    
                ]
            });

            $('#modal_update').on('shown.bs.modal', function() {
                $('#judul').trigger('focus');
            });

            $('#simpan_update').click(function(e){
                e.preventDefault();

                $.ajax({
                    type : 'POST',
                    url : "{{ route('film.store') }}",
                    data: $('#form_update').serialize(),
                    success:function(data){
                        $('#modal_update').modal('hide');
                        $('#div_table').load(' #div_table');
                        $('#film_detail').load(' #film_detail');
                        $('#film_id').val("");
                        $('#judul').val("");
                        $('#film_link').val("");
                        $('#ket').val("Update");
                        swal ("Data Berhasil Di Tambahkan!", "",  "success" )
                    }, error : function(data) {
                        alert('Ada yang salah');
                    }
                });
            });

            $('body').on('click', '.btn_download', function(){
                var film_id = $(this).data('id');                
                $.get("{{ route('film.index') }}" +'/'+film_id + '/edit', function(data) {
                    $('#modal_update').modal('show');
                    $('#simpan_tambahan').hide();
                    $('#film_id').val(data.id);
                    $('#judul').val(data.judul);
                    $('#film_link').val(data.film_link);
                    $('#ket').val(data.ket);                    
                })
            });

            $('body').on('click', '.btn_simpan', function(){
                var film_id = $(this).data('id');                
                $.get("{{ route('film.index') }}" +'/'+film_id + '/edit', function(data) {
                    $('#modal_update').modal('show');
                    $('#simpan_tambahan').show();
                    $('#film_id').val(data.id);
                    $('#status').val("Ready");
                    $('#judul').val(data.judul);
                    $('#film_link').val(data.film_link);
                    $('#ket').val(data.ket);                    
                })
            });

            $('body').on('click', '#btn_update', function(){
                $('#simpan_tambahan').hide();
                $('#judul').val("");
                $('#film_link').val("");
                $('#ket').val("");
                $('#tahun').val("");
                $('#kualitas').val("");
                $('#ukuran').val("");
                $('#jenis').val("");
            });            

            $('body').on('click', '.hapus_update', function(){
                var film_id = $(this).data("id");
                swal({
                    title : "",
                    text : "Anda Yakin ?",
                    type : "warning",
                    showCancelButton: true,
                    confirmButtonClass: 'btn-danger',
                    confirmButtonText: "Delete",
                    cancelButtonText: "Cancel",
                    closeOnConfirm: true,
                    closeOnCancel: true                  
                }, function(){
                    $.ajax({
                            type: "DELETE",
                            url: "{{ route('film.store') }}"+'/'+film_id,
                            success : function(data) {
                                swal ("Data Berhasil Di Hapus!", "",  "success" );
                                $('#div_table').load(' #div_table');
                                $('#film_detail').load(' #film_detail');
                            },
                            error : function(data) {
                                console.log('Error :', data);
                            }
                        });     
                
                });
            }); 
        });
    </script>
    <script type="text/javascript">
        // CSRF Token
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $(document).ready(function(){                
            $( "#film_detail" ).select2({  
                placeholder: 'Cari...',              
                theme: 'bootstrap4',
                ajax: { 
                    url: "{{route('film.get_film')}}",
                    type: "post",
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            _token: CSRF_TOKEN,
                            search: params.term
                        };
                    },
                    processResults: function (response) {
                        return {
                            results: response                            
                        };                        
                    },
                    cache: true
                }
            });
        });
        
    </script> 
@endsection