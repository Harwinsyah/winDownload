@extends('layouts.app')

@section('content')

    <div class="modal fade" id="modal_pindah" tabindex="-1" role="dialog" aria-labelledby="modal_pindah_label" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Pindah Tempat Penyimpanan</h4>
                </div>
                <div class="modal-body">
                    <div id="pindah_div">
                    <form id="pindah_form" name="pindah_form" enctype="multipart/form-data">                                        
                        <div class="form-group">
                            <label for="pindah_hdd">Penyimpanan</label>
                            <select name="pindah_hdd" id="pindah_hdd"></select>
                        </div>
                        <div class="form-group">
                            <label for="pindah_jenis">Jenis</label>
                            <select name="pindah_jenis" id="pindah_jenis" class="form-control">
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
                        <div class="form-group">
                            <label for="pindah_film">Film</label>
                            <select name="pindah_film[]" id="pindah_film" multiple></select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                        <button class="btn btn-sm btn-success" type="submit" id="pindah_simpan" value="create">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_input" tabindex="-1" role="dialog" aria-labelledby="modal_inputLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <form id="film_form" name="film_form" enctype="multipart/form-data">
                        <input type="hidden" name="film_id" id="film_id" value="">
                        <div class="form-row">
                            <div class="form-group col-md-5">
                                <label for="judul">Judul</label>
                                <input type="text" class="form-control form-control-sm" name="judul" id="judul" autofocus required>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="tahun">Tahun</label>
                                <input type="text" class="form-control form-control-sm" name="tahun" id="tahun">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="kualitas">Kualitas</label>
                                <input type="text" class="form-control form-control-sm" name="kualitas" id="kualitas">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="negara">Negara</label>
                                <input type="text" class="form-control form-control-sm" name="negara" id="negara">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-2">
                                <label for="jenis">Jenis</label>
                                <input type="text" name="jenis" id="jenis" class="form-control form-control-sm">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="ukuran">Ukuran</label>
                                <input type="number" name="ukuran" id="ukuran" class="form-control form-control-sm">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="status">Status</label>
                                <input type="text" name="status" id="status" class="form-control form-control-sm">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="episode">Episode</label>
                                <input type="text" name="episode" id="episode" class="form-control form-control-sm">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="subtitle">Subtitle</label>
                                <input type="text" name="subtitle" id="subtitle" class="form-control form-control-sm">
                            </div>                            
                            <div class="form-group col-md-2">
                                <label for="rating">Rating</label>
                                <input type="number" name="rating" id="rating" class="form-control form-control-sm">
                            </div>                     
                        </div>
                        <div class="form-row">                            
                            <div class="form-group col-md-6">
                                <label for="genre">Genre</label>
                                <select name="genre[]" id="genre" multiple></select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="genre2">Genre Terpilih</label>
                                <textarea name="genre2" id="genre2" rows="2" class="form-control form-control-sm"></textarea>
                            </div>                            
                        </div>
                        <div class="form-row">                                                        
                            <div class="form-group col-md-4">
                                <label for="penyimpanan">Penyimpanan</label>
                                <select name="penyimpanan" id="penyimpanan"></select>
                                <input type="hidden" name="penyimpanan_hidden" id="penyimpanan_hidden">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="release">Release</label>
                                <input type="date" name="release" id="release" class="form-control form-control-sm">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="sub_link">Link Subtitle</label>
                                <input type="text" name="sub_link" id="sub_link" class="form-control form-control-sm">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="film_link">Link Download</label>
                                <input type="text" name="film_link" id="film_link" class="form-control form-control-sm">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="poster">Poster</label>
                                <input type="file" name="poster" id="poster">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="sinopsis">Sinopsis</label>
                                <textarea name="sinopsis" id="sinopsis" rows="3" class="form-control form-control-sm"></textarea>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="ket">Keterangan</label>
                                <textarea name="ket" id="ket" rows="3" class="form-control form-control-sm"></textarea>
                            </div>
                        </div>                        
                    
                </div>
                <div class="modal-footer">
                        <button class="btn btn-sm btn-success" type="submit" id="simpan_film" value="create">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_info_film" tabindex="-1" role="dialog" aria-labelledby="modal_info_filmLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h3 id="modal_info_filmLabel"></h3>
                            <h6 id="genre_info"></h6>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <br><br>                            
                            <table class="table table-sm table-borderless table-responsive table-info-film">
                                <tr>
                                    <td>Status</td>
                                    <td>:</td>
                                    <td id="status_info"></td>
                                </tr>
                                <tr>
                                    <td>Penyimpanan</td>
                                    <td>:</td>
                                    <td id="penyimpanan_info"></td>
                                </tr>
                                <tr>
                                    <td>Jenis</td>
                                    <td>:</td>
                                    <td id="jenis_info"></td>
                                </tr>
                                <tr>
                                    <td>Subtitle</td>
                                    <td>:</td>
                                    <td id="subtitle_info"></td>
                                </tr>
                                <tr>
                                    <td>Negara</td>
                                    <td>:</td>
                                    <td id="negara_info"></td>
                                </tr>
                                <tr>
                                    <td>Ukuran</td>
                                    <td>:</td>
                                    <td id="ukuran_info"></td>
                                </tr>                                                          
                                <tr>
                                    <td>Episode</td>
                                    <td>:</td>
                                    <td id="episode_info"></td>
                                </tr>
                                <tr>
                                    <td>Rating</td>
                                    <td>:</td>
                                    <td id="rating_info"></td>
                                </tr>
                                <tr>
                                    <td>Release</td>
                                    <td>:</td>
                                    <td id="release_info"></td>
                                </tr>
                                <tr>
                                    <td>Keterangan</td>
                                    <td>:</td>
                                    <td id="ket_info"></td>
                                </tr>
                                <tr>
                                    <td>Sinopsis</td>
                                    <td>:</td>
                                    <td id="sinopsis_info"></td>
                                </tr>      
                                <tr>
                                    <td><a id="sub_download" href="#" class="btn btn-warning btn-sm" target="_blank"><span class="fa fa-download"></span> Subtitle</a></td>
                                    <td></td>
                                    <td><a id="film_download" href="#" class="btn btn-warning btn-sm" target="_blank"><span class="fa fa-download"></span> Film</a></td>
                                </tr>                                                            
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalHapus" tabindex="-1" role="dialog" aria-labelledby="label_modalHapus" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="label_modalHapus">Film Duplikat</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Judul</th>
                                <th>Penyimpanan</th>
                                <th>Duplikat</th>
                            </tr>
                        </thead>
                        <tbody>                        
                            @foreach ($duplikat as $item)
                                @if ($item->total > 1)                            
                                    <tr>
                                        <td>{{$item->desc}}</td>
                                        <td>{{$item->penyimpanan}}</td>
                                        <td>{{$item->total}}</td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>                
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Import Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('import') }}" method="POST" enctype="multipart/form-data">
    
                        {{ csrf_field() }}
                            <input type="file" name="file">                                                
                </div>
                <div class="modal-footer">
                    <input type="submit" name="upload" class="btn btn-primary btn-sm" value="Import">
                    </form>  
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Data Film</h4>
                        <button class="btn btn-warning btn-sm" type="button" data-toggle="modal" data-target="#modal_input">Input</button>
                        <a href="{{ url('export') }}" class="btn btn-success btn-sm" target="_blank">Export</a>
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">Import</button>
                        <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#modal_pindah">Pindah Hdd</button>
                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalHapus">Duplikat</button><br><br>
                        <table class="table table-bordered table-sm" id="tabel_film">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Judul</th>
                                    <th>Jenis</th>
                                    <th>Penyimpanan</th>
                                    <th>Ukuran</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
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

            var table = $('#tabel_film').DataTable({
                processing: true,
                serverSide: true,
                info: false,
                ajax : "{{ route('film.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'desc', name: 'desc'},
                    {data: 'jenis', name: 'jenis'},
                    {data: 'penyimpanan', name: 'penyimpanan'},
                    {data: 'ukuran', name: 'ukuran'},
                    {data: 'aksi', name: 'aksi', orderable: false, searchable: false, className : 'aksi'}
                ]
            });

            $('#simpan_film').click(function(e){
                e.preventDefault();                

                $.ajax({
                    type:'POST',
                    url: "{{ route('film.store') }}",
                    data: $('#film_form').serialize(),
                    success:function(data){
                        $('#modal_input').modal('hide');
                        table.draw();
                        $('#film_id').val("");
                        $('#judul').val("");
                        $('#tahun').val("");
                        $('#kualitas').val("");
                        $('#genre').val("");
                        $('#subtitle').val("");
                        $('#negara').val("");
                        $('#ukuran').val("");
                        $('#sinopsis').val("");
                        $('#status').val("");
                        $('#penyimpanan').val("");
                        $('#jenis').val("");
                        $('#episode').val("");
                        $('#rating').val("");
                        $('#sub_link').val("");
                        $('#film_link').val("");
                        $('#release').val("");
                        $('#ket').val("");
                    },
                    error : function(data) {
                        alert("ada yang salah");
                    }
                });
            });
            $('#pindah_simpan').click(function(e){
                e.preventDefault();                

                $.ajax({
                    type:'POST',
                    url: "{{ route('film.pindah') }}",
                    data: $('#pindah_form').serialize(),
                    success:function(data){
                        $('#modal_pindah').modal('hide');                        
                        table.draw();
                        $('#pindah_hdd').val("");
                        $('#pindah_jenis').val("");
                        $('#pindah_film').val("");
                    },
                    error : function(data) {
                        alert("ada yang salah");
                    }
                });
            });

            $('body').on('click', '.info_film', function(){
                var film_id = $(this).data('id');                
                $.get("{{ route('film.index') }}" +'/'+film_id + '/edit', function(data) {
                    $('#modal_info_film').modal('show');
                    if (data.kualitas == null) {
                        var kualitas = "";
                    } else {
                        var kualitas = data.kualitas;
                    }

                    if (data.sub_link == null) {
                        var sub_hidden = document.getElementById("sub_download");
                        sub_hidden.style.display = "none";
                    }
                    
                    if (data.film_link == null) {
                        var film_hidden = document.getElementById("film_download");
                        film_hidden.style.display = "none";
                    }

                    if (data.ukuran == null) {
                        var ukuran = 0;
                    } else {
                        var ukuran = data.ukuran;
                    }
                    
                    document.getElementById("modal_info_filmLabel").innerHTML = data.judul;
                    document.getElementById("genre_info").innerHTML = data.genre;
                    document.getElementById("subtitle_info").innerHTML = data.subtitle;
                    document.getElementById("negara_info").innerHTML = data.negara;
                    document.getElementById("ukuran_info").innerHTML = ukuran + " GB";
                    document.getElementById("sinopsis_info").innerHTML = data.sinopsis;
                    document.getElementById("status_info").innerHTML = data.status;
                    document.getElementById("penyimpanan_info").innerHTML = data.penyimpanan;
                    document.getElementById("jenis_info").innerHTML = data.jenis;
                    document.getElementById("episode_info").innerHTML = data.episode;
                    document.getElementById("rating_info").innerHTML = data.rating;
                    document.getElementById("sub_download").href = sub_link;
                    document.getElementById("film_download").href = film_link;
                    document.getElementById("release_info").innerHTML = data.release;
                    document.getElementById("ket_info").innerHTML = data.ket;
                })
            });
            $('body').on('click', '.edit_film', function(){
                var film_id = $(this).data('id');                
                $.get("{{ route('film.index') }}" +'/'+film_id + '/edit', function(data) {
                    $('#modal_input').modal('show');
                    $('#film_id').val(data.id);
                    $('#judul').val(data.judul);
                    $('#tahun').val(data.tahun);
                    $('#kualitas').val(data.kualitas);
                    $('#genre2').val(data.genre);
                    $('#subtitle').val(data.subtitle);
                    $('#negara').val(data.negara);
                    $('#ukuran').val(data.ukuran);
                    $('#sinopsis').val(data.sinopsis);
                    $('#status').val(data.status);
                    $('#penyimpanan_hidden').val(data.penyimpanan);
                    $('#jenis').val(data.jenis);
                    $('#episode').val(data.episode);
                    $('#rating').val(data.rating);
                    $('#sub_link').val(data.sub_link);
                    $('#film_link').val(data.film_link);
                    $('#release').val(data.release);
                    $('#poster').val(data.poster);
                    $('#ket').val(data.ket);
                })
            });

            $('body').on('click', '.hapus_film', function(){
                var film_id = $(this).data("id");
                $.ajax({
                    type: "DELETE",
                    url: "{{ route('film.store') }}"+'/'+film_id,
                    success : function(data) {
                        table.draw();                    
                    },
                    error : function(data) {
                        console.log('Error :', data);
                    }
                });
            });            
        });
    </script>
    <script type="text/javascript">
        // CSRF Token
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $(document).ready(function(){    
            $( "#penyimpanan" ).select2({                
                theme: 'bootstrap4',
                ajax: { 
                    url: "{{route('penyimpanan.get_penyimpanan')}}",
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
    <script type="text/javascript">
        // CSRF Token
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $(document).ready(function(){    
            $( "#genre" ).select2({                
                theme: 'bootstrap4',
                ajax: { 
                    url: "{{route('genre.get_genre')}}",
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
    <script type="text/javascript">
        // CSRF Token
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $(document).ready(function(){    
            $( "#pindah_hdd" ).select2({                
                theme: 'bootstrap4',
                width : '100%',
                dropdownParent: $('#modal_pindah'),
                ajax: { 
                    url: "{{route('penyimpanan.get_penyimpanan')}}",
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
    <script type="text/javascript">
        // CSRF Token
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $(document).ready(function(){    
            $( "#pindah_film" ).select2({                
                theme: 'bootstrap4',
                width : '100%',
                dropdownParent: $('#modal_pindah'),
                ajax: { 
                    url: "{{route('film.cari_film')}}",
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