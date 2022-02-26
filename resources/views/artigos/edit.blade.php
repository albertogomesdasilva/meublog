@extends('layouts.app')
@section('content')

<div class="" id="EditArtigoModal" tabindex="-1" role="" aria-labelledby="titleModalLabel" aria-hidden="false">
    <div class="" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="titleModalLabel">Editar Artigo</h5>                
            </div>
            <div class="modal-body form-horizontal">
            <form action="{{route('admin.artigos.update',['id'=>$artigo->id])}}" method="POST"> 
                @csrf                
                @method('PUT')
                <ul id="updateform_errList"></ul>                
                <div class="form-group mb-3">
                    <label for="">Título</label>
                    <input type="text" name="titulo" class="titulo form-control" value="{{$artigo->titulo}}">
                </div>
                <div class="form-group mb-3">
                    <label for="">Descrição</label>
                    <input type="text" name="descricao" class="descricao form-control" value="{{$artigo->descricao}}">
                </div>
                <div class="form-group mb-3">
                    <label for="">Conteúdo</label>
                    <textarea name="conteudo" id="conteudo" class="conteudo form-control" cols="30" rows="10">{{$artigo->conteudo}}</textarea>
                </div>                
                <div class="form-group mb-3">
                    <label for="">Slug</label>
                    <input type="text" name="slug" class="slug form-control" value="{{$artigo->slug}}">
                </div>
            </div>            
            <div class="modal-footer">
                <a href="{{route('admin.artigos.index')}}" type="button" class="btn btn-default" data-dismiss="modal">Fechar</a>
                <button type="submit" class="btn btn-primary">Atualizar</button>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection
