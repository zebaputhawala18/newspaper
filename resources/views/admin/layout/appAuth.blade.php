<!DOCTYPE html>
<html lang="en">
    @include('admin.includes.head')
<body>
    <div class="preloader-it">
        <div class="loader-pendulums"></div>
    </div>
    <div class="hk-wrapper hk-vertical-nav">
        @include('admin.admin.includes.topNavBar')
        @include('admin.includes.verticalNavBar')
        @include('admin.includes.settingsPanel')
        <div class="hk-pg-wrapper">
            @include('admin.includes.breadCrumb')
            @yield('adminAuthContent')
        </div>
    </div>
    @include('admin.includes.scripts)
</body>
