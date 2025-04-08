<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>

    @include('includes.style');

</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{ asset('assets/img/logoft.png') }}" alt="logo" width="150">
        </div>

        <div class="mb-4 pb-4">
            @include('includes.navbar')
        </div>

        @include('includes.sidebar')

        <!-- Content Wrapper. Contains page content -->
        @yield('content')
        <!-- /.content-wrapper -->
        <div class="mb-4 pb-4">
            @include('includes.footer')

        </div>
        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    @include('includes.script')
    <script>
        $(document).ready(function () {
            $('.open-modal').click(function () {
                var button = $(this);

                $('#komponen_id').val(button.data('id'))
                $('#kode_komponen').val(button.data('kode'))
                $('#nama_komponen').val(button.data('nama'))
                $('#operator').val(button.data('operator'))
                $('#jumlah').val(button.data('jumlah'))
                $('#jenis_komponen').val(button.data('jenis'))
                $('#tanggal_deadline').val(button.data('dedline'))

                $('#createModal').modal('show');
            });
        });
    </script>

<script>
    $(document).ready(function () {
        $('.open-hasil').click(function () {
            let btn = $(this);
            $('#produksi_id').val(btn.data('id'));
            $('#kode_komponen').val(btn.data('kode'));
            $('#nama_komponen').val(btn.data('nama'));
            $('#operator').val(btn.data('operator'));
            $('#jenis_komponen').val(btn.data('jenis'));
            $('#lokasi').val(btn.data('lokasi'));
            $('#tanggal_in').val(formatTanggal(btn.data('dedline')));
            $('#qty_in').val(btn.data('jumlah'));
            $('#tanggal_out').val(formatTanggal(btn.data('tanggalout')));
            $('#qty_out').val(btn.data('jumlahout'));

            // Auto fill ke editable input (bisa diedit user)
            $('#target').val(btn.data('jumlah'));
            $('#hasil').val(btn.data('jumlahout'));

            $('#createModal').modal('show');
        });

        function formatTanggal(date) {
            if (!date) return '-';
            let d = new Date(date);
            return d.toLocaleDateString('id-ID');
        }
    });
</script>



</body>

</html>
