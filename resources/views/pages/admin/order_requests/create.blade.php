<!-- Create Modal -->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title" id="createModalLabel">Tambah Order Request</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="createForm" action="{{ route('order_requests.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="kode_komponen_id">Kode Komponen</label>
                        <select class="form-control" name="kode_komponen_id" id="kode_komponen_id" required>
                            <option value="" disabled selected>-- Pilih Kode Komponen --</option>
                            @foreach ($komponens as $komponen)
                                <option value="{{ $komponen->id }}" data-nama="{{ $komponen->nama_komponen }}">
                                    {{ $komponen->kode_komponen }} - {{ $komponen->nama_komponen }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="tanggal_dedline">Tanggal Dedline</label>
                        <input type="date" class="form-control" name="tanggal_dedline" id="tanggal_dedline" required>
                    </div>


                    <div class="form-group">
                        <label for="nama_komponen">Nama Komponen</label>
                        <input type="text" class="form-control" id="nama_komponen" name="nama_komponen" readonly>
                    </div>
@if(auth()->user()->level_id == 1)
                    <div class="form-group">
                        <label for="operator_id">Operator</label>
                        <select class="form-control" name="operator_id" required>
                            <option value="" disabled selected>-- Pilih Operator --</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
@else
<input type="hidden" name="operator_id" value="{{ auth()->user()->id }}">
@endif
                    <div class="form-group">
                        <label for="jumlah">Jumlah</label>
                        <input type="number" class="form-control" name="jumlah" required>
                    </div>

                    <div class="form-group">
                        <label for="jenis_komponen">Jenis Komponen</label>
                        <select class="form-control" name="jenis_komponen" required>
                            <option value="" disabled selected>-- Pilih Komponen --</option>
                            <option value="OEM">OEM</option>
                            <option value="Spin On">Spin On</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Script untuk Mengisi Nama Komponen Otomatis -->
<script>
    document.getElementById('kode_komponen_id').addEventListener('change', function () {
        let selectedOption = this.options[this.selectedIndex];
        let namaKomponen = selectedOption.getAttribute('data-nama');
        document.getElementById('nama_komponen').value = namaKomponen;
    });
</script>
