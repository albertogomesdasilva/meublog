@extends('layouts.app')

@section('content')

<!--AddArtigoModal-->

<div class="modal fade" id="AddArtigoModal" tabindex="-1" role="dialog" aria-labelledby="titleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="titleModalLabel">Adicionar Artigo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="close">
                <span aria-hidden="true">&times;</span>
                </button>                
            </div>
            <div class="modal-body form-horizontal">
            <form id="addform" name="addform" class="form-horizontal" role="form"> 
                <ul id="saveform_errList"></ul>                
                <div class="form-group mb-3">
                    <label for="">Título</label>
                    <input type="text" class="titulo form-control">
                </div>
                <div class="form-group mb-3">
                    <label for="">Descrição</label>
                    <input type="text" class="descricao form-control">
                </div>
                <div class="form-group mb-3">
                    <label for="">Conteúdo</label>
                    <textarea class="conteudo form-control" cols="30" rows="10"></textarea>
                </div>                
                <div class="form-group mb-3">
                    <label for="">Slug</label>
                    <input type="text" class="slug form-control">
                </div> 
                <div class="form-group mb-3">
                <label for="">Temas</label>
                <div class="form-group mb-3">
                        @foreach($temas as $t)                        
                        <label>
                                <input type="checkbox" name="temas[]" value="{{$t->id}}">{{$t->titulo}}                            
                        </label>                        
                        @endforeach
                </div>
            </div>           
            </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"> Fechar</button>
                <button type="button" class="btn btn-primary add_artigo">Salvar</button>
            </div>
        </div>
    </div>
</div>
<!--End AddArtigoModal-->

<!--EditArtigoModal-->

<div class="modal fade" id="EditArtigoModal" tabindex="-1" role="dialog" aria-labelledby="titleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="titleModalLabel">Editar e atualizar Artigo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="close">
                    <span aria-hidden="true">&times;</span>
                </button>                
            </div>
            <div class="modal-body form-horizontal">
            <form id="editform" name="editform" class="form-horizontal" role="form">
                <ul id="updateform_errList"></ul>

                <input type="hidden" id="edit_artigo_id">
                <div class="form-group mb-3">
                    <label for="">Título</label>
                    <input type="text" id="edit_titulo" class="titulo form-control">
                </div>
                <div class="form-group mb-3">
                    <label for="">Descrição</label>
                    <input type="text" id="edit_descricao" class="descricao form-control">
                </div>
                <div class="form-group mb-3">
                    <label for="">Conteúdo</label>
                    <textarea id="edit_conteudo" class="conteudo form-control" cols="30" rows="10"></textarea>
                </div>                
                <div class="form-group mb-3">
                    <label for="">Slug</label>
                    <input type="text" id="edit_slug" class="slug form-control">
                </div>
            </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-primary update_artigo">Atualizar</button>
            </div>
        </div>
    </div>
</div>

<!--Fim EditArtigoModal-->


<!--inicio index-->

<div class="container py-5"> 
    <div id="success_message"></div>    
    <div class="row">   
    <div class="card-body">
    <section class="border p-4 mb-4 d-flex align-items-left">    
    <form action="{{route('admin.artigos.index')}}" class="form-search" method="GET">
        <div class="col-sm-12">
            <div class="input-group rounded">            
            <input type="text" name="pesquisa" class="form-control rounded float-left" placeholder="Busca" aria-label="Search"
            aria-describedby="search-addon">
            <button type="submit" class="input-group-text border-0" id="search-addon" style="background: transparent;border: none;">
                <i class="fas fa-search"></i>
            </button>        
            <button type="button" class="AddArtigoModal_btn input-group-text border-0" style="background: transparent;border: none;"><i class="fas fa-plus"></i></button>
            </div>            
            </div>        
            </form>                     
  
    </section>    
            
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>                                
                                <th>#</th>
                                <th>TÍTULO</th>
                                <th>AUTOR</th>
                                <th>CRIADO EM</th>
                                <th>MODIFICADO EM</th>
                                <th>AÇÕES</th>
                            </tr>
                        </thead>
                        <tbody id="lista_artigo">  
                        @forelse($artigos as $artigo)   
                            <tr id="art{{$artigo->id}}">
                                <td>{{$artigo->id}}</td>                                
                                <td>{{$artigo->titulo}}</td>
                                <td>{{$artigo->user->name}}</td>
                                @if(is_null($artigo->created_at))
                                <td></td>
                                @else
                                <td>{{date('d/m/Y H:i:s', strtotime($artigo->created_at))}}</td>
                                @endif
                                @if(is_null($artigo->updated_at))
                                <td></td>
                                @else
                                <td>{{date('d/m/Y H:i:s', strtotime($artigo->updated_at))}}</td>
                                @endif
                                <td>                                                                      
                                        <div class="btn-group">                                           
                                            <button type="button" data-id="{{$artigo->id}}" class="edit_artigo_btn fas fa-edit" style="background:transparent;border:none;"></button>
                                            <button type="button" data-id="{{$artigo->id}}" data-tituloartigo="{{$artigo->titulo}}" class="delete_artigo_btn fas fa-trash" style="background:transparent;border:none;"></button>                                  
                                        </div>                                    
                                </td>
                            </tr>  
                            @empty
                            <tr>
                                <td colspan="4">Nada Encontrado!</td>
                            </tr>                      
                            @endforelse                                                    
                        </tbody>
                    </table> 
                    <div class="col-12">
                    {{$artigos->links("pagination::bootstrap-4")}}
                    </div>  
            </div>        
        </div>   
    </div>            
