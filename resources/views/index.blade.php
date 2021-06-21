@extends('adminlte::master')

@section('title', 'Daftar Pegawai')

@section('plugins.assets', true)

@section('adminlte_css')
<style>
    .landing {
        width: 100%;
        height: 100%;
        overflow: hidden;
        font: 16px Avenir, Verdana, sans-serif;
    }

    .dn-search-wrapper {
        display: block;
        padding: 2em;
        box-sizing: border-box;
        background: #ddd none;
        background-size: cover;
        width: 100%;
        height: 600px;
        height: 100vh;
        font: 16px Avenir, Verdana, sans-serif;
        text-align: center;
        box-sizing: border-box;
        white-space: nowrap;
        overflow: hidden;
        /* position: fixed; */
        z-index: 2;
    }

    .dn-search-wrapper:before {
        white-space: nowrap;
        overflow: hidden;
        display: inline-block;
        width: 0;
        height: 100%;
        vertical-align: middle;
        content: "";
    }

    .dn-search-wrapper__bg {
        background: grey url(https://picsum.photos/640/480);
        background-size: cover;
        background-position: center bottom;
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 1;
        filter: blur(0px);
        transition: all .3s ease;
        will-change: opacity, filter;
    }

    .dn-search-wrapper--as-header .dn-search-wrapper__bg {
        opacity: .8;
        filter: blur(32px);
    }

    .dn-search-wrapper *,
    .dn-search-wrapper *:after,
    .dn-search-wrapper *:before {
        /* font: 16px Avenir, Verdana, sans-serif; */
        box-sizing: border-box;
        white-space: normal;
        overflow: visible;
    }

    .dn-search-wrapper .dn-header {
        display: block;
        position: fixed;
        z-index: 1;
        top: 2em;
        left: 2em;
        right: 2em;
    }

    .dn-search-wrapper .dn-header__logo {
        float: left;
    }

    .dn-search-wrapper .dn-header__actions {
        float: right;
    }

    .dn-search-wrapper .dn-header__account-menu,
    .dn-search-wrapper .dn-header__general-menu {
        margin-top: calc(calc(16px / 1.5) / 2);
        display: inline-block;
        vertical-align: middle;
    }

    .dn-search-wrapper .dn-header:after {
        content: "";
        clear: both;
        display: table;
    }

    .dn-search-wrapper .dn-search-input-wrapper {
        position: relative;
        z-index: 2;
        display: inline-block;
        vertical-align: middle;
    }

    .dn-search-wrapper .dn-search-input-wrapper__input {
        width: 12em;
        width: 50vw;
        border-width: 0;
        border-radius: 2px;
        padding: .5em;
        font-size: 2em;
    }

    .dn-search-wrapper .dn-search-input-wrapper__input:focus {
        outline: 2px auto #999;
    }

    .dn-search-wrapper .dn-search-input-wrapper__input::-webkit-input-placeholder {
        color: #ddd;
    }

    .dn-search-wrapper .dn-account-menu {
        position: relative;
    }

    .dn-search-wrapper .dn-account-menu__title {
        white-space: nowrap;
        overflow: hidden;
        text-indent: 100%;
        display: inline-block;
        width: 2em;
        height: 2em;
        background: #777 none;
        border-radius: 2em;
    }

    .dn-search-wrapper .dn-account-menu__notifications {
        font-size: 0;
        display: inline-block;
        position: absolute;
        top: calc(-1 * calc(16px / 1.5) / 4);
        left: 80%;
        margin-left: calc(-1 * calc(16px / 1.5) / 2);
        background: brown none;
        color: #fff;
        line-height: calc(16px / 1.5);
        padding: 0 calc(calc(16px / 1.5) / 2.4);
        border-radius: calc(calc(16px / 1.5) * 3);
        line-height: 0;
    }

    .dn-search-wrapper .dn-account-menu__quantity {
        font-size: calc(16px / 1.5);
    }

    .dn-search-wrapper .dn-general-menu {
        color: #fff;
        text-decoration: none;
        display: inline-block;
        padding-left: .5em;
        font-size: 2em;
    }

    .dn-below-search-wrapper {
        position: relative;
        z-index: 0;
    }
</style>
<style>
    @import url(https://fonts.googleapis.com/css?family=Lato:300,400);
    @import url(http://weloveiconfonts.com/api/?family=entypo);
    [class*=entypo-]:before {
    font-family: "entypo", sans-serif;
    margin: 0 8px 0 0;
    width: 24px;
    text-align: center;
    display: inline-block;
    border: none;
    }

    .Dropdown-nav li .NavLink, .Dropdown-profile {
    background: #fff;
    display: block;
    height: 35px;
    padding: 5px 20% 30px 0px;
    }

    .Dropdown {
    border: 2px solid #ddd;
    cursor: pointer;
    overflow: hidden;
    position: absolute;
    width: 200px;
    top: 10px;
    z-index: 10;
    right: 10px;
    border-top-left-radius: 4px;
    border-top-right-radius: 4px;
    border-bottom-left-radius: 4px;
    border-bottom-right-radius: 4px;
    }
    .Dropdown-profile {
    position: relative;
    }
    .Dropdown-profile .Photo {
    background: #ddd;
    display: inline-block;
    vertical-align: middle;
    border-top-left-radius: 2px;
    border-top-right-radius: 2px;
    border-bottom-left-radius: 2px;
    border-bottom-right-radius: 2px;
    height: 24px;
    width: 24px;
    }
    .Dropdown-profile .Name {
    display: inline-block;
    line-height: 24px;
    padding: 0 0 0 5px;
    vertical-align: middle;
    width: 120px;
    }
    .Dropdown-nav {
    height: 0;
    overflow: hidden;
    -webkit-transition: height 0.2s cubic-bezier(0.19, 1, 0.22, 1);
    -moz-transition: height 0.2s cubic-bezier(0.19, 1, 0.22, 1);
    transition: height 0.2s cubic-bezier(0.19, 1, 0.22, 1);
    }
    .Dropdown-nav ul {
    list-style: none;
    margin: 0;
    padding: 0;
    }
    .Dropdown-nav li {
    position: relative;
    }
    .Dropdown-nav li a {
    color: #ccc;
    -webkit-transition: color 0.3s ease;
    -moz-transition: color 0.3s ease;
    transition: color 0.3s ease;
    }
    .Dropdown-nav li a:hover {
    color: #49bcbe;
    }
    .Dropdown-nav li .OptionLink {
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    height: 22px;
    font-size: 18px;
    margin: auto;
    z-index: 5;
    }
    .Dropdown-nav li .NavLink {
    line-height: 24px;
    }
    .Dropdown.is-expanded nav {
   /*  height: 202px; */
   height: 100%;
    }

    .Dropdown-group {
    border-top: 1px solid #ddd;
    }

    .Dropdown.is-expanded .MenuIcon-line:nth-child(1) {
    top: 50%;
    }
    .Dropdown.is-expanded .MenuIcon-line:nth-child(3) {
    top: 50%;
    }

    .MenuIcon {
    bottom: 0;
    top: 0;
    margin: auto;
    position: absolute;
    right: 14px;
    height: 10px;
    width: 12px;
    }
    .MenuIcon-line {
    background: #49bcbe;
    display: inline-block;
    height: 2px;
    margin: auto;
    position: absolute;
    width: 100%;
    -webkit-transition: all 0.2s ease-in-out;
    -moz-transition: all 0.2s ease-in-out;
    transition: all 0.2s ease-in-out;
    }
    .MenuIcon-line:nth-child(1) {
    top: 0;
    }
    .MenuIcon-line:nth-child(2) {
    top: 50%;
    }
    .MenuIcon-line:nth-child(3) {
    top: 100%;
    }
</style>
<style>
.myAlert-top{
    position: fixed;
    top: 5px; 
    left:2%;
    z-index: 11;
    width: 96%;
}
</style>
@stop

@section('adminlte_js')
<script>
    $(".Dropdown").on("click", function(){
    $(this).toggleClass('is-expanded');
    });

    /*
    Admin Dropdown Menu
    michaellee / 2014-04-01
    https://michaelsoolee.com
    */
</script>
@stop

@section('classes_body', 'landing')

@section('body')
<div class="wrapper">
    <section class="content">
        <div class="myAlert-top">
            @include('component.alert')
        </div>
        <div id="dn-global-search-wrapper" class="dn-search-wrapper">
            <div class="dn-search-wrapper__bg"></div>

            <div class="Dropdown">
                <div class="Dropdown-profile">
            @guest
                <span class="Name">Menu</span>
            @endguest
            @auth
                {{--
                <img src="//s3-us-west-2.amazonaws.com/s.cdpn.io/33381/profile/profile-80.jpg?1" class="Photo" /> --}}
                <span class="Name">{{ userLogin()->displayName ? userLogin()->displayName : userLogin()->email }}</span>
                {{-- {{ userLogin()->displayName ? userLogin()->email :  ''}} --}}
            @endauth
                <span class="MenuIcon">
                    <span class="MenuIcon-line"></span>
                    <span class="MenuIcon-line"></span>
                    <span class="MenuIcon-line"></span>
                </span>
            </div>
                <nav class="Dropdown-nav">
                    @auth
                    <ul class="Dropdown-group">
                        <li>
                            <a href="{{ route('pegawai.index')}}" class="entypo-archive NavLink">Pegawai</a>
                            {{-- <a href="#" class="entypo-plus OptionLink"></a></li> --}}
                        <li>
                            <a href="{{ route('gaji.index')}}" class="entypo-docs NavLink">Gaji</a>
                            {{-- <a href="#" class="entypo-plus OptionLink"></a> --}}
                        </li>
                        <li>
                            <a href="{{ route('users.index')}}" class="entypo-users NavLink">Pengguna</a>
                            {{-- <a href="#" class="entypo-plus OptionLink"></a></li> --}}
                    </ul>
                    <ul class="Dropdown-group">
                        <li>
                            <a href="{{route('logout')}}" class="entypo-logout NavLink">Logout</a>
                        </li>
                    </ul>
                    @endauth
                    @guest
                    <ul class="Dropdown-group">
                        <li>
                            <a href="{{route('login')}}" class="entypo-login NavLink">Login</a>
                        </li>
                    </ul>
                    @endguest
                </nav>
            </div>

            <div id="dn-global-search-input-wrapper" class="dn-search-input-wrapper">
                <form id="form" method="POST" action="{{route('slip.lihat')}}" autocorrect="off" autocapitalize="off" autocomplete="off">
                    <div class="input-group input-group-lg">
                        <input type="text" class="form-control" placeholder="NIP" name="search">
                        <span class="input-group-append">
                            @csrf
                            @method('POST')
                            <button type="submit" class="btn btn-info btn-flat"><i class="fas fa-search"></i></button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
@stop
