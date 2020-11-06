@include('includes.header')
@include('includes.sidebar')
<section class="content">
    <div class="container-fluid">
        @yield('body')
    </div>
</section>
@include('includes.footer')