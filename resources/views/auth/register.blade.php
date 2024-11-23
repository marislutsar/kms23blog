@extends('partials.layout')
@section('title', __('Register'))
@section('content')
    <div class="w-2/3 mx-auto card bg-base-300">
        <div class="card-body">
            <h2 class="card-title">{{ __('Register') }}</h2>
            <form action="{{ route('register') }}" method="POST">
                @csrf
                <label class="w-full form-control">
                    <div class="label">
                        <span class="label-text">{{__('Name')}}</span>
                    </div>
                    <input name="name" type="text" placeholder="Name" value="{{ old('name') }}" class="w-full input input-bordered @error('name') input-error @enderror"  required autofocus autocomplete="name"/>
                    <div class="label">
                        @error('name')
                            <span class="label-text-alt text-error">{{ $message }}</span>
                        @enderror
                    </div>
                </label>
                <label class="w-full form-control">
                    <div class="label">
                        <span class="label-text">{{__('Email')}}</span>
                    </div>
                    <input name="email" type="email" placeholder="Email" value="{{ old('email') }}" class="w-full input input-bordered @error('email') input-error @enderror" required autocomplete="username"/>
                    <div class="label">
                        @error('email')
                            <span class="label-text-alt text-error">{{ $message }}</span>
                        @enderror
                    </div>
                </label>
                <label class="w-full form-control">
                    <div class="label">
                        <span class="label-text">{{__('Password')}}</span>
                    </div>
                    <input name="password" type="password" placeholder="Password" class="w-full input input-bordered @error('password') input-error @enderror" required autocomplete="new-password"/>
                    <div class="label">
                        @error('password')
                            <span class="label-text-alt text-error">{{ $message }}</span>
                        @enderror
                    </div>
                </label>
                <label class="w-full form-control">
                    <div class="label">
                        <span class="label-text">{{__('Confirm Password')}}</span>
                    </div>
                    <input name="password_confirmation" type="password" placeholder="Password Confirmation" class="w-full input input-bordered @error('password_confirmation') input-error @enderror" required autocomplete="new-password" />
                    <div class="label">
                        @error('password_confirmation')
                            <span class="label-text-alt text-error">{{ $message }}</span>
                        @enderror
                    </div>
                </label>
                <div class="text-right">
                    <a class="btn btn-link" href="{{ route('login') }}">{{ __('Already registered?') }}</a>
                    <input type="submit" class="btn btn-primary" value="{{ __('Register') }}">
                </div>
            </form>
        </div>
    </div>
@endsection
