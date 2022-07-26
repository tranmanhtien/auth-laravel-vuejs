<!DOCTYPE html>
<html lang="en">
@include('admin.layouts.head')
<body id="app-container" class="menu-sub-hidden show-spinner no-footer">
@include('admin.layouts.nav-bar')
@include('admin.layouts.menu')
@yield('content')
@include('admin.layouts.script')
</body>

</html>
