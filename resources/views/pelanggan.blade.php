@extends('layouts.app')

@section('content')    

    <div class="container-fluid">
        <div class="row">

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Input/Edit</h4>
                        <form id="pelanggan_form" name="pelanggan_form">
                            <input type="hidden" name="pelanggan_id" id="pelanggan_id" value="">
                            <div class="form-group row">
                                <label for="nama" class="col-sm-4">Nama</label>
                                <div class="col-sm-8">
                                    <input type="text" name="nama" id="nama" class="form-control form-control-sm" value="" required autofocus>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="jk" class="col-sm-4">Kelamin</label>
                                <div class="col-sm-8">
                                    <div class="form-check form-check-inline">
                                        <input type="radio" class="form-check-input" name="jk" id="jk_P" value="Pria" checked> Pria
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" class="form-check-input" name="jk" id="jk_W" value="Wanita"> Wanita
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="alamat" class="col-sm-4">Alamat</label>
                                <div class="col-sm-8">
                                    <textarea name="alamat" id="alamat" rows="3" class="form-control form-control-sm"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="hp" class="col-sm-4">HP</label>
                                <div class="col-sm-8">
                                    <input type="text" name="hp" id="hp" class="form-control form-control-sm" value="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="wa" class="col-sm-4">WA</label>
                                <div class="col-sm-8">
                                    <input type="text" name="wa" id="wa" class="form-control form-control-sm" value="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="fb" class="col-sm-4">FB</label>
                                <div class="col-sm-8">
                                    <input type="text" name="fb" id="fb" class="form-control form-control-sm" value="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="ig" class="col-sm-4">IG</label>
                                <div class="col-sm-8">
                                    <input type="text" name="ig" id="ig" class="form-control form-control-sm" value="">
                                </div>
                            </div>                            
                            <div class="form-group row">
                                <label for="ket" class="col-sm-4">Keterangan</label>
                                <div class="col-sm-8">
                                    <input type="text" name="ket" id="ket" class="form-control form-control-sm" value="">
                                </div>
                            </div>
                            <button class="btn btn-sm btn-success" type="submit" id="simpan_pelanggan" value="create">Simpan</button>
                        </form>                                              
                    </div>
                </div><br> 
            </div>

            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Data Pelanggan</h4>
                        <table class="table table-bordered table-sm" id="tabel_pelanggan">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Kelamin</th>
                                    <th>HP</th>
                                    <th>Sosmed</th>
                                    <th>Ambil</th>
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

            var table = $('#tabel_pelanggan').DataTable({
                processing: true,
                serverSide: true,
                info: false,
                ajax : "{{ route('pelanggan.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'nama', name: 'nama'},
                    {data: 'jk', name: 'jk'},
                    {data: 'hp', name: 'hp'},
                    {data: 'fb', name: 'fb'},
                    {data: 'harga', name: 'harga'},
                    {data: 'aksi', name: 'aksi', orderable: false, searchable: false, className : 'aksi'}
                ]
            });

            $('#simpan_pelanggan').click(function(e){
                e.preventDefault();

                $.ajax({
                    type:'POST',
                    url: "{{ route('pelanggan.store') }}",
                    data: $('#pelanggan_form').serialize(),
                    success:function(data){
                        table.draw();
                        $('#pelanggan_id').val("");
                        $('#nama').val("");
                        $('#jk_P').prop("checked", true);
                        $('#alamat').val("");
                        $('#hp').val("");
                        $('#fb').val("");
                        $('#ig').val("");
                        $('#wa').val("");
                        $('#ket').val("");
                    },
                    error : function(data) {
                        alert(data);
                    }
                });
            });

            $('body').on('click', '.edit_pelanggan', function(){
                var pelanggan_id = $(this).data('id');
                $.get("{{ route('pelanggan.index') }}" +'/'+pelanggan_id + '/edit', function(data) {
                    $('#pelanggan_id').val(data.id);
                    $('#nama').val(data.nama);                    
                    $('#alamat').val(data.alamat);
                    $('#hp').val(data.hp);
                    $('#wa').val(data.wa);
                    $('#fb').val(data.fb);
                    $('#ig').val(data.ig);
                    $('#ket').val(data.ket);
                    if (data.jk == "Pria") {
                        $('#jk_P').prop("checked", true);
                    } else {
                        $('#jk_W').prop("checked", true);
                    }
                })
            });

            $('body').on('click', '.hapus_pelanggan', function(){
                var pelanggan_id = $(this).data("id");
                $.ajax({
                    type: "DELETE",
                    url: "{{ route('pelanggan.store') }}"+'/'+pelanggan_id,
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