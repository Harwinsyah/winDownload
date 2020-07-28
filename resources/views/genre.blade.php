@extends('layouts.app')

@section('content')

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

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Input/Edit</h4>
                        <form id="genre_form" name="genre_form">
                            <input type="hidden" name="genre_id" id="genre_id" value="">
                            <div class="form-group row">
                                <label for="nama" class="col-sm-4">Nama</label>
                                <div class="col-sm-8">
                                    <input type="text" name="nama" id="nama" class="form-control" value="" required autofocus>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="ket" class="col-sm-4">Keterangan</label>
                                <div class="col-sm-8">
                                    <input type="text" name="ket" id="ket" class="form-control" value="">
                                </div>
                            </div>
                            <button class="btn btn-sm btn-success" type="submit" id="simpan_genre" value="create">Simpan</button>
                        </form>                                              
                    </div>
                </div><br>

                <div class="card">
                    <div class="card-body">
                        <h4>Excel</h4>
                        <a href="{{ url('export') }}" class="btn btn-success btn-sm" target="_blank">Export</a>                                                
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">
                            Import
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Data Genre/Kategori</h4>
                        <table class="table table-bordered table-sm" id="tabel_genre">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Keterangan</th>
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

            var table = $('#tabel_genre').DataTable({
                processing: true,
                serverSide: true,
                info: false,
                ajax : "{{ route('genre.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'nama', name: 'nama'},
                    {data: 'ket', name: 'ket'},
                    {data: 'aksi', name: 'aksi', orderable: false, searchable: false, className : 'aksi'}
                ]
            });

            $('#simpan_genre').click(function(e){
                e.preventDefault();

                $.ajax({
                    type:'POST',
                    url: "{{ route('genre.store') }}",
                    data: $('#genre_form').serialize(),
                    success:function(data){
                        table.draw();
                        $('#genre_id').val("");
                        $('#nama').val("");
                        $('#ket').val("");
                    },
                    error : function(data) {
                        alert(data);
                    }
                });
            });

            $('body').on('click', '.edit_genre', function(){
                var genre_id = $(this).data('id');
                $.get("{{ route('genre.index') }}" +'/'+genre_id + '/edit', function(data) {
                    $('#genre_id').val(data.id);
                    $('#nama').val(data.nama);
                    $('#ket').val(data.ket);
                })
            });

            $('body').on('click', '.hapus_genre', function(){
                var genre_id = $(this).data("id");
                $.ajax({
                    type: "DELETE",
                    url: "{{ route('genre.store') }}"+'/'+genre_id,
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
@endsection