<div class="modal fade" id="modal-edit{{$request->id}}" tabindex="-1" aria-labelledby="modalEditLabel{{$request->id}}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title" id="modalEditLabel{{$request->id}}">Edit Permintaan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('order_requests.update', $request->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="edit_tanggal">Tanggal</label>
                        <input type="date" class="form-control" name="tanggal" id="edit_tanggal" value="{{ $request->tanggal }}" required>
                    </div>

                    <div class="form-group">
                        <label for="edit_kode_product">Kode Produk</label>
                        <input type="text" class="form-control" name="kode_product" id="edit_kode_product" value="{{ $request->kode_product }}" required>
                    </div>

                    <div class="form-group">
                        <label for="edit_operator_id">Operator</label>
                        <select class="form-control" name="operator_id" id="edit_operator_id" required>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}" {{ $request->operator_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="edit_nama_komponen">Nama Komponen</label>
                        <input type="text" class="form-control" name="nama_komponen" id="edit_nama_komponen" value="{{ $request->nama_komponen }}" required>
                    </div>

                    <div class="form-group">
                        <label for="edit_jumlah">Jumlah</label>
                        <input type="number" class="form-control" name="jumlah" id="edit_jumlah" value="{{ $request->jumlah }}" required>
                    </div>

                    <div class="form-group">
                        <label for="edit_jenis_komponen">Jenis Komponen</label>
                        <select class="form-control" name="jenis_komponen" id="edit_jenis_komponen" required>
                            <option value="oem" {{ $request->jenis_komponen == 'oem' ? 'selected' : '' }}>OEM</option>
                            <option value="spin on" {{ $request->jenis_komponen == 'spin on' ? 'selected' : '' }}>Spin On</option>
                        </select>
                    </div>

                           <div class="form-group">
                            <label for="edit_status">Status</label>
                            <select class="form-control" name="status" id="edit_status" required>
                                <option value="pending" {{ $request->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="selesai" {{ $request->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                <option value="diproses" {{ $request->status == 'diproses' ? 'selected' : '' }}>Diproses</option>
                            </select>
                        </div>

                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
</div>
