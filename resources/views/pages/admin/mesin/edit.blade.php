<div class="modal fade" id="modal-edit-{{ $mesin->id }}" tabindex="-1" aria-labelledby="modalEditLabel{{ $mesin->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="modalEditLabel{{ $mesin->id }}">Edit Mesin</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form id="editForm-{{ $mesin->id }}" action="{{ route('mesin.update', $mesin->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="kode_mesin">Kode Mesin</label>
                        <input type="text" class="form-control" name="kode_mesin" value="{{ $mesin->kode_mesin }}" required>
                    </div>

                    <div class="form-group">
                        <label for="nama_mesin">Nama Mesin</label>
                        <input type="text" class="form-control" name="nama_mesin" value="{{ $mesin->nama_mesin }}" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
