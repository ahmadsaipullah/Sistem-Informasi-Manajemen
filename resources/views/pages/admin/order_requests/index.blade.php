@extends('layouts.template_default')
@section('title', 'Permintaan Komponen')
@section('order_request', 'active')
@section('content')
    <div class="content-wrapper">
        @include('sweetalert::alert')

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Permintaan Komponen</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Permintaan Komponen</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#createModal">
                                    <i class="fa fa-plus"></i> Tambah Permintaan
                                </button>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="Table" class="table table-bordered table-striped table-sm text-sm">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Tanggal Dibuat</th>
                                                <th>Kode Produk</th>
                                                <th>Operator</th>
                                                <th>Nama Komponen</th>
                                                <th>Jumlah</th>
                                                <th>Jenis</th>
                                                <th>Tanggal Deadline</th>
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
                                                        {{ \Carbon\Carbon::parse($request->tanggal_dedline)->translatedFormat('d F Y') }}
                                                    </td>
                                                    <td>
                                                        @if ($request->status == 'Selesai')
                                                        <select class="form-select form-select-sm status-select"
                                                                data-id="{{ $request->id }}"
                                                                {{ in_array($request->status, ['diproses', 'Selesai']) ? 'disabled' : '' }}>
                                                            <option value="pending" {{ $request->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                            <option value="diproses" {{ $request->status == 'diproses' ? 'selected' : '' }}>Diproses</option>
                                                            <option value="Selesai" {{ $request->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                                        </select>
                                                        @else
                                                        <select class="form-select form-select-sm status-select"
        data-id="{{ $request->id }}"
        {{ $request->status == 'diproses' ? 'disabled' : '' }}>
    <option value="pending" {{ $request->status == 'pending' ? 'selected' : '' }}>Pending</option>
    <option value="diproses" {{ $request->status == 'diproses' ? 'selected' : '' }}>Diproses</option>
</select>
                                                        @endif
                                                    </td>


                                                    <td>
                                                        @if(!in_array(strtolower($request->status), ['diproses', 'selesai']))
                                                            <!-- Tombol Edit -->
                                                            <a href="#" class="btn btn-warning btn-sm mx-2" data-toggle="modal" data-target="#modal-edit-{{ $request->id }}">
                                                                <i class="fa fa-pen"></i>
                                                            </a>

                                                            <!-- Tombol Hapus -->
                                                            <form action="{{ route('order_requests.destroy', $request->id) }}" method="POST" style="display:inline;" class="delete_confirm">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger btn-sm">
                                                                    <i class="fa fa-trash"></i>
                                                                </button>
                                                            </form>
                                                        @else
                                                            <!-- Jika status Diproses, tombol Edit dan Hapus disable -->
                                                            <button class="btn btn-warning btn-sm mx-2" disabled>
                                                                <i class="fa fa-pen"></i>
                                                            </button>
                                                            <button class="btn btn-danger btn-sm" disabled>
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        @endif
                                                    </td>

                                                </tr>

                                                @include('pages.admin.order_requests.edit', ['request' => $request])
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

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            function setStatusColor(select) {
                const status = select.value;
                select.classList.remove('bg-warning', 'bg-primary', 'text-white');

                if (status === 'pending') {
                    select.classList.add('bg-warning');
                } else if (status === 'diproses') {
                    select.classList.add('bg-primary', 'text-white');
                }else if (status === 'Selesai') {
                    select.classList.add('bg-success', 'text-white');
                }
            }

            const selects = document.querySelectorAll('.status-select');

            selects.forEach(select => {
                // Warna awal
                setStatusColor(select);

                select.addEventListener('change', function (e) {
                    const status = this.value;
                    const id = this.getAttribute('data-id');
                    const el = this;

                    fetch(`/admin/order_requests/${id}/update-status`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        },
                        body: JSON.stringify({ status: status })
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            setStatusColor(el);
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: data.message,
                                timer: 1500,
                                showConfirmButton: false
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: 'Gagal mengupdate status.'
                            });
                        }
                    })
                    .catch(error => {
                        console.error(error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Terjadi kesalahan koneksi.'
                        });
                    });
                });
            });
        });
    </script>



    @include('pages.admin.order_requests.create')
@endsection
