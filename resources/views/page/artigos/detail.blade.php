@extends('layouts.page')
@section('content') 

  <!-- Cabeçalho-->
 <header class="masthead" style="background-image: url('/storage/{{$artigo->imagem}}')">
            <div class="container position-relative px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <div class="post-heading">
                            <h1>{{$artigo->titulo}}</h1>
                            <h2 class="subheading">{{$artigo->descricao}}</h2>
                            <span class="meta">
                                Postado por
                                <a href="#!">{{$artigo->user->name}}</a>
                     <img src="{{asset('/assets/img/Delcione.jpg')}}" class="rounded-circle" width="50">
                                <span class="caret"></span><br>                               
                       {{ucwords(strftime('%A, %d de %B de %Y', strtotime($artigo->created_at)))}}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
</header>                        
<!-- Conteúdo do artigo -->
<article class="mb-3">
            <div class="container px-1 px-lg-1">
                <div class="row gx-1 gx-lg-1 justify-content-center">
                <div class="col-md-10 col-lg-10 col-xl-9">                    
                <!--barra de informações-->
                <nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-left">        
                <ul class="menu">                    
                    <li><a href="#!">Temas</a>
                        <ul>
                @foreach($artigo->temas as $tema)
                <li><a href="{{route('page.tema',['slug' => $tema->slug])}}">{{$tema->titulo}}</a></li>
                 @endforeach      	                  
                        </ul>
                    </li>
                    <li><a href="#!">Downloads</a>
                        <ul>
                            @foreach($artigo->arquivos as $arq)   
                                <li><a href="{{route('page.download',['id'=> $arq->id])}}" id="download_file_btn" data-id="{{$arq->id}}" data-filename="{{$arq->nome}}"><i class="far fa-file-pdf"></i> {{$arq->rotulo}}</a></li>	                  
                            @endforeach      
                        </ul>
                    </li>       
                </ul>
                </nav>  
                             <div class="preformated">
                               <pre style="display: block; 
                                                     text-align: justify; 
                                                     font-family: monospace; 
                                                     white-space: pre-line;">
                                 {{$artigo->conteudo}}                                                   
                                  </pre>             
                             </div>                       
                    </div>
              </div>                
            </div>            
</article> 
<!-- Rodapé-->
<footer class="border-top">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <ul class="list-inline text-center">
                        <li class="list-inline-item">
                                <a href="{{asset($artigo->user->link_instagram)}}" target="_blank">
                                    <span class="fa-stack fa-lg">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fab fa-instagram fa-stack-1x fa-inverse"></i>
                                    </span>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="{{asset($artigo->user->link_facebook)}}" target="_blank">
                                    <span class="fa-stack fa-lg">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fab fa-facebook-f fa-stack-1x fa-inverse"></i>
                                    </span>
                                </a>
                            </li>                                                   
                        </ul>
                        <div class="small text-center text-muted fst-italic">Copyright &copy; Laravel & Ajax – meuBlog: Aprenda Fazendo</div>
                    </div>
                </div>
            </div>
</footer> 
@endsection
