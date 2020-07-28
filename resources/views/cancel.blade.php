@extends('layouts.app')

@section('content')    

    <div class="container-fluid">
        <div class="row">

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Input/Edit</h4>
                        <form id="cancel_form" name="cancel_form">
                            <input type="hidden" name="cancel_id" id="cancel_id" value="">
                            <div class="form-group row">
                                <label for="cancel" class="col-sm-4">Cancel</label>
                                <div class="col-sm-8">
                                    <input type="text" name="cancel" id="cancel" class="form-control" value="" required autofocus>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="ket" class="col-sm-4">Keterangan</label>
                                <div class="col-sm-8">
                                    <input type="text" name="ket" id="ket" class="form-control" value="">
                                </div>
                            </div>
                            <button class="btn btn-sm btn-success" type="submit" id="simpan_cancel" value="create">Simpan</button>
                        </form>                                              
                    </div>
                </div><br> 
            </div>

            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Data Cancel</h4>
                        <table class="table table-bordered table-sm" id="tabel_cancel">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Cancel</th>
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

            var table = $('#tabel_cancel').DataTable({
                processing: true,
                serverSide: true,
                info: false,
                ajax : "{{ route('cancel.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'cancel', name: 'cancel'},
                    {data: 'ket', name: 'ket'},
                    {data: 'aksi', name: 'aksi', orderable: false, searchable: false, className : 'aksi'}
                ]
            });

            $('#simpan_cancel').click(function(e){
                e.preventDefault();

                $.ajax({
                    type:'POST',
                    url: "{{ route('cancel.store') }}",
                    data: $('#cancel_form').serialize(),
                    success:function(data){
                        table.draw();
                        $('#cancel_id').val("");
                        $('#cancel').val("");
                        $('#ket').val("");
                    },
                    error : function(data) {
                        alert(data);
                    }
                });
            });

            $('body').on('click', '.edit_cancel', function(){
                var cancel_id = $(this).data('id');
                $.get("{{ route('cancel.index') }}" +'/'+cancel_id + '/edit', function(data) {
                    $('#cancel_id').val(data.id);
                    $('#cancel').val(data.cancel);
                    $('#ket').val(data.ket);
                })
            });

            $('body').on('click', '.hapus_cancel', function(){
                var cancel_id = $(this).data("id");
                $.ajax({
                    type: "DELETE",
                    url: "{{ route('cancel.store') }}"+'/'+cancel_id,
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