</div> 
<!--fim Index-->

@endsection

@section('scripts')

<script type="text/javascript">

$(document).ready(function(){  //INÍCIO                
        
    ///inicio delete artigo
    $(document).on('click','.delete_artigo_btn',function(e){
        e.preventDefault();
      
        var id = $(this).data("id");
        var tituloartigo = $(this).data("tituloartigo");

        var resposta = confirm('Excluindo '+tituloartigo+'. Deseja prosseguir?');

        if(resposta==true){
        
            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN':$('meta[name="_token"]').attr('content')
                }
            });
            
            $.ajax({
                url: 'delete/'+id,
                type: 'POST',
                dataType: 'json',
                data:{
                    "id": id,
                    "_method": 'DELETE',
                },
                success:function(response){
                    if(response.status==200){                        
                        //remove linha <tr> correspondente da tabela html da view index
                        $("#art"+id).remove();                           
                        $('#success_message').addClass("alert alert-success");
                        $('#success_message').text(response.message);                         
                    }
                }
            });            
        }   
    });  
    ///fim delete artigo

    //Inicio chamada EditArtigoModal
$('#EditArtigoModal').on('shown.bs.modal',function(){
        $('.titulo').focus();
        });

    $(document).on('click','.edit_artigo_btn',function(e){
        e.preventDefault();

        var id = $(this).data("id");
        $('#editform').trigger('reset');
        $('#EditArtigoModal').modal('show');

        $.ajaxSetup({
            headers:{
                    'X-CSRF-TOKEN':$('meta[name="_token"]').attr('content')
                }
        });
        $.ajax({
            type: 'GET',
            dataType: 'json',
            url:'edit/'+id,
            success: function(response){
                if(response.status==200){
                    $('#edit_artigo_id').val(response.artigo.id);
                    $('.titulo').val(response.artigo.titulo);
                    $('.descricao').val(response.artigo.descricao);
                    $('.conteudo').val(response.artigo.conteudo);
                    $('.slug').val(response.artigo.slug);   
                }
            }
        });
    });
    //Fim chamada EditArtigoModal
