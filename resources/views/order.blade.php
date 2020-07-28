@extends('layouts.app')

@section('content')    

<div class="modal fade" id="modal_order_ready" tabindex="-1" role="dialog" aria-labelledby="modal_order_Label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <form id="order_detail_ready_form" name="order_detail_ready_form">
                    <input type="text" id="order_detail_ready" name="order_detail_ready" value="Ready">
                    <input type="text" id="order_ready_id" name="order_ready_id" value="">
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_orderan" tabindex="-1" role="dialog" aria-labelledby="orderan_label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="orderan_label">Tambah Orderan</h4>
            </div>
            <div class="modal-body">
                <form id="order_form" name="order_form">
                    <input type="hidden" name="order_id" id="order_id" value="">
                    <input type="hidden" value="{{ Auth::user()->id }}" name="kasir_id" id="kasir_id">
                    <input type="hidden" name="invoice_order" id="invoice_order" value="">
                    <div class="form-group row" id="input_baru_orderan">
                        <label for="nama_pelanggan" class="col-sm-2">Nama</label>
                        <div class="col-sm-10">
                            <select name="nama_pelanggan" id="nama_pelanggan"></select>                            
                        </div>
                    </div> 
                    <div class="form-group row" id="edit_baru_orderan">
                        <label for="nama_pelanggan_order" class="col-sm-2">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" name="nama_pelanggan_order" id="nama_pelanggan_order" class="form-control">
                        </div>
                    </div> 
                    <div class="form-group row">
                        <label for="status" class="col-sm-2">Status</label>
                        <div class="col-sm-10">
                            <select name="status" id="status" class="form-control">
                                <option value="">Status</option>
                                <option value="1">Didahulukan</option>
                                <option value="2">On Proses</option>
                                <option value="3">Install OS</option>
                                <option value="4">Ready Belum Di Ambil</option>
                                <option value="5">Selesai</option>
                            </select>
                        </div>
                    </div> 
                    <div class="form-group row">
                        <label for="keterangan" class="col-sm-2">Ket</label>
                        <div class="col-sm-10">
                            <input type="text" id="keterangan" class="form-control" name="keterangan">
                        </div>
                    </div>                                                             
            </div>
            <div class="modal-footer">
                    <button class="btn btn-sm btn-success" type="submit" id="simpan_order" value="create">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div> 

