@extends('layouts.app')

@section('title', '-注册')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
    <style>

    </style>
@endsection

@section('content')
    <div class="container">
        @include('common.path', ['url' => 'register', 'name' => '注册'])
        <div class="row">
            <div class="col-md-8 condition-left">
                {{-- 登陆/注册文字颜色提示 --}}
                @include('common/top-tips', ['name' => 'register'])                
                <form method="POST" action="{{ route('register') }}">
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
                                <td>用户名</td>
                                <td><input name="name" type="text" value="{{ old('username') }}" placeholder="请输入用户名"></td>
                            </tr>
                            <tr>
                                <td>邮箱</td>
                                <td><input name="email" type="email" value="{{ old('email') }}" placeholder="请输入邮箱"></td>
                            </tr>
                            <tr>
                                <td>密码</td>
                                <td><input name="password" type="password" placeholder="请输入密码"></td>
                            </tr>
                            <tr>
                                <td>确认密码</td>
                                <td><input name="password_confirmation" type="password" placeholder="请输入重复密码"></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><button type="submit" class="btn btn-default btn-lg">注册</button></td>
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

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <x-jet-label for="name" value="{{ __('Name') }}" />
                <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-jet-label for="terms">
                        <div class="flex items-center">
                            <x-jet-checkbox name="terms" id="terms"/>

                            <div class="ml-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-jet-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-jet-button class="ml-4">
                    {{ __('Register') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout> --}}
