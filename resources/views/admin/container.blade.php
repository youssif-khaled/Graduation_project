@include('admin.header')
@include('admin.sidebar')
@include('admin.navbar')

<div class="container-fluid page-body-wrapper">
    <div class="container" align = "center">
@yield('content')
    </div>
</div>

@include('admin.footer')
