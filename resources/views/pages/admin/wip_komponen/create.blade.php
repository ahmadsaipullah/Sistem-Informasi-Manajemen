<!-- Create Modal -->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="createModalLabel">Tambah Permintaan WIP</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="createForm" action="{{ route('wip_komponen.store') }}" method="POST">
                    @csrf

                    <input type="hidden" name="komponen_id" id="komponen_id">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="kode_komponen">Kode Komponen</label>
                                <input type="text" class="form-control" id="kode_komponen" readonly>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama_komponen">Nama Komponen</label>
                                <input type="text" class="form-control" id="nama_komponen" readonly>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="operator">Operator</label>
                                <input type="text" class="form-control" id="operator" readonly>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="jumlah">Jumlah</label>
                                <input type="text" class="form-control" id="jumlah" readonly>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="jenis_komponen">Jenis Komponen</label>
                                <input type="text" class="form-control" id="jenis_komponen" readonly>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tanggal_deadline">Tanggal Dedline</label>
                                <input type="date" class="form-control" id="tanggal_deadline" readonly>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="form-group">
                        <label for="mesin_id">Pilih Mesin</label>
                        <select name="mesin_id" id="mesin_id" class="form-control" required>
                            <option value="">-- Pilih Mesin --</option>
                            @foreach($mesins as $mesin)
                                <option value="{{ $mesin->id }}">{{ $mesin->nama_mesin }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="lokasi">Lokasi</label>
                        <select name="lokasi" id="lokasi" class="form-control" required>
                            <option value="">-- Pilih Lokasi --</option>
                            <option value="A1">A1</option>
                            <option value="A2">A2</option>
                            <option value="A3">A3</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="tanggal_out">Tanggal Keluar</label>
                        <input type="date" name="tanggal_out" id="tanggal_out" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="jumlah_out">Jumlah Keluar</label>
                        <input type="number" name="jumlah_out" id="jumlah_out" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

