@extends('layouts.app')

@section('content')    

    <div class="container-fluid">
        <div class="row">

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Input/Edit</h4>
                        <form id="penyimpanan_form" name="penyimpanan_form">
                            <input type="hidden" name="penyimpanan_id" id="penyimpanan_id" value="">
                            <div class="form-group row">
                                <label for="hdd" class="col-sm-4">Penyimpanan</label>
                                <div class="col-sm-8">
                                    <input type="text" name="hdd" id="hdd" class="form-control" value="" required autofocus>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="ket" class="col-sm-4">Keterangan</label>
                                <div class="col-sm-8">
                                    <input type="text" name="ket" id="ket" class="form-control" value="">
                                </div>
                            </div>
                            <button class="btn btn-sm btn-success" type="submit" id="simpan_penyimpanan" value="create">Simpan</button>
                        </form>                                              
                    </div>
                </div><br> 
            </div>

            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Data Penyimpanan</h4>
                        <table class="table table-bordered table-sm" id="tabel_penyimpanan">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Penyimpanan</th>
                                    <th>Kapasitas</th>
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

            var table = $('#tabel_penyimpanan').DataTable({
                processing: true,
                serverSide: true,
                info: false,
                ajax : "{{ route('penyimpanan.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'hdd', name: 'hdd'},
                    {data: 'cap', name: 'cap', render : function(data, type, row){                        
                        return Math.ceil(data) + ' GB';
                    }},
                    {data: 'aksi', name: 'aksi', orderable: false, searchable: false, className : 'aksi'}
                ]
            });

            $('#simpan_penyimpanan').click(function(e){
                e.preventDefault();

                $.ajax({
                    type:'POST',
                    url: "{{ route('penyimpanan.store') }}",
                    data: $('#penyimpanan_form').serialize(),
                    success:function(data){
                        table.draw();
                        $('#penyimpanan_id').val("");
                        $('#hdd').val("");
                        $('#ket').val("");
                        swal ("Data Berhasil Di Tambahkan!", "",  "success" )
                    },
                    error : function(data) {
                        // swal ( "Oops" ,  "Ada Yang Salah!" ,  "error" )
                        swal({
                            title : "Oops",
                            text : "Ada Yang Salah!",
                            type : "warning"
                        });
                    }
                });
            });

            $('body').on('click', '.edit_penyimpanan', function(){
                var penyimpanan_id = $(this).data('id');
                $.get("{{ route('penyimpanan.index') }}" +'/'+penyimpanan_id + '/edit', function(data) {
                    $('#penyimpanan_id').val(data.id);
                    $('#hdd').val(data.hdd);
                    $('#ket').val(data.ket);
                })
            });

            $('body').on('click', '.hapus_penyimpanan', function(){
                var penyimpanan_id = $(this).data("id");

                swal({
                    title : "",
                    text : "Anda Yakin ?",
                    type : "warning",
                    showCancelButton: true,
                    confirmButtonClass: 'btn-danger waves-effect waves-light',
                    confirmButtonText: "Delete",
                    cancelButtonText: "Cancel",
                    closeOnConfirm: true,
                    closeOnCancel: true                  
                }, function(){
                    $.ajax({
                            type: "DELETE",
                            url: "{{ route('penyimpanan.store') }}"+'/'+penyimpanan_id,
                            success : function(data) {
                                swal ("Data Berhasil Di Hapus!", "",  "success" );
                                table.draw();                    
                            },
                            error : function(data) {
                                console.log('Error :', data);
                            }
                        });     
                
                });
                
                                                
            });            
        });
    </script>
@endsection