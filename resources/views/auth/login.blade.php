@extends('layouts.auth')

@section('title')
    Sign In
@endsection

@section('content')
<div class="container-fluid" style="background-image: url('/img/image.png'); background-size: cover; height: 100vh;">
    <div class="row justify-content-center align-items-center" style="height: 100%;">
        <div class="col-sm-9 col-md-7 col-lg-5">
            <div class="card border-0 shadow rounded-3 my-5">
              <div class="card-body p-4 p-sm-5">
                {{-- <h5 class="card-title text-center mb-4 fw-light fs-5">Sign In</h5> --}}
                <h2 class="text-center mb-2">SIM-K</h2>
                <h2 class="text-center mb-4">MTs. Zainul Hasan Balung</h2>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="rememberPasswordCheck">
                        <label class="form-check-label" for="rememberPasswordCheck">Remember password</label>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-login text-uppercase fw-bold">Sign in</button>
                    </div>
                </form>
            </div>
            
            </div>
        </div>
    </div>
</div>
@endsection
