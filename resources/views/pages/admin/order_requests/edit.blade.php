<!-- Edit Modal -->
<div class="modal fade" id="modal-edit-{{$request->id}}" tabindex="-1" aria-labelledby="modalEditLabel{{$request->id}}" aria-hidden="true">
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
                    <!-- Tanggal Dedline -->
                    <div class="form-group">
                        <label for="edit_tanggal_dedline_{{$request->id}}">Tanggal Dedline</label>
                        <input type="date" class="form-control" name="tanggal_dedline" id="edit_tanggal_dedline_{{$request->id}}" value="{{ $request->tanggal_dedline }}" required>
                    </div>

                    <!-- Kode Komponen -->
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

                    <!-- Nama Komponen (readonly) -->
                    <div class="form-group">
                        <label for="edit_nama_komponen_{{$request->id}}">Nama Komponen</label>
                        <input type="text" class="form-control nama-komponen" id="edit_nama_komponen_{{$request->id}}" name="nama_komponen" value="" readonly>
                    </div>
@if(auth()->user()->level_id == 1)
                    <!-- Operator -->
                    <div class="form-group">
                        <label for="edit_operator_id_{{$request->id}}">Operator</label>
                        <select class="form-control" name="operator_id" id="edit_operator_id_{{$request->id}}" required>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}" {{ $request->operator_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @else
                    <input type="hidden" name="operator_id" value="{{ auth()->user()->id }}">
                    @endif
                    <!-- Jumlah -->
                    <div class="form-group">
                        <label for="edit_jumlah_{{$request->id}}">Jumlah</label>
                        <input type="number" class="form-control" name="jumlah" id="edit_jumlah_{{$request->id}}" value="{{ $request->jumlah }}" required>
                    </div>

                    <!-- Jenis Komponen -->
                    <div class="form-group">
                        <label for="edit_jenis_komponen_{{$request->id}}">Jenis Komponen</label>
                        <select class="form-control" name="jenis_komponen" id="edit_jenis_komponen_{{$request->id}}" required>
                            <option value="OEM" {{ $request->jenis_komponen == 'OEM' ? 'selected' : '' }}>OEM</option>
                            <option value="Spin On" {{ $request->jenis_komponen == 'Spin On' ? 'selected' : '' }}>Spin On</option>
                        </select>
                    </div>

                    <!-- Status -->
                    {{-- <div class="form-group">
                        <label for="edit_status_{{$request->id}}">Status</label>
                        <select class="form-control" name="status" id="edit_status_{{$request->id}}" required>
                            <option value="pending" {{ $request->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="selesai" {{ $request->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                            <option value="diproses" {{ $request->status == 'diproses' ? 'selected' : '' }}>Diproses</option>
                        </select>
                    </div> --}}

                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Script untuk Mengisi Nama Komponen Otomatis -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Ketika modal dibuka, pastikan input nama_komponen otomatis terisi
        document.querySelectorAll('.modal.fade').forEach(modal => {
            modal.addEventListener('shown.bs.modal', function() {
                let select = modal.querySelector('.kode-komponen');
                let targetInput = modal.querySelector('.nama-komponen');
                let selectedOption = select.options[select.selectedIndex];

                if (selectedOption) {
                    targetInput.value = selectedOption.getAttribute('data-nama') || '';
                }
            });
        });

        // Ketika kode komponen berubah, update nama komponen
        document.querySelectorAll('.kode-komponen').forEach(select => {
            select.addEventListener('change', function() {
                let selectedOption = this.options[this.selectedIndex];
                let targetInput = document.getElementById(this.getAttribute('data-target'));
                targetInput.value = selectedOption.getAttribute('data-nama');
            });
        });
    });
</script>
