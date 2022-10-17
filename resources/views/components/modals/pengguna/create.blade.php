
<form id="createForm">
    <div class="modal" tabindex="-1" role="dialog" id="createModal">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Tambah Pengguna</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              <div class="form-group">
                  <label for="createName">Pengguna</label>
                  <input type="text" class="form-control" id="createName" name="name">
              </div>
              <div class="form-group">
                  <label for="createEmail">Email</label>
                  <input type="email" class="form-control" id="createEmail" name="email">
              </div>
              <div class="form-group">
                <label for="createRoles">Role</label>
                <select name="role" id="createRole" class="form-control">                
                    <option value="" selected disabled>Pilih Role</option>
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                    @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="createPassword">Password</label>
                <input type="password" class="form-control" id="createPassword" name="password">
            </div>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" id="createSubmit">Save changes</button>
          </div>
        </div>
      </div>
    </div>
</form>