<div class="modal fade" id="modal_order" tabindex="-1" role="dialog" aria-labelledby="modal_order_Label" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <h4 id="detail_nama_pelanggan"></h4>
                <form id="order_detail_form" name="order_detail_form" enctype="multipart/form-data">
                    <input type="hidden" name="order_detail_ready_id" id="order_detail_id" value="">
                    <input type="hidden" name="invoice" id="invoice" value="">
                    <input type="hidden" name="id_order" id="id_order" value="">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="film">Film Ready</label>
                            <select name="film_detail" id="film_detail"></select>                            
                        </div>
                        <div class="form-group col-md-4">
                            <label for="film">No Ready</label>
                            <input type="text" name="film_detail_2" class="form-control" id="film_detail_2" autofocus>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="status_detail">Status</label>
                            <select name="status_detail" id="status_detail" class="form-control">
                                <option value="">- Status -</option>
                                <option value="1">Download</option>
                                <option value="2">Transfer</option>
                                <option value="3">Ready</option>
                                <option value="4">No Link</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-2">
                            <label for="ukuran">Ukuran</label>
                            <input type="number" name="ukuran_detail" class="form-control" id="ukuran_detail" value="0">
                        </div>                        
                        <div class="form-group col-md-3">
                            <label for="ket">Lokasi</label>
                            <select name="lokasi_detail" id="lokasi_detail"></select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="link_download">Link Download</label>
                            <input type="text" name="link_download" class="form-control" id="link_download">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="keterangan_detail">Ket</label>
                            <input type="text" name="keterangan_detail" class="form-control" id="keterangan_detail">
                        </div>
                    </div> 
                    <button class="btn btn-sm btn-success" type="submit" id="simpan_order_detail" value="create">Simpan</button>                                        
                    <div class="row">
                        <div class="col-md-12" id="orderan">
                            <table class="table table-bordered table-striped table-sm" id="tabel_order_detail">
                                <thead>
                                    <tr>
                                        <th>Invoice</th>
                                        <th>Judul</th>
                                        <th>Ukuran</th>
                                        <th>Lokasi</th>
                                        <th>Status</th>
                                        <th>Ket</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>                    
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
                        <h4 class="card-title float-left">Data Orderan</h4>
                        <button class="btn btn-success float-right" type="button" id="order_btn"><span class="fas fa-plus-circle"></span> Orderan</button>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped table-sm" id="tabel_order">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Invoice</th>
                                    <th>Ukuran</th>
                                    <th>Bayar</th>
                                    <th>Keterangan</th>
                                    <th>Status</th>
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

            var table = $('#tabel_order').DataTable({
                processing: true,
                serverSide: true,
                info: false,
                ajax : "{{ route('order.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', className : 'tengah'},
                    {data: 'nama_pelanggan', name: 'nama_pelanggan'},
                    {data: 'invoice', name: 'invoice'},
                    {data: 'ukuran', name: 'ukuran', render: function(data, type, row){
                        if (data == null) {
                            return '0 GB';
                        } else {
                            return data + ' GB';
                        }
                    }},
                    {data: 'bayar', name: 'bayar', render: $.fn.dataTable.render.number(',', '.', 0, 'Rp. ')},
                    {data: 'ket', name: 'ket'},                    
                    {data: 'status', name: 'status', className : 'status', render: function (data, type, row) {
                        if (data == 1) {
                            return "Didahulukan";
                        } if (data == 2) {
                            return "On Proses";
                        } if (data == 3) {
                            return "Install OS";
                        } if (data == 4) {
                            return "Ready Belum Di Ambil";
                        } else {
                            return "Selesai";
                        }
                    }},
                    {data: 'aksi', name: 'aksi', orderable: false, searchable: false, className : 'aksi'}
                ], 
                order : [6, 'asc']
            });

            var table2 = $('#tabel_order_detail').DataTable({
                processing: true,
                serverSide: true,
                info: false,
                searching: true,
                paginate: false, 
                autoWidth : false,               
                ajax : "{{ route('orderdetail.index') }}",
                columns: [
                    {data: 'invoice', name: 'invoice'},
                    {data: 'link', name: 'link'},
                    {data: 'ukuran', name: 'ukuran'},
                    {data: 'lokasi', name: 'lokasi'},
                    {data: 'status', name: 'status', className: 'tengah', render: function (data, type, row){
                        if (data == 1) {
                            return "Download";
                        } if (data == 2) {
                            return "Transfer";
                        } if (data == 3) {
                            return "Ready";
                        } if (data == 4) {
                            return "No Link"
                        }
                        else {
                            return "";
                        }
                    }},                    
                    {data: 'ket', name: 'ket'},                    
                    {data: 'aksi', name: 'aksi', orderable: false, searchable: false, className : 'aksi'}
                ],
                order : [4, 'asc']
            });

            $('#simpan_order').click(function(e){
                e.preventDefault();

                $.ajax({
                    type:'POST',
                    url: "{{ route('order.store') }}",
                    data: $('#order_form').serialize(),
                    success:function(data){
                        $('#modal_orderan').modal('hide');
                        table.draw();
                        $('#nama_pelanggan').load(' #nama_pelanggan');
                        $('#order_id').val("");
                        $('#nama_pelanggan').val("");
                        $('#keterangan').val("");
                        $('#status').val("");
                        $('#invoice_order').val("");
                        $('#nama_pelanggan_order').val("");
                    },
                    error : function(data) {
                        alert(data);
                    }
                });
            });

            $('body').on('click', '#simpan_order_detail', function(e){
                e.preventDefault();

                $.ajax({
                    type:'POST',
                    url: "{{ route('orderdetail.store') }}",
                    data: $('#order_detail_form').serialize(),
                    success:function(data){
                        table.draw();
                        table2.draw();
                        $('#film_detail').load(' #film_detail');
                        $('#lokasi_detail').load(' #lokasi_detail');                        
                        $('#film_detail_2').val("");
                        $('#ukuran_detail').val(0);
                        $('#status_detail').val("");                        
                        $('#keterangan_detail').val("");                        
                        $('#link_download').val("");                        
                        $('#order_detail_id').val("");                        
                    },
                    error : function(data) {
                        alert(data);
                    }
                });
            });

            $('body').on('click', '#order_btn', function(){
                $('#modal_orderan').modal('show');                
                $('#nama_pelanggan').val("");
                $('#nama_pelanggan_order').val("");
                $('#status').val("");
                $('#keterangan').val("");
                $('#input_baru_orderan').show();
                $('#edit_baru_orderan').hide();
            });

            $('body').on('click', '.edit_order', function(){
                var order_id = $(this).data('id');
                $.get("{{ route('order.index') }}" +'/'+order_id + '/edit', function(data) {
                    $('#modal_orderan').modal('show');
                    $('#input_baru_orderan').hide();
                    $('#edit_baru_orderan').show();
                    $('#order_id').val(data.id);
                    $('#nama_pelanggan_order').val(data.nama_pelanggan);
                    $('#keterangan').val(data.ket);
                    $('#status').val(data.status);
                    $('#invoice_order').val(data.invoice);
                    // $('#status : selected').val(data.status);

                });                
            });

            $('body').on('click', '.orderan', function(){
                var order_id = $(this).data('id');
                $.get("{{ route('order.index') }}" +'/'+order_id + '/edit', function(data) {
                    $('#modal_order').modal('show');
                    $('#invoice').val(data.invoice);
                    $('#id_order').val(data.id);

                    var invoice = document.getElementById("invoice").value;

                        table2.search( invoice ).draw();
                        
                        // $('#ket_detail').on( 'keyup', function () {
                        // table2.search( this.value ).draw();
                        // } );
                });                
            });
            $('body').on('click', '.edit_order_detail', function(){
                var order_id = $(this).data('id');
                $.get("{{ route('orderdetail.index') }}" +'/'+order_id + '/edit', function(data) {
                    $('#invoice').val(data.invoice);
                    $('#order_detail_id').val(data.id);
                    $('#film_detail_2').val(data.judul);
                    $('#ukuran_detail').val(data.ukuran);
                    $('#lokasi_detail').val(data.lokasi);
                    $('#status_detail').val(data.status);
                    $('#keterangan_detail').val(data.ket);
                    $('#link_download').val(data.link);

                });                
            });

            $('body').on('click', '.hapus_order', function(){
                var order_id = $(this).data("id");
                $.ajax({
                    type: "DELETE",
                    url: "{{ route('order.store') }}"+'/'+order_id,
                    success : function(data) {
                        table.draw();                    
                    },
                    error : function(data) {
                        console.log('Error :', data);
                    }
                });
            });

            $('body').on('click', '.hapus_order_detail', function(){
                var order_id = $(this).data("id");
                $.ajax({
                    type: "DELETE",
                    url: "{{ route('orderdetail.store') }}"+'/'+order_id,
                    success : function(data) {
                        table2.draw();                    
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
            $( "#nama_pelanggan" ).select2({                
                theme: 'bootstrap4',
                width : '100%',
                dropdownParent: $('#modal_orderan'),
                ajax: { 
                    url: "{{route('pelanggan.get_pelanggan')}}",
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
            $( "#film_detail" ).select2({  
                placeholder: 'Cari...',              
                width : '100%',
                theme: 'bootstrap4',
                dropdownParent: $('#modal_order'),
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
    <script type="text/javascript">
        // CSRF Token
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $(document).ready(function(){                
            $( "#lokasi_detail" ).select2({  
                placeholder: 'Cari...',              
                width : '100%',
                theme: 'bootstrap4',
                dropdownParent: $('#modal_order'),
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
    
@endsection