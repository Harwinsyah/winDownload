@extends('layouts.app')

@section('content')

    <div class="modal fade" id="modal_situs" tabindex="-1" role="dialog" aria-labelledby="situs_label" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <form id="situs_form" name="situs_form" enctype="multipart/form-data">
                        <input type="hidden" name="situs_id" id="situs_id" value="">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="nama">Nama</label>
                                <input type="text" class="form-control" name="nama" id="nama" autofocus placeholder="Nama Situs">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="link">Link</label>
                                <input type="text" class="form-control" name="link" id="link" placeholder="http://www....">
                            </div>                            
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="jenis">Jenis</label>
                                <textarea name="jenis" id="jenis" rows="5" class="form-control"></textarea>                  
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                        <button class="btn btn-sm btn-success" type="submit" id="simpan_situs" value="create">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>    

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title float-left">Data Situs</h4>
                        <button class="btn btn-success float-right" type="button" id="situs_btn"><span class="fas fa-plus-circle"></span> Situs</button>
                    </div>
                    <div class="card-body">                        
                        <table class="table table-bordered table-sm" id="tabel_situs">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Situs</th>
                                    <th>Jenis</th>
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

            var table = $('#tabel_situs').DataTable({
                processing: true,
                serverSide: true,
                info: false,
                ajax : "{{ route('situs.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'situs', name: 'situs'},
                    {data: 'jenis', name: 'jenis'},
                    {data: 'aksi', name: 'aksi', orderable: false, searchable: false, className : 'aksi'}
                ]
            });

            $('#modal_situs').on('shown.bs.modal', function() {
                $('#nama').trigger('focus');
            });

            $('#simpan_situs').click(function(e){
                e.preventDefault();                

                $.ajax({
                    type:'POST',
                    url: "{{ route('situs.store') }}",
                    data: $('#situs_form').serialize(),
                    success:function(data){
                        table.draw();
                        $('#modal_situs').modal('hide');                        
                        $('#situs_id').val("");                        
                        $('#nama').val("");                        
                        $('#jenis').val("");
                        $('#link').val("");
                    },
                    error : function(data) {
                        alert("ada yang salah");
                    }
                });
            });

            $('body').on('click', '#situs_btn', function(){
                $('#modal_situs').modal('show');
                $('#situs_id').val("");                        
                $('#nama').val("");                        
                $('#jenis').val("");
                $('#link').val("");
            });

            
            $('body').on('click', '.edit_situs', function(){
                var situs_id = $(this).data('id');                
                $.get("{{ route('situs.index') }}" +'/'+situs_id + '/edit', function(data) {                                        

                    $('#modal_situs').modal('show');
                    $('#situs_id').val(data.id);
                    $('#nama').val(data.nama);
                    $('#link').val(data.link);
                    $('#jenis').val(data.jenis);
                    
                })
            });

            $('body').on('click', '.hapus_situs', function(){
                var situs_id = $(this).data("id");
                $.ajax({
                    type: "DELETE",
                    url: "{{ route('situs.store') }}"+'/'+situs_id,
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