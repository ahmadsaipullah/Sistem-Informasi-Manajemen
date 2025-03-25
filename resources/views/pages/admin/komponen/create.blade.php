<!-- Create Modal -->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">Komponen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="createForm" action="{{ route('komponen.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="kode_komponen">Kode Komponen</label>
                        <input type="text" class="form-control" name="kode_komponen" required>
                    </div>
                    <div class="form-group">
                        <label for="nama_komponen">Nama Komponen</label>
                        <input type="text" class="form-control" name="nama_komponen" required>
                    </div>

                    <div class="form-group">
                        <label for="stok">Stok</label>
                        <input type="number" class="form-control" name="stok" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
