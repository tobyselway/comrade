@extends('layouts.staticapp')

@section('title')
    Register | {{ config('app.branding', '') }} {{ config('app.name', 'Comrade') }}
@endsection

@section('content')
    <div class="w-full h-full flex items-center justify-center">
        <div class="w-1/2 flex flex-col items-center justify-center">

            <div class="text-4xl font-bold tracking-tight mb-1">
                <span class="font-normal">{{ config('app.branding', '') }}</span>
                <span>{{ config('app.name', 'Comrade') }}</span>
            </div>

            <div class="text-6xl font-thin mb-6">Create Account</div>

            <div class="text-lg text-gray-600">Fill in your details to the right to create an account.</div>

        </div>

        <div class="w-1/2 flex flex-col items-center justify-center">
            <div class="bg-white rounded-lg shadow-lg p-6 w-1/2">
                <h1 class="text-3xl font-bold tracking-tight mb-10">Register</h1>
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="mb-6">
                        <input class="w-full border-b-2 border-gray-400 focus:border-blue-400 @error('name') border-red-400 focus:border-red-500 @enderror text-xl focus:outline-none mb-1" type="text" value="{{ old('name') }}" name="name" placeholder="Full Name" autocomplete="name" autofocus>

                        @error('name')
                        <span class="text-red-500 text-sm font-bold">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <input class="w-full border-b-2 border-gray-400 focus:border-blue-400 @error('email') border-red-400 focus:border-red-500 @enderror text-xl focus:outline-none mb-1" type="email" value="{{ old('email') }}" name="email" placeholder="Email" autocomplete="email">

                        @error('email')
                        <span class="text-red-500 text-sm font-bold">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <input class="w-full border-b-2 border-gray-400 focus:border-blue-400 @error('password') border-red-400 focus:border-red-500 @enderror text-xl focus:outline-none mb-1" type="password" name="password" placeholder="Password" autocomplete="new-password">

                        @error('password')
                        <span class="text-red-500 text-sm font-bold">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-10">
                        <input class="w-full border-b-2 border-gray-400 focus:border-blue-400 @error('password') border-red-400 focus:border-red-500 @enderror text-xl focus:outline-none mb-1" type="password" name="password_confirmation" placeholder="Confirm Password" autocomplete="new-password">
                    </div>

                    <button class="w-full rounded-full bg-blue-500 hover:bg-blue-600 active:bg-blue-700 p-2 text-xl font-bold tracking-wide text-gray-200 focus:outline-none" type="submit">Register</button>

                </form>
            </div>
        </div>
    </div>
@endsection
