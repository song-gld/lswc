@extends('layouts.app')

@section('title', '-登陆')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
    <style>

    </style>
@endsection

@section('content')
    <div class="container">
        @include('common.path', ['url' => 'login', 'name' => '登陆'])        
        <div class="row">
            <div class="col-md-8 condition-left">
                {{-- 登陆/注册文字颜色提示 --}}
                @include('common/top-tips', ['name' => 'login'])                
                <form method="POST" action="{{ route('login') }}">
                    <table class="table-register text-center">
                        @csrf                        
                        {{-- 错误验证消息提示 --}}
                        <p class="text-center">
                            @foreach ($errors->all() as $error)
                                {{ $error }} <br>
                            @endforeach                        
                        </p>
                        <tbody> 
                            <tr>                                                       
                                <td>邮箱</td>
                                <td><input name="email" type="email" value="{{ old('email') }}" placeholder="请输入邮箱"></td>
                            </tr>
                            <tr>
                                <td>密码</td>
                                <td><input name="password" type="password" placeholder="请输入密码"></td>
                            </tr>                            
                            <tr>
                                <td></td>
                                <td><button type="submit" class="btn btn-default btn-lg">登陆</button></td>
                            </tr>
                        </tbody>
                    </table>
                </form>               
            </div>
            <div class="col-md-4 condition-right">222</div>
        </div>
    </div>
    
    {{-- {{auth()->user()->name}} --}}
@endsection



{{-- <x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-jet-checkbox id="remember_me" name="remember" />
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-jet-button class="ml-4">
                    {{ __('Log in') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout> --}}