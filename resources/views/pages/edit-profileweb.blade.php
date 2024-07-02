@extends('layouts.app')
@section('title')
    Dashboard | Edit Profie Web
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
    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="removeSuccessMessage()">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<script>
    function removeSuccessMessage() {
        var successMessage = document.querySelector('.alert-success');
        if (successMessage) {
            successMessage.style.display = 'none';
        }
    }
</script>

  {{-- <div class="row"> --}}
      {{-- <div class="col-xl-4"> --}}
          <!-- Profile picture card-->
          @foreach ($profile as $user)
              
        
          <form method="POST" action="{{ route('Profile-Web.update',$user->id) }}" enctype="multipart/form-data">
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
              <div class="card-header">Profile</div>
              <div class="card-body">
       
                      <!-- Form Group (username)-->
                      <div class=" gx-3 mb-3">
                      <div>
                          <label class="small mb-1" for="name">Nama </label>
                          <input class="form-control" name="name" id="name" type="text" placeholder="Enter your NIK" value="{{ $user->name }}">
                      </div>
                      <div>
                          <label class="small mb-1" for="alamat">Alamat </label>
                          <input class="form-control" name="alamat" id="alamat" type="textarea" placeholder="Enter your address" value="{{ $user->alamat }}"></input>
                      </div>
                    </div>
                   
                      <!-- Save changes button-->
                      <button class="btn btn-primary" type="submit">Save changes</button>
                    </form>
              </div>
            </div>
        {{-- </div> --}}
  {{-- </div> --}}



</div>
@endforeach
@endsection
@push('addon-script')

@endpush