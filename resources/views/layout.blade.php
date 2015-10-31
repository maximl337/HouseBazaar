<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>House Bazaar</title>
    <link rel="stylesheet" type="text/css" href="/css/app.css">
    <link rel="stylesheet" type="text/css" href="/css/libs.css">
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/dropzone.css">
</head>
<body>

    

    <!-- Fixed navbar -->
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Bootstrap theme</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#contact">Contact</a></li>
          </ul>

          @if(Auth::check())
            <p class="navbar-text navbar-right">
              Hello, {{ Auth::user()->name }}
            </p>
          @endif
          
        </div><!--/.nav-collapse -->
      </div>
    </nav>
    
    <div class="container">
        
        @yield('content')

    </div>

    <script type="text/javascript" src="/js/libs.js"></script>

    @yield('scripts.footer')

    @include('flash')
</body>
</html>