//Inicio processo update
$(document).on('click','.update_artigo',function(e){
e.preventDefault();

            $(this).text("Atualizando...");
            var id = $('#edit_artigo_id').val();

            var data = {
                'titulo': $('#edit_titulo').val(),
                'descricao': $('#edit_descricao').val(),
                'conteudo': $('#edit_conteudo').val(),
                'slug': $('#edit_slug').val(),                
            }

            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN':$('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                type:'POST',                
                dataType:'json',
                method: 'PUT',
                url: 'update/'+id,
                data: data,
                success:function(response){                    
                    if(response.status==400){                        
                        //erros na validação
                        $('#updateform_errList').html("");
                        $('#updateform_errList').addClass('alert alert-danger');
                        $.each(response.errors,function(key,err_values){
                            $('#updateform_errList').append('<li>'+err_values+'</li>');
                        });
                        $(this).text("Atualizado");
                    }else if(response.status==404){                         
                        //não localizado
                        $('#updateform_errList').html("");
                        $('#success_message').addClass('alert alert-warning');
                        $('#success_message').text(response.message);
                        $(this).text("Atualizado");
                    }else{
                       //sucesso na operação
                        $('#updateform_errList').html("");
                        $('#success_message').addClass('alert alert-success');
                        $('#success_message').text(response.message);
                        $(this).text("Atualizado");                  

                        $('#editform').trigger('reset');
                        $('#EditArtigoModal').modal('hide');                                          
                                
                        //atualizando a <tr> identificada na tabela html
                        var datacriacao = new Date(response.artigo.created_at);
                            datacriacao = datacriacao.toLocaleString('pt-BR');
                        if(datacriacao=="31/12/1969 21:00:00"){
                            datacriacao = "";
                        }
                        var dataatualizacao = new Date(response.artigo.updated_at);
                            dataatualizacao = dataatualizacao.toLocaleString('pt-BR');
                        if(dataatualizacao=="31/12/1969 21:00:00"){
                            dataatualizacao="";
                        }

                        var linha = '<tr id="art'+response.artigo.id+'">\
                                    <td>'+response.artigo.id+'</td>\
                                    <td>'+response.artigo.titulo+'</td>\
                                    <td>'+response.user.name+'</td>\
                                    <td>'+datacriacao+'</td>\
                                    <td>'+dataatualizacao+'</td>\
                                    <td><div class="btn-group">\
                                    <button type="button" data-id="'+response.artigo.id+'"\
                                    class="edit_artigo_btn fas fa-edit"\
                                    style="background:transparent;border:none;"></button>\
                                    <button type="button" data-id="'+response.artigo.id+'"\
                                    data-tituloartigo="'+response.artigo.titulo+'" \
                                    class="delete_artigo_btn fas fa-trash"\
                                    style="background:transparent;border:none;"></button>\
                                    </div></td>\
                                    </tr>';                             
                                $("#art"+id).replaceWith(linha);                    
                    }
                }
            });
        
        });    
        //Fim processo update
        //chamar o AddArtigoModal
        $('#AddArtigoModal').on('shown.bs.modal',function(){
                $('.titulo').focus();
        });

        $(document).on('click','.AddArtigoModal_btn',function(e){
                    e.preventDefault();
                    $('#addform').trigger('reset');
                    $('#AddArtigoModal').modal('show');
        });       
        //Fim da chamada ao AddArtigoModal
        //Inicio da criação do artigo
        $(document).on('click','.add_artigo',function(e){
            e.preventDefault();
            //Array apenas com os checkboxs marcados

            var temas = new Array;
            $("input[name='temas[]']:checked").each(function(){                
                temas.push($(this).val());
            });              

            var data = {
                'titulo': $('.titulo').val(),
                'descricao': $('.descricao').val(),
                'conteudo': $('.conteudo').val(),
                'slug': $('.slug').val(),
                'temas':temas,   //Array
            }
            $.ajaxSetup({                
                headers:{
                'X-CSRF-TOKEN':$('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                url:'store',
                type:'POST',
                dataType: 'json',
                data:data,
                success:function(response){
                if(response.status==400){
                           //erros
                            $('#saveform_errList').html("");
                            $('#saveform_errList').addClass("alert alert-danger");
                            $.each(response.errors,function(key,err_values){
                                    $('#saveform_errList').append('<li>'+err_values+'</li>');
                            });
          
                }else{
                //Sucesso na operação
                $('#saveform_errList').html("");
                $('#success_message').addClass("alert alert-success");
                $('#success_message').text(response.message);
                $('#addform').trigger('reset');
                $('#AddArtigoModal').modal('hide');
                //inclui uma linha nova na tabela html
        var datacriacao = new Date(response.artigo.created_at);
            datacriacao = datacriacao.toLocaleString('pt-BR');
                if(datacriacao=="31/12/1969 21:00:00"){
                datacriacao = "";
                }                       
        var dataatualizacao =  new Date(response.artigo.updated_at);
            dataatualizacao = dataatualizacao.toLocaleString('pt-BR');
                if(dataatualizacao=="31/12/1969 21:00:00"){
                dataatualizacao = "";
                }  

                var linha = '<tr id="post'+response.artigo.id+'">\
                        <td>'+response.artigo.id+'</td>\
                        <td>'+response.artigo.titulo+'</td>\
                        <td>'+response.user.name+'</td>\
                        <td>'+datacriacao+'</td>\
                        <td>'+dataatualizacao+'</td>\
                        <td><div class="btn-group">\
                        <button type="button" \
                        data-id="'+response.artigo.id+'" class="edit_artigo_btn fas fa-edit" \
                        style="background:transparent;border:none;"></button>\
                        <button type="button" data-id="'+response.artigo.id+'" \
                        data-tituloartigo="'+response.artigo.titulo+'" \
                        class="delete_artigo_btn fas fa-trash" \
                        style="background:transparent;border:none;"></button>\
                        </div></td>\
                        </tr>';  
            $('#lista_artigo').append(linha);
                    }
                }
            });
});
//Fim da criação do artigo

});  //FIM ready

</script>

@endsection
