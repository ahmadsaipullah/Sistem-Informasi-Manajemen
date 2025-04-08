@extends('layouts.template_default')
@section('title', 'Pt Selamat Sempurna Tbk')
@section('dashboard', 'active ')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Selamat Datang, <span
                                class="btn btn-xs btn-success font-italic">{{ auth()->user()->name }}</span> Selamat Sempurna
                            Tbk</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                @if (auth()->user()->level_id == 1)
                    <div class="row">
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-primary">
                                <div class="inner">
                                    <h3>{{ $user }}</h3>

                                    <p>User Registrations</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person-add"></i>
                                </div>
                                <a href="{{ route('admin.index') }}" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                           <!-- Card 1: Komponen Belum Diinput -->
                           <div class="col-lg-3 col-12">
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <h3>{{ $belumInputCount }}</h3>
                                    <p>Komponen Belum Diinput</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-alert-circled"></i>
                                </div>
                                <a href="{{ route('hasil-wip.index') }}" class="small-box-footer">Lihat Daftar <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>

                        <!-- Card 2: Total WIP Komponen -->
                        <div class="col-lg-3 col-12">
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>{{ $wipBelumInput->count() + \App\Models\HasilProduksi::pluck('produksi_id')->count() }}
                                    </h3>
                                    <p>Total WIP Komponen</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-cube"></i>
                                </div>
                                <a href="{{ route('hasil-wip.index') }}" class="small-box-footer">Detail <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>

                        <!-- Card 3: Total Hasil Produksi -->
                        <div class="col-lg-3 col-12">
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3>{{ $hasilProduksis->count() }}</h3>
                                    <p>Total Hasil Produksi</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-checkmark-circled"></i>
                                </div>
                                <a href="{{ route('hasil-produksi.index') }}" class="small-box-footer">Lihat Semua <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                        @elseif (auth()->user()->level_id == 2)
                        <div class="row">
                            <!-- Card 1: Komponen Belum Diinput -->
                            <div class="col-lg-4 col-12">
                                <div class="small-box bg-warning">
                                    <div class="inner">
                                        <h3>{{ $belumInputCount }}</h3>
                                        <p>Komponen Belum Diinput</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-alert-circled"></i>
                                    </div>
                                    <a href="{{ route('hasil-wip.index') }}" class="small-box-footer">Lihat Daftar <i
                                            class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>

                            <!-- Card 2: Total WIP Komponen -->
                            <div class="col-lg-4 col-12">
                                <div class="small-box bg-info">
                                    <div class="inner">
                                        <h3>{{ $wipBelumInput->count() + \App\Models\HasilProduksi::pluck('produksi_id')->count() }}
                                        </h3>
                                        <p>Total WIP Komponen</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-cube"></i>
                                    </div>
                                    <a href="{{ route('hasil-wip.index') }}" class="small-box-footer">Detail <i
                                            class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>

                            <!-- Card 3: Total Hasil Produksi -->
                            <div class="col-lg-4 col-12">
                                <div class="small-box bg-success">
                                    <div class="inner">
                                        <h3>{{ $hasilProduksis->count() }}</h3>
                                        <p>Total Hasil Produksi</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-checkmark-circled"></i>
                                    </div>
                                    <a href="{{ route('hasil-produksi.index') }}" class="small-box-footer">Lihat Semua <i
                                            class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                        </div>
                        @elseif (auth()->user()->level_id == 3)
                        <div class="row">
                            {{-- Order Pending --}}
                            <div class="col-lg-4 col-6">
                                <div class="small-box bg-secondary">
                                    <div class="inner">
                                        <h3>{{ $countPending }}</h3>
                                        <p>Order Pending</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-clock"></i>
                                    </div>
                                    <a href="#" class="small-box-footer">More info <i
                                            class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>

                            {{-- Order Diproses --}}
                            <div class="col-lg-4 col-6">
                                <div class="small-box bg-warning">
                                    <div class="inner">
                                        <h3>{{ $countDiproses }}</h3>
                                        <p>Order Diproses</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-loop"></i>
                                    </div>
                                    <a href="#" class="small-box-footer">More info <i
                                            class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>

                            {{-- Order Selesai --}}
                            <div class="col-lg-4 col-6">
                                <div class="small-box bg-success">
                                    <div class="inner">
                                        <h3>{{ $countSelesai }}</h3>
                                        <p>Order Selesai</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-checkmark-circled"></i>
                                    </div>
                                    <a href="#" class="small-box-footer">More info <i
                                            class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            </div>
                        @elseif(auth()->user()->level_id == 4)
                            <div class="row">

                                {{-- Diproses --}}
                                <div class="col-lg-6 col-6">
                                    <div class="small-box bg-warning">
                                        <div class="inner">
                                            <h3>{{ $countDiproses }}</h3>
                                            <p>Order Diproses</p>
                                        </div>
                                        <div class="icon">
                                            <i class="ion ion-loop"></i>
                                        </div>
                                        <a href="{{ route('order.index') }}" class="small-box-footer">More info <i
                                                class="fas fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>

                                {{-- Selesai --}}
                                <div class="col-lg-6 col-6">
                                    <div class="small-box bg-success">
                                        <div class="inner">
                                            <h3>{{ $countSelesai }}</h3>
                                            <p>Order Selesai</p>
                                        </div>
                                        <div class="icon">
                                            <i class="ion ion-checkmark-circled"></i>
                                        </div>
                                        <a href="{{ route('wip_komponen.index') }}" class="small-box-footer">More info <i
                                                class="fas fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                            </div>
                    </div>
                @elseif(auth()->user()->level_id == 5)
                    <div class="row">
                        <!-- Card 1: Komponen Belum Diinput -->
                        <div class="col-lg-4 col-12">
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <h3>{{ $belumInputCount }}</h3>
                                    <p>Komponen Belum Diinput</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-alert-circled"></i>
                                </div>
                                <a href="{{ route('hasil-wip.index') }}" class="small-box-footer">Lihat Daftar <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>

                        <!-- Card 2: Total WIP Komponen -->
                        <div class="col-lg-4 col-12">
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>{{ $wipBelumInput->count() + \App\Models\HasilProduksi::pluck('produksi_id')->count() }}
                                    </h3>
                                    <p>Total WIP Komponen</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-cube"></i>
                                </div>
                                <a href="{{ route('hasil-wip.index') }}" class="small-box-footer">Detail <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>

                        <!-- Card 3: Total Hasil Produksi -->
                        <div class="col-lg-4 col-12">
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3>{{ $hasilProduksis->count() }}</h3>
                                    <p>Total Hasil Produksi</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-checkmark-circled"></i>
                                </div>
                                <a href="{{ route('hasil-produksi.index') }}" class="small-box-footer">Lihat Semua <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>


                @endif
                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
