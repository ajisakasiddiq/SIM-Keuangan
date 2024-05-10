@extends('layouts.app')
@section('title')
    Dashboard | Edit Profie
@endsection

@push('addon-style')
<style>
  .img-account-profile {
    height: 10rem;
}
.rounded-circle {
    border-radius: 50% !important;
}
.card {
    box-shadow: 0 0.15rem 1.75rem 0 rgb(33 40 50 / 15%);
}
.card .card-header {
    font-weight: 500;
}
.card-header:first-child {
    border-radius: 0.35rem 0.35rem 0 0;
}
.card-header {
    padding: 1rem 1.35rem;
    margin-bottom: 0;
    background-color: rgba(33, 40, 50, 0.03);
    border-bottom: 1px solid rgba(33, 40, 50, 0.125);
}
.form-control, .dataTable-input {
    display: block;
    width: 100%;
    padding: 0.875rem 1.125rem;
    font-size: 0.875rem;
    font-weight: 400;
    line-height: 1;
    color: #69707a;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #c5ccd6;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    border-radius: 0.35rem;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

.nav-borders .nav-link.active {
    color: #0061f2;
    border-bottom-color: #0061f2;
}
.nav-borders .nav-link {
    color: #69707a;
    border-bottom-width: 0.125rem;
    border-bottom-style: solid;
    border-bottom-color: transparent;
    padding-top: 0.5rem;
    padding-bottom: 0.5rem;
    padding-left: 0;
    padding-right: 0;
    margin-left: 1rem;
    margin-right: 1rem;
}
</style>
@endpush
@section('content')

<div class="container-xl px-4 mt-4">
  {{-- <div class="row">
      <div class="col-xl-4"> --}}
          <!-- Profile picture card-->
          <form method="POST" action="{{ route('profile.update',$user->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
          <div class="card mb-6 mb-xl-0">
              <div class="card-header">Profile Picture</div>
              <div class="card-body text-center">
                  <!-- Profile picture image-->
                  @if($user->foto == NULL)
                  <img class="img-account-profile rounded-circle mb-2" src="http://bootdey.com/img/Content/avatar/avatar1.png" alt="">
                  @else
                  <!-- Menampilkan gambar menggunakan URL dari storage -->
                  <img class="img-account-profile rounded-circle mb-2"
     src="{{ Storage::url($user->foto) }}"
     alt="My Image"
     style="max-width: 200px; max-height: 200px;">


                  @endif

                  <!-- Profile picture help block-->
                  <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
                  <!-- Profile picture upload button-->
                  <input name="foto" class="form-control" type="file">Upload new image</input>
              </div>
          </div>
      {{-- </div>
      <div class="col-xl-8"> --}}
          <!-- Account details card-->
          <div class="card mb-6">
              <div class="card-header">Account Details</div>
              <div class="card-body">
                @if (session('success'))
                <div class="alert alert-success">
                     {{ session('success') }}
                 </div>
            @endif
                      <!-- Form Group (username)-->
                      <div class="row gx-3 mb-3">
                      <div class="col-md-6">
                          <label class="small mb-1" for="nik">NIK </label>
                          <input class="form-control" name="nik" id="nik" type="text" placeholder="Enter your NIK" value="{{ $user->nik }}">
                      </div>
                      <div class="col-md-6">
                          <label class="small mb-1" for="name">Name </label>
                          <input class="form-control" name="name" id="name" type="text" placeholder="Enter your name" value="{{ $user->name }}">
                      </div>
                    </div>
                      <!-- Form Row-->
                      <div class="row gx-3 mb-3">
                          <!-- Form Group (first name)-->
                          <div class="col-md-6">
                              <label class="small mb-1" for="kelas">Kelas</label>
                              <input class="form-control" id="kelas" type="text" placeholder="Enter your class" name="kelas" value="{{ $user->kelas }}">
                          </div>
                          <!-- Form Group (last name)-->
                          <div class="col-md-6">
                            <label class="small mb-1" for="jk">Jenis Kelamin</label>
                            <select class="form-control" id="jk" name="jk">
                                <option value="L" {{ $user->jk == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="P" {{ $user->jk == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>
                        
                      </div>
                      <!-- Form Row        -->
                      <div class="row gx-3 mb-3">
                          <!-- Form Group (organization name)-->
                         
                          <div class="col-md-6">
                            <label class="small mb-1" for="no_hp">No Telepon</label>
                            <input class="form-control" id="no_hp" type="tel" name="no_hp" placeholder="Enter your phone number" value="{{ $user->no_hp }}">
                        </div>
                          <!-- Form Group (location)-->
                          <div class="col-md-6">
                              <label class="small mb-1" for="alamat">Alamat</label>
                              <input class="form-control" id="alamat" name="alamat" type="text" placeholder="Enter your location" value="{{ $user->alamat }}">
                          </div> 
                      </div>
                      <!-- Form Group (email address)-->
                      <div class="mb-3">
                          <label class="small mb-1" for="email">Email</label>
                          <input class="form-control" id="email" name="email" type="email" placeholder="Enter your email address" value="{{ $user->email }}">
                      </div>
                      <!-- Form Row-->
                      <div class="row gx-3 mb-3">
                          <!-- Form Group (phone number)-->
                          <div class="col-md-6">
                            <label class="small mb-1" for="tempat_lahir">Tempat Lahir</label>
                            <input class="form-control" id="tempat_lahir" name="tempat_lahir" type="text" placeholder="Enter your location" value="{{ $user->tempat_lahir }}">
                        </div>
                          <!-- Form Group (birthday)-->
                          <div class="col-md-6">
                              <label class="small mb-1" for="tgl_lahir">Tanggal Lahir</label>
                              <input class="form-control" id="tgl_lahir" name="tgl_lahir" type="date" name="birthday" placeholder="Enter your birthday" value="{{ $user->tgl_lahir }}">
                          </div>
                      </div>
                      <!-- Save changes button-->
                      <button class="btn btn-primary" type="submit">Save changes</button>
                    </form>
              </div>
          </div>
          <form method="POST" action="{{ route('password.update') }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
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
    </form>
      </div>
  </div>



</div>
@endsection
@push('addon-script')

@endpush