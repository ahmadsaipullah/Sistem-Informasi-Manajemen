<div class="modal fade" id="modal-edit-{{ $request->id }}" tabindex="-1" aria-labelledby="modalEditLabel{{ $request->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title" id="modalEditLabel{{ $request->id }}">Edit Komponen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form id="editForm-{{ $request->id }}" action="{{ route('komponen.update', $request->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="kode_komponen">Kode Komponen</label>
                        <input type="text" class="form-control" name="kode_komponen" value="{{ $request->kode_komponen }}" required>
                    </div>

                    <div class="form-group">
                        <label for="nama_komponen">Nama Komponen</label>
                        <input type="text" class="form-control" name="nama_komponen" value="{{ $request->nama_komponen }}" required>
                    </div>

                    <div class="form-group">
                        <label for="stok">Stok</label>
                        <input type="number" class="form-control" name="stok" value="{{ $request->stok }}" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
