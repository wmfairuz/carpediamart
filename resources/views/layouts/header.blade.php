<div class="container">
    <div id="logo">
        <a href="{{ route('landing') }}">
            <img src="{{ asset('img/logo2.png') }}" width="50" height="35" alt="" class="logo_normal">
            <img src="{{ asset('img/logo2.png') }}" width="50" height="35" alt="" class="logo_sticky">
        </a>
    </div>
    <ul id="top_menu">
        @guest
                <li><a href="{{ route('login') }}" class="login">Login</a></li>
        @endguest
{{--                    <li><a href="wishlist.html" class="wishlist_bt_top" title="Your wishlist">Your wishlist</a></li>--}}
    </ul>
    <!-- /top_menu -->
    <a href="#0" class="open_close">
        <i class="icon_menu"></i><span>Menu</span>
    </a>
    <nav class="main-menu">
        <div id="header_menu">
            <a href="#0" class="open_close">
                <i class="icon_close"></i><span>Menu</span>
            </a>
            <a href="{{ route('landing') }}"><img src="{{ asset('img/logo2.png') }}" width="140" height="35" alt=""></a>
        </div>
        <ul>
            <li>
                <a href="{{ route('landing') }}">Home</a>
            </li>
            <li>
                <a href="{{ route('orders.create') }}"><i class="icon_cart"></i> Shop Now</a>
            </li>
            <li>
                <a href="https://thecarpedia.com">The Carpedia e-Hailing</a>
            </li>
            <li>
                <a target="_blank" href="https://api.whatsapp.com/send?phone=60195778108&text=Carpedia Mart"><i class="icon_phone"></i> Contact Us +6019-577 8108</a>
            </li>
            @guest
                <li>
                    <a href="{{ route('login') }}">Login</a>
                </li>
            @else
                <li>
                    <a>
                        Hi, {{ Auth::user()->name }} <span class="arrow_carrot-down"></span>
                    </a>

                    <ul>
{{--                        <li><a href="{{ route('profile') }}">Profile</a></li>--}}
                        <li><a href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </li>
            @endguest
        </ul>
    </nav>
</div>