<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>

    @include('include.meta')

</head>

<body>

<!-- Pushy Menu -->
@include('include.right-menu')

<!-- Site Overlay -->
<div class="site-overlay"></div>
<!-- Content -->
<div id="container">

    @include('include.top-menu')

    <div class="container text-light bg-content">
        <div class="row p-3">
            <div class="w-100 px-3">
                <h2 class="text-uppercase">@yield('title')</h2>
            </div>
            @yield('content')
        </div>
    </div>

    @include('include.footer')

</div>

@include('include.scripts')
@yield('additional-scripts')
@include('include.modals')

</body>
</html>
