@extends('layouts.yellow.master')

@section('title', 'Authentication')

@section('content')

<div class="block mt-3">
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3 d-flex">
                <div class="card flex-grow-1 mb-md-0">
                    <div class="card-body">
                        <h3 class="card-title">Login</h3>
                        @php($login = old('login') && (cache()->get('auth:'.old('login')) || session()->has('success')))
                        <x-form :action="route('user.login')" :method="$login ? 'post' : 'get'">
                            <div class="form-group">
                                <label>Phone Number</label> <span class="text-danger">*</span>
                                <x-input type="text" name="login" placeholder="Phone Number" />
                                <x-error field="login" />
                            </div>
                            @if($login)
                            <div class="form-group">
                                <label>Enter Access Token</label> <span class="text-danger">*</span>
                                <x-input type="text" name="password" placeholder="Access Token" />
                                <x-error field="password" />
                            </div>
                            <input type="hidden" id="remember" name="remember" value="true" />
                            @endif
                            <button type="submit" class="btn btn-primary mt-2 mr-1">Login</button>
                            @if($login)
                                <button formaction="{{ route('user.resend-otp') }}" class="btn btn-primary mt-2 ml-1">Resend Token</button>
                            @endif
                        </x-form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
