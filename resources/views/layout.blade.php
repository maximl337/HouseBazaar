<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>House Bazaar</title>
    <link rel="stylesheet" type="text/css" href="/css/app.css">
    <link rel="stylesheet" type="text/css" href="/css/libs.css">
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/dropzone.css">
    <link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
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
          <a class="navbar-brand" href="/">House Me Now!</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li><a href="/">HOME</a></li>
            <li class="text-primary"><a href="/properties/create">ADD PROPERTY</a></li>
          </ul>

          @if(Auth::check())
            <ul class="nav navbar-nav navbar-right">
              
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Hello, {{ Auth::user()->name }} <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="#">Account Settings</a></li>
                  <li><a href="#">My Properties</a></li>
                  <li role="separator" class="divider"></li>
                  <li><a href="/auth/logout">Logout</a></li>
                </ul>
              </li>
            </ul>

          @endif
          
        </div><!--/.nav-collapse -->
      </div>
    </nav>
    
    <div class="container">
        
        @yield('content')

    </div>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    
    <script type="text/javascript" src="/js/libs.js"></script>

    @yield('scripts.footer')

    @include('flash')
</body>
</html>