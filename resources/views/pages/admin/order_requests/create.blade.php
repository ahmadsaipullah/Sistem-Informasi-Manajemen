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
                        <label for="tanggal">Tanggal</label>
                        <input type="date" class="form-control" name="tanggal" required>
                    </div>
                    <div class="form-group">
                        <label for="kode_product">Kode Product</label>
                        <input type="text" class="form-control" name="kode_product" required>
                    </div>
                    <div class="form-group">
                        <label for="operator_id">Operator</label>
                        <!-- Operator -->
                        <select class="form-control" name="operator_id" required>
                            <option value="" disabled selected>-- Pilih Operator --</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>

                    </div>
                    <div class="form-group">
                        <label for="nama_komponen">Nama Komponen</label>
                        <input type="text" class="form-control" name="nama_komponen" required>
                    </div>
                    <div class="form-group">
                        <label for="jumlah">Jumlah</label>
                        <input type="number" class="form-control" name="jumlah" required>
                    </div>
                    <div class="form-group">
                        <label for="jenis_komponen">Jenis Komponen</label>
                        <!-- Jenis Komponen -->
                        <select class="form-control" name="jenis_komponen" required>
                            <option value="" disabled selected>-- Pilih Komponen --</option>
                            <option value="oem">OEM</option>
                            <option value="spin on">Spin On</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
