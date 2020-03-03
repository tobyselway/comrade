@extends('layouts.staticapp')

@section('title')
    Login | {{ config('app.branding', '') }} {{ config('app.name', 'Comrade') }}
@endsection

@section('content')
    <div class="w-full h-full flex items-center justify-center">
        <div class="w-1/2 flex flex-col items-center justify-center">

            <div class="text-4xl font-bold tracking-tight mb-1">
                <span class="font-normal">{{ config('app.branding', '') }}</span>
                <span>{{ config('app.name', 'Comrade') }}</span>
            </div>

            <div class="text-6xl font-thin mb-6">Welcome</div>

            <div class="text-lg text-gray-600">A simple social network for small groups and organizations.</div>

        </div>

        <div class="w-1/2 flex flex-col items-center justify-center">
            <div class="bg-white rounded-lg shadow-lg p-6 w-1/2">
                <h1 class="text-3xl font-bold tracking-tight mb-10">Login</h1>
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-6">
                        <input class="w-full border-b-2 border-gray-400 focus:border-blue-400 text-xl focus:outline-none mb-1" type="email" name="email" placeholder="Email" autocomplete="email" autofocus>

                        @error('email')
                        <span class="text-red-500 text-sm font-bold">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <input class="w-full border-b-2 border-gray-400 focus:border-blue-400 text-xl focus:outline-none mb-1" type="password" name="password" placeholder="Password" autocomplete="current-password">

                        @error('password')
                        <span class="text-red-500 text-sm font-bold">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex items-center mb-8">
                        <label class="block text-gray-600">
                            <input class="mr-2 leading-tight " type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <span class="text-md">
                            Remember me
                        </span>
                        </label>
                    </div>

                    <button class="w-full rounded-full bg-blue-500 hover:bg-blue-600 active:bg-blue-700 p-2 text-xl font-bold tracking-wide text-gray-200 focus:outline-none" type="submit">Login</button>

                    <div class="w-full text-center mt-5 flex flex-col items-center">

                        @if (Route::has('password.request'))
                            <a class="text-sm text-gray-600 hover:text-gray-800" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif

                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
