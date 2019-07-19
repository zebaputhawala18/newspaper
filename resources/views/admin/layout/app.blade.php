<!DOCTYPE html>
<html lang="en">
    @include('admin.includes.head')
<body>
    <div class="preloader-it">
        <div class="loader-pendulums"></div>
    </div>
    <div class="hk-wrapper">
        <div class="hk-pg-wrapper hk-auth-wrapper">
            @yield('adminContent')
        </div>
    </div>
    @include('admin.includes.scripts)
</body>
