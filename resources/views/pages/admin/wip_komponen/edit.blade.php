<!-- Edit Modal -->
<div class="modal fade" id="editModal-{{$request->id}}" tabindex="-1" aria-labelledby="editModalLabel-{{$request->id}}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="editModalLabel-{{$request->id}}">Edit Permintaan WIP</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form action="{{ route('wip_komponen.update', $request->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="komponen_id" value="{{ $request->komponen_id }}">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Kode Komponen</label>
                                <input type="text" class="form-control" value="{{ $request->orderRequest->komponen->kode_komponen }}" readonly>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nama Komponen</label>
                                <input type="text" class="form-control" value="{{ $request->orderRequest->komponen->nama_komponen }}" readonly>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Operator</label>
                                <input type="text" class="form-control" value="{{ $request->orderRequest->operator->name }}" readonly>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Jumlah</label>
                                <input type="text" class="form-control" value="{{ $request->jumlah }}" readonly>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Jenis Komponen</label>
                                <input type="text" class="form-control" value="{{ $request->jenis_komponen }}" readonly>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tanggal Deadline</label>
                                <input type="date" class="form-control" value="{{ $request->tanggal_deadline }}" readonly>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="form-group">
                        <label for="mesin_id">Pilih Mesin</label>
                        <select name="mesin_id" class="form-control" required>
                            <option value="">-- Pilih Mesin --</option>
                            @foreach($mesins as $mesin)
                                <option value="{{ $mesin->id }}" {{ $mesin->id == $request->mesin_id ? 'selected' : '' }}>{{ $mesin->nama_mesin }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="lokasi">Lokasi</label>
                        <select name="lokasi" class="form-control" required>
                            <option value="">-- Pilih Lokasi --</option>
                            <option value="A1" {{ $request->lokasi == 'A1' ? 'selected' : '' }}>A1</option>
                            <option value="A2" {{ $request->lokasi == 'A2' ? 'selected' : '' }}>A2</option>
                            <option value="A3" {{ $request->lokasi == 'A3' ? 'selected' : '' }}>A3</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="tanggal_out">Tanggal Keluar</label>
                        <input type="date" name="tanggal_out" class="form-control" value="{{ $request->tanggal_out }}" required>
                    </div>

                    <div class="form-group">
                        <label for="jumlah_out">Jumlah Keluar</label>
                        <input type="number" name="jumlah_out" class="form-control" value="{{ $request->jumlah_out }}" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
</div>
