<!-- Edit Modal -->
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
                        <label for="edit_kode_komponen_id_{{$request->id}}">Kode Komponen</label>
                        <select class="form-control kode-komponen" name="kode_komponen_id" id="edit_kode_komponen_id_{{$request->id}}" data-target="edit_nama_komponen_{{$request->id}}" required>
                            <option value="" disabled>-- Pilih Kode Komponen --</option>
                            @foreach ($komponens as $komponen)
                                <option value="{{ $komponen->id }}" data-nama="{{ $komponen->nama_komponen }}"
                                    {{ $request->kode_komponen_id == $komponen->id ? 'selected' : '' }}>
                                    {{ $komponen->kode_komponen }} - {{ $komponen->nama_komponen }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="edit_nama_komponen_{{$request->id}}">Nama Komponen</label>
                        <input type="text" class="form-control nama-komponen" id="edit_nama_komponen_{{$request->id}}" name="nama_komponen" value="{{ $request->nama_komponen }}" readonly>
                    </div>

                    <div class="form-group">
                        <label for="edit_operator_id_{{$request->id}}">Operator</label>
                        <select class="form-control" name="operator_id" id="edit_operator_id_{{$request->id}}" required>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}" {{ $request->operator_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="edit_jumlah_{{$request->id}}">Jumlah</label>
                        <input type="number" class="form-control" name="jumlah" id="edit_jumlah_{{$request->id}}" value="{{ $request->jumlah }}" required>
                    </div>

                    <div class="form-group">
                        <label for="edit_jenis_komponen_{{$request->id}}">Jenis Komponen</label>
                        <select class="form-control" name="jenis_komponen" id="edit_jenis_komponen_{{$request->id}}" required>
                            <option value="oem" {{ $request->jenis_komponen == 'oem' ? 'selected' : '' }}>OEM</option>
                            <option value="spin on" {{ $request->jenis_komponen == 'spin on' ? 'selected' : '' }}>Spin On</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="edit_status_{{$request->id}}">Status</label>
                        <select class="form-control" name="status" id="edit_status_{{$request->id}}" required>
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

<!-- Script untuk Mengisi Nama Komponen Otomatis -->
<script>
    document.querySelectorAll('.kode-komponen').forEach(select => {
        select.addEventListener('change', function () {
            let selectedOption = this.options[this.selectedIndex];
            let targetInput = document.getElementById(this.getAttribute('data-target'));
            targetInput.value = selectedOption.getAttribute('data-nama');
        });
    });
</script>
