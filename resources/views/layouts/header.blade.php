<header class="header clearfix">
    <div class="container">
        <div class="row">
            <div class="nav-left col-md-6 col-sm-7">
                <a class="logo" href="">临时外出请假系统</a>
            </div>
            <div class="nav-right col-md-4 col-md-offset-2 col-sm-5">
                <div class="right-top clearfix">
                    @auth
                        <span>                            
                            <form method="post" action="{{ route('logout') }}" id="logout" class="form-logout">
                                @csrf
                                欢迎您，{{ auth()-> user()->name }}。
                                <a href="javascript:;" onclick="document.getElementById('logout').submit()">退出</a>
                            </form>
                        </span>                    
                    @else
                        <span>
                            <a class="top" href="{{ route('login') }}">登陆</a>
                            &nbsp;&nbsp;|&nbsp;&nbsp;
                            <a href="{{ route('register') }}">注册</a>                        
                        </span>
                    @endauth
                </div>
                <div class="nav-bottom">
                    <form action="">
                        <input type="submit" class="submit-right" value>
                        <input type="text" class="search-right" placeholder="请输入搜索内容">                        
                    </form>
                </div>  
            </div>    
        </div>
    </div>
</header>
<div class="container">
    <div class="row">
        <div class="nav clearfix">
            <div class="indexBtn">
                <a href="{{ route('index') }}">
                    <img src="{{ asset('img/indexBtn.jpg') }}" alt="首页">
                </a>
            </div>
            <dl>
                <a href="{{ route('lswc.insert') }}">数据录入</a>
            </dl>
            <dl>
                <a href="">今日统计</a>
            </dl>
        </div>     
    </div>       
</div>