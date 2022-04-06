<!doctype html>
<html lang="pt">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">    
        
        <!-- CSRF Token -->    
        <meta name="_token" content="{{ csrf_token() }}">

        <title>meu Blog - Laravel & AJAX</title>        
        <link rel="icon" type="image/x-icon" href="{{asset('assets/favicon.ico')}}" />                    
        <!-- Font Awesome ícones (versão livre)-->
        <script src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" crossorigin="anonymous"></script>
        
        <link href="{{asset('css/styles.css')}}" rel="stylesheet"/>
        <link href="{{asset('css/menu_estilo.css')}}" rel="stylesheet"/>
    </head>
    <body>
         <!-- Navegação-->
         <nav class="navbar navbar-expand-lg navbar-light" id="mainNav">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="{{route('page.master')}}">meu Blog</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto py-4 py-lg-0">
                   <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="{{route('page.master')}}">Home</a></li>
                   <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="#!">Login</a></li>   
                   <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="#!">Registre-se</a></li>
                   <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="{{route('admin.artigos.index')}}">Artigos</a></li>
                   <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="{{route('admin.tema.index')}}">Temas</a></li>
                </ul>
                </div>
            </div>
        </nav>         
            @yield('content')
  
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>                
        <script src="{{asset('js/scripts.js')}}"></script>                              
      @yield('scripts')
    </body>
</html>
