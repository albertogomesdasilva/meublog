<!doctype html>
<html lang="pt">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">    

    <!-- CSRF Token -->    
    <meta name="_token" content="{{ csrf_token() }}">
    
    <title>Painel Administrativo</title>
    
<link rel="stylesheet" href="{{asset('bootstrap-4.1.3-dist/css/bootstrap.css')}}">
<link rel="stylesheet" href="{{asset('bootstrap-4.1.3-dist/css/bootstrap.min.css')}}">

<link rel="stylesheet" href="{{asset('fontawesome/css/all.css')}}">    

</head>
<body class="container mt-5" id="app">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="/">meuBlog</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">

        <ul class="navbar-nav">

        <li class="nav-item active">
        <a class="nav-link" href="{{route('admin.artigos.index')}}">Artigos</a>
        </li>
        <li class="nav-item active">
        <a class="nav-link" href="{{route('admin.tema.index')}}">Temas</a>
        </li>
        
        </ul>

       </div>
  
       </nav>

      <div class="container">
      <main class="py-4">
      @yield('content')      
      </main>             
     </div>
    <!--jquery-->
    <script src="{{asset('jquery/jquery-3.6.0.js')}}" type="text/javascript"></script>                     
     <!--bootstrap-->
     <script src="{{asset('bootstrap-4.1.3-dist/js/bootstrap.js')}}" type="text/javascript"></script>  
     <script src="{{asset('bootstrap-4.1.3-dist/js/bootstrap.min.js')}}" type="text/javascript"></script>      
      @yield('scripts')    

</body>
</html>
