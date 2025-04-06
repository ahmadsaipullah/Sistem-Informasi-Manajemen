<!-- Create Modal -->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="createModalLabel">Tambah Mesin</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="createForm" action="{{ route('mesin.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="kode_mesin">Kode Mesin</label>
                        <input type="text" class="form-control" name="kode_mesin" id="kode_mesin" required>
                    </div>
                    <div class="form-group">
                        <label for="nama_mesin">Nama Mesin</label>
                        <input type="text" class="form-control" name="nama_mesin" id="nama_mesin" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
