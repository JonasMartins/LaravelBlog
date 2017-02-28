<!DOCTYPE html>
  <html lang="en">

  @include('partials._header')
  <body>
  
  @include('partials._nav')

    <div class="container">
      @include('partials._messages')
      @yield('content')

  @include('partials._footer'){{-- end de container aqui --}}


  </div><!-- end of .container -->
  
    @include('partials._javascript')
    @yield('scripts')
  
  </body>
</html>