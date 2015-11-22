<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>House Bazaar</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @yield('header-meta')

    <link href='https://fonts.googleapis.com/css?family=Lato:400,100,100italic,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/dropzone.css">
    <link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/css/app.css">
    <link rel="stylesheet" type="text/css" href="/css/libs.css">
    
    @yield('header')
    
</head>
<body>

    

    <!-- Fixed navbar -->
    <nav id="navbar" class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-dropdown" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a title="House me now" class="navbar-brand" href="/">House Me Now!</a>
        </div>
        <div id="navbar-dropdown" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li><a title="Home" href="/">Home</a></li>
            <li class="text-primary"><a title="Add a property" href="/properties/create">Add property</a></li>
          </ul>

          @if(Auth::check())
            <ul class="nav navbar-nav navbar-right">
              
              <li class="dropdown">
                <a title="Show more" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Hello, {{ Auth::user()->name }} <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a title="Account settings" href="/account/settings">Account Settings</a></li>
                  <li><a title="My properties" href="/user/properties">My Properties</a></li>
                  <li role="separator" class="divider"></li>
                  <li><a title="Logout" href="/auth/logout">Logout</a></li>
                </ul>
              </li>
            </ul>

          @else
            <ul class="nav navbar-nav navbar-right">
              
              <li><a title="Sign in" href="/auth/login">Sign in</a></li>
            </ul>
          @endif
          
        </div><!--/.nav-collapse -->
      </div>
    </nav>
    
    
        
    @yield('content')

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    
    <script type="text/javascript" src="/js/libs.js"></script>

    @yield('scripts.footer')

    @include('flash')

</body>
</html>