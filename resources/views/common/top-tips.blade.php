<div class="col-md-6 left-line">
    <div class="line {{ $name == 'register'? 'line-yellow': 'line-dark' }}"></div>
    <a href="{{ route('register') }}"><p class="text-center {{ $name == 'register'? 'text-yellow': 'text-dark' }}">注册</p></a>
</div>
<div class="col-md-6 right-line">
    <div class="line {{ $name == 'login'? 'line-yellow': 'line-dark' }}"></div>
    <a href="{{ route('login') }}"><p class="text-center {{ $name == 'login'? 'text-yellow': 'text-dark' }}">登陆</p></a>
</div>