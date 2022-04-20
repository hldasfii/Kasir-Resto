@extends('layouts.master')
@section('content')
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row align-items-center">
            <div class="col-6">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 d-flex align-items-center">
                <li class="breadcrumb-item">
                    <a href="{{ url('/manager') }}" class="link">
                    <i class="mdi mdi-home-outline fs-4"></i>
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Data Pembelian</li>
                </ol>
            </nav>
            </div>
        </div>
    </div>

        <!-- Modal -->
        <div class="modal fade" id="filterModal" tabindex="-1" role="dialog" aria-labelledby="filterModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="filterModalLabel">Filter Transaksi</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form onsubmit="return false">
                            <input class="form-control" type="date" name="start_date" id="startDate">
                            <br>
                            <input class="form-control" type="date" name="end_date" id="endDate">
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" id="btn-close-modal" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="filtering()">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    
    <div class="row">
        <!-- column -->
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                <div class="d-md-flex">
                    <div>
                        <button type="button" class="btn btn-primary float-right" data-bs-toggle="modal" data-bs-target="#filterModal">
                            Filter Transaksi
                        </button>
                        <a href="/manager/laporan/transaksi_pdf?all=true" class="btn btn-primary" target="_blank" id="btn-cetak">CETAK PDF</a>
                        <button class="btn btn-secondary float-right" onclick="resetData()">Reset filter</button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table mb-0 table-hover align-middle text-nowrap">
                        <thead>
                        <tr>
                            <th class="border-top-0">No</th>
                            <th class="border-top-0">Nama Pelanggan</th>
                            <th class="border-top-0">Menu</th>
                            <th class="border-top-0">Jumlah</th>
                            <th class="border-top-0">Total</th>
                            <th class="border-top-0">Nama Pegawai</th>
                            <th class="border-top-0">Tanggal</th>
                        </tr>
                        <tbody id="loadDataTransaksi">
                        </thead>
                    </table>
                </div>
                <br>
            </div>
        </div>
    </div>
</div>
@endsection
@section('cjs')
    <script>
        function hitData(url, data, type) {
            return new Promise((resolve, reject)=>{
                $.ajax({
                    url,
                    data,
                    type,
                    headers:{
                        'X-CSRF-TOKEN' : "{{ csrf_token() }}"
                    }, 
                    success:(respons)=>{
                        resolve(respons)
                    },
                    error:(error)=>{
                        reject(error)
                    }
                })
            })
        }

        async function getData(url = '/get-transaksi') {
            try {
                const respons = await hitData(url, null, 'GET')
                $('#loadDataTransaksi').html(respons);
                
            } catch (error) {
                console.log(error);
            }
        }

        function filtering() {
            var startDate = $('#startDate').val()
            var endDate = $('#endDate').val()

            getData(`/get-transaksi?start_date=${startDate}&end_date=${endDate}`, null, 'GET')
            $('#btn-close-modal').click()
            $('#btn-cetak').removeAttr('href').attr('href', `/manager/laporan/transaksi_pdf?all=${startDate}^${endDate}`)
        }

        function resetData() {
            getData();
            $('#btn-cetak').removeAttr('href').attr('href', `/manager/laporan/transaksi_pdf?all=true`)
        }

        getData();
    </script>
@endsection
