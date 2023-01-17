@extends('userPanel.index')

@section('content')
    <div class="row justify-content-center">
        <div class="col-6">
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="mb-3 mb-3 col-md-6 col-12">
                                <label for="first_name" class="form-label">First Name</label>
                                <input type="text" name="first_name" class="form-control" id="first_name"
                                    autocomplete="off" required>
                            </div>
                            <div class="mb-3 mb-3 col-md-6 col-12">
                                <label for="last_name" class="form-label">Last Name</label>
                                <input type="text" name="last_name" class="form-control" id="last_name"
                                    autocomplete="off" required>
                            </div>
                            <div class="mb-3 mb-3 col-md-6 col-12">
                                <label for="personal_number" class="form-label">Personal Number</label>
                                <input type="text" name="personal_number" class="form-control" id="personal_number"
                                    autocomplete="off" maxlength="11" required>
                            </div>
                            <hr/>
                            <div class="mb-3 mb-3 col-md-6 col-12">
                                <label for="username" class="form-label">User name</label>
                                <input type="text" name="username" class="form-control" id="username"
                                    autocomplete="off" required>
                            </div>
                            <div class="mb-3 mb-3 col-md-6 col-12">
                                <label for="email" class="form-label">Email address</label>
                                <input type="email" name="email" class="form-control" id="email" autocomplete="off" required>
                            </div>
                            <div class="mb-3 mb-3 col-md-6 col-12">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" id="password"
                                    autocomplete="off" required>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-muted">
                        <button type="submit" class="btn btn-primary">Register</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection