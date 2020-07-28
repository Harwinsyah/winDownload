@extends('layouts.app')

@section('content')

    <div class="modal fade" id="modal_accounting" tabindex="-1" role="dialog" aria-labelledby="accounting_label" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <form id="accounting_form" name="accounting_form" enctype="multipart/form-data">
                        <input type="hidden" name="accounting_id" id="accounting_id" value="">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="desc">Deskripsi</label>
                                <input type="text" class="form-control" name="desc" id="desc" autofocus>
                            </div>
                            <div class="form-group col-md-3" id="pemasukan_input">
                                <label for="pemasukan">Pemasukan</label>
                                <input type="number" class="form-control" name="pemasukan" id="pemasukan">
                            </div>                             
                            <div class="form-group col-md-3" id="pengeluaran_input">
                                <label for="pengeluaran">Pengeluaran</label>
                                <input type="number" class="form-control" name="pengeluaran" id="pengeluaran">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="tgl">Tanggal</label>
                                <input type="date" class="form-control" name="tgl" id="tgl">
                            </div>
                        </div>                                        
                </div>
                <div class="modal-footer">
                        <button class="btn btn-sm btn-success" type="submit" id="simpan_accounting" value="create">Simpan</button>
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
                        <h4 class="card-title float-left">Data Pemasukan dan Pengeluaran</h4>
                        <div class="float-right">                            
                            <button class="btn btn-success btn-sm" type="button" id="pemasukkan_btn">Pemasukan</button>
                            <button class="btn btn-primary btn-sm" type="button" id="pengeluaran_btn">Pengeluaran</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-sm" id="tabel_accounting">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Desc</th>
                                    <th>Pemasukan</th>
                                    <th>Pengeluaran</th>
                                    <th>Tanggal</th>                                    
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

            var table = $('#tabel_accounting').DataTable({
                processing: true,
                serverSide: true,
                info: false,
                ajax : "{{ route('accounting.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'desc', name: 'desc'},
                    {data: 'pemasukan', name: 'pemasukan', render: $.fn.dataTable.render.number(',', '.', 0, 'Rp. ')},
                    {data: 'pengeluaran', name: 'pengeluaran', render: $.fn.dataTable.render.number(',', '.', 0, 'Rp. ')},
                    {data: 'tgl', name: 'tgl'},                    
                    {data: 'aksi', name: 'aksi', orderable: false, searchable: false, className : 'aksi'}
                ]
            });

            $('#modal_accounting').on('shown.bs.modal', function() {
                $('#desc').trigger('focus');
            });

            $('#simpan_accounting').click(function(e){
                e.preventDefault();                

                $.ajax({
                    type:'POST',
                    url: "{{ route('accounting.store') }}",
                    data: $('#accounting_form').serialize(),
                    success:function(data){
                        table.draw();
                        $('#modal_accounting').modal('hide');                        
                        $('#accounting_id').val("");                        
                        $('#desc').val("");                        
                        $('#pemasukan').val("");
                        $('#pengeluaran').val("");
                    },
                    error : function(data) {
                        alert("ada yang salah");
                    }
                });
            });

            $('body').on('click', '#pemasukkan_btn', function(){
                $('#modal_accounting').modal('show');
                $('#pengeluaran_input').hide();
                $('#pemasukan_input').show();
            });

            $('body').on('click', '#pengeluaran_btn', function(){
                $('#modal_accounting').modal('show');
                $('#pengeluaran_input').show();
                $('#pemasukan_input').hide();
            });
            
            $('body').on('click', '.edit_accounting', function(){
                var accounting_id = $(this).data('id');                
                $.get("{{ route('accounting.index') }}" +'/'+accounting_id + '/edit', function(data) {                                        

                    $('#modal_accounting').modal('show');
                    $('#accounting_id').val(data.id);
                    $('#desc').val(data.desc);

                    if (data.pengeluaran == null) {
                        $('#pengeluaran_input').hide();
                        $('#pemasukan_input').show();
                        $('#pemasukan').val(data.pemasukan);
                        $('#pengeluaran').val("");
                    } else {
                        $('#pengeluaran_input').show();
                        $('#pemasukan_input').hide();
                        $('#pengeluaran').val(data.pengeluaran);                    
                        $('#pemasukan').val("");
                    }
                })
            });

            $('body').on('click', '.hapus_accounting', function(){
                var accounting_id = $(this).data("id");
                $.ajax({
                    type: "DELETE",
                    url: "{{ route('accounting.store') }}"+'/'+accounting_id,
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