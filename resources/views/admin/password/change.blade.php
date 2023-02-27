@extends('admin.layout.main')

@section('content')
    <div class="row">
        @if (session('correctPassword'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session('correctPassword') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @if (session('incorrectPassword'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>{{ session('incorrectPassword') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @endif
    </div>
    <div class="row" style="margin-top: 70px">
        <div class="w-75 m-auto">
            <div class="rounded shadow">
                <div class="mt-3 ms-3">
                    <button class="btn" onclick="history.back()"><i class="fa-solid fa-arrow-left text-muted"
                            style="font-size: 30px"></i></button>
                </div>
                <div class="row py-5">
                    <div class="col-3 pt-2 ps-5">
                        <h6 class="fw-bold text-uppercase " style="font-style: italic;color: #050A30;">Change password
                        </h6>
                    </div>
                    <div class="col-8">
                        <form action="{{ route('admin#passwordChange') }}" method="post">
                            @csrf
                            <div class="form-floating mb-4">
                                <input type="password" name="oldPassword"
                                    class="form-control @error('oldPassword') is-invalid @enderror" id="floatingInput"
                                    placeholder="Enter Old Password...">
                                <label for="floatingInput">Old Password</label>
                                @error('oldPassword')
                                    <div class="invalid-message">
                                        <small class="text-danger">
                                            {{ $message }}
                                        </small>
                                    </div>
                                @enderror
                            </div>
                            <div class="form-floating mb-4">
                                <input type="password" name="newPassword"
                                    class="form-control @error('newPassword') is-invalid @enderror" id="floatingPassword"
                                    placeholder="Enter New Password...">
                                <label for="floatingPassword">New Password</label>
                                @error('newPassword')
                                    <div class="invalid-message">
                                        <small class="text-danger">
                                            {{ $message }}
                                        </small>
                                    </div>
                                @enderror
                            </div>
                            <div class="form-floating ">
                                <input type="password" name="confirmPassword"
                                    class="form-control @error('confirmPassword') is-invalid @enderror"
                                    id="floatingPassword" placeholder="Retype New Password...">
                                <label for="floatingPassword">Retype New Password</label>
                                @error('confirmPassword')
                                    <div class="invalid-message">
                                        <small class="text-danger">
                                            {{ $message }}
                                        </small>
                                    </div>
                                @enderror
                            </div>
                            <div class="text-end mt-5">
                                <button type="submit" class="btn btn-dark" style="font-size: 20px"><i
                                        class="fa-solid fa-key   me-2"></i><span>Change Password</span></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
