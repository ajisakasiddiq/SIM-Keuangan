<form method="POST" action="{{ route('password.update') }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
<div class="container-xl px-4 mt-4">
  <div class="row">
      <div class="col-xl-6 align-content-center">
          <!-- Account details card-->
          <div class="card mb-6">
              <div class="card-header">Ubah Password</div>
              <div class="card-body">
                 
                <div class="">
                    <label class="small mb-1" for="current_password">Password Lama </label>
                    <input class="form-control" name="current_password" id="current_password" type="text" placeholder="Enter your current password">
                </div>
                      <!-- Form Group (username)-->
                      <div class="row gx-3 mb-3">
                      <div class="col-md-6">
                          <label class="small mb-1" for="password">Passsword Baru </label>
                          <input class="form-control" name="password" id="password" type="text" placeholder="Enter your new password">
                      </div>
                      <div class="col-md-6">
                          <label class="small mb-1" for="password_confirmation">Konfirmasi Password Baru </label>
                          <input class="form-control" name="password_confirmation" id="password_confirmation" type="text" placeholder="Enter your new password">
                      </div>
                    </div>
                      <!-- Form Row-->
                      <!-- Save changes button-->
                      <button class="btn btn-primary" type="submit">Save changes</button>
                  
              </div>
          </div>
      </div>
  </div>
</div>
</form>