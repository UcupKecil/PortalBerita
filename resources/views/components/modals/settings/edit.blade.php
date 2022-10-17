<form id="editForm">
    <div class="modal" tabindex="-1" role="dialog" id="editModal">
      <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Ubah Pengaturan Web</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
                <label for="shortdes">Deskripsi Pendek</label>
                <input type="text" class="form-control" id="shortdes" name="shortdes">
            </div>

            <div class="form-group">
                <label for="logo">Logo</label>
                <input type="file" data-allowed-file-extensions="jpg png" data-max-file-size-preview="3M" class="form-control" id="logo" name="logo">
            </div>


            <div class="form-group">
                <label for="favicon">Favicon</label>
                <input type="file" data-allowed-file-extensions="ico" data-max-file-size-preview="3M" class="form-control" id="favicon" name="favicon">
            </div>


            <div class="form-group">
                <label for="photo">Foto</label>
                <input type="file" data-allowed-file-extensions="jpg png" data-max-file-size-preview="3M" class="form-control" id="foto" name="foto">
            </div>

            <div class="form-group">
              <label for="addressedit" class="col-form-label">Alamat<span class="text-danger">*</span></label>
              <textarea class="form-control" id="addressedit" name="addressedit">{{old('address')}}</textarea>
              @error('address')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </div>

            <div class="form-group">
                <label for="notelp">Nomor Telepon</label>
                <input type="text" class="form-control" id="notelp" name="notelp">
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email">
            </div>

            <div class="form-group">
                <label for="layananedit" class="col-form-label">Layanan<span class="text-danger">*</span></label>
                <textarea class="form-control" id="layananedit" name="layananedit">{{old('layanan')}}</textarea>
                @error('layanan')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="maps">Maps</label>
                <input type="text" class="form-control" id="maps" name="maps">
            </div>

          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" id="editSubmit">Save changes</button>
          </div>
        </div>
      </div>
    </div>
</form>
