<!-- Modal Create -->
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <form action="{{ route('hasil-produksi.store') }}" method="POST">
        @csrf
        <input type="hidden" name="produksi_id" id="produksi_id">

        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Input Hasil</h5>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>

          <div class="modal-body">
            <div class="row">
              <!-- Field readonly -->
              <div class="col-md-4">
                <label>Kode Produk</label>
                <input type="text" class="form-control" id="kode_komponen" readonly>
              </div>
              <div class="col-md-4">
                <label>Nama Komponen</label>
                <input type="text" class="form-control" id="nama_komponen" readonly>
              </div>
              <div class="col-md-4">
                <label>Operator</label>
                <input type="text" class="form-control" id="operator" readonly>
              </div>

              <div class="col-md-4">
                <label>Jenis Komponen</label>
                <input type="text" class="form-control" id="jenis_komponen" readonly>
              </div>
              <div class="col-md-4">
                <label>Lokasi</label>
                <input type="text" class="form-control" id="lokasi" readonly>
              </div>
              <div class="col-md-4">
                <label>Tanggal Masuk (In)</label>
                <input type="text" class="form-control" id="tanggal_in" readonly>
              </div>

              <div class="col-md-4">
                <label>Qty Masuk (In)</label>
                <input type="number" class="form-control" id="qty_in" readonly>
              </div>
              <div class="col-md-4">
                <label>Tanggal Keluar (Out)</label>
                <input type="text" class="form-control" id="tanggal_out" readonly>
              </div>
              <div class="col-md-4">
                <label>Qty Keluar (Out)</label>
                <input type="number" class="form-control" id="qty_out" readonly>
              </div>

              <!-- Field editable -->
              <div class="col-md-4 mt-3">
                <label>Jam</label>
                <select name="jam" class="form-control" required>
                  <option value="">Pilih Jam</option>
                  <option value="Jam 1">Jam 1</option>
                  <option value="Jam 2">Jam 2</option>
                  <option value="Jam 3">Jam 3</option>
                  <!-- tambahkan sesuai kebutuhan -->
                </select>
              </div>

              <div class="col-md-4 mt-3">
                <label>Shift</label>
                <select name="shift" class="form-control" required>
                  <option value="">Pilih Shift</option>
                  <option value="Shift 1">Shift 1</option>
                  <option value="Shift 2">Shift 2</option>
                  <option value="Shift 3">Shift 3</option>
                </select>
              </div>

              <div class="col-md-4 mt-3">
                <label>Target</label>
                <input type="number" name="target" id="target" class="form-control" required>
              </div>

              <div class="col-md-6 mt-3">
                <label>Hasil</label>
                <input type="number" name="hasil" id="hasil" class="form-control" required>
              </div>

              <div class="col-md-6 mt-3">
                <label>Hambatan</label>
                <select name="hambatan" class="form-control" required>
                  <option value="">Pilih Hambatan</option>
                  <option value="Tidak Ada">Tidak Ada</option>
                  <option value="Mesin Rusak">Mesin Rusak</option>
                  <option value="Menunggu Material">Menunggu Material</option>
                  <option value="Lainnya">Lainnya</option>
                </select>
              </div>
            </div>
          </div>

          <div class="modal-footer">
            <button type="submit" class="btn btn-success">Simpan</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          </div>
        </div>
      </form>
    </div>
  </div>
