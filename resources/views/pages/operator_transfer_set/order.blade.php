@extends('layouts.template_default')
@section('title', 'Permintaan Order')
@section('order_request', 'active')
@section('content')
    <div class="content-wrapper">
        @include('sweetalert::alert')

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Permintaan Order</h1>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="Table" class="table table-bordered table-striped table-sm text-sm">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Tanggal</th>
                                                <th>Kode Produk</th>
                                                <th>Operator</th>
                                                <th>Nama Komponen</th>
                                                <th>Jumlah</th>
                                                <th>Jenis</th>
                                                <th>Status</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($orders as $request)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($request->created_at)->translatedFormat('d F Y') }}</td>
                                                    <td>{{ $request->komponen->kode_komponen }}</td>
                                                    <td>{{ $request->operator->name }}</td>
                                                    <td>{{ $request->komponen->nama_komponen  }}</td>
                                                    <td>{{ $request->jumlah }}</td>
                                                    <td>{{ $request->jenis_komponen }}</td>
                                                    <td>
                                                        @if ($request->status == 'pending')
                                                            <span class="badge badge-warning">Pending</span>
                                                        @elseif ($request->status == 'selesai')
                                                            <span class="badge badge-success">Selesai</span>
                                                        @elseif ($request->status == 'diproses')
                                                            <span class="badge badge-primary">Proses</span>
                                                        @else
                                                            <span class="badge badge-secondary">Null</span>
                                                        @endif
                                                    </td>

                                                    <td>

                                                    </td>
                                                </tr>


                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@endsection
