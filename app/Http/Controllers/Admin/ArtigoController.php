<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Artigo;
use App\Models\Tema;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class ArtigoController extends Controller
{
    private $artigo;                            

    public function __construct(Artigo $artigo)
    {
        $this->artigo = $artigo;                  
    }

    public function index(Request $request)
    {     
        if(is_null($request->pesquisa)){
            $artigos = $this->artigo->orderBy('id','DESC')->paginate(5);                           
        }else{
            $query = Artigo::with('User')
                         ->where('titulo','LIKE','%'.$request->pesquisa.'%');         
            $artigos = $query->orderBy('id','DESC')->paginate(5);
        }            
            $temas = Tema::all('id','titulo'); //Todos os temas
        return view('artigos.index',compact('artigos','temas'));
    }

    
    public function create()
    {
        //return view('artigos.create');
    }

    
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'titulo'    => 'required|max:100',
            'descricao' => 'required|max:180',
            'conteudo'  => 'required',
        ],[
            'titulo.required'    => 'O campo TÍTULO é obrigatório!',
            'titulo.max'         => 'O TÍTULO deve conter no máximo :max caracteres!',
            'descricao.required' => 'O campo DESCRIÇÃO é obrigatório!',
            'descricao.max'      => 'A DESCRIÇÃO deve conter no máximo :max caracteres!',
            'conteudo.required'  => 'O campo CONTEÚDO é obrigatório',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors()->getMessages(),
            ]);
        }else{
            $user = User::find(1);
            $timestamps = $this->artigo->timestamps;
            $this->artigo->timestamps=false;
            $data = [
                'titulo'     => $request->input('titulo'),
                'descricao'  => $request->input('descricao'),
                'conteudo'   => $request->input('conteudo'),
                'slug'       => $request->input('slug'),
                'user_id'    => $user->id,
                'created_at' =>now(),
                'updated_at' => null,
            ];
            $artigo = $this->artigo->create($data);      //criação do artigo                                          
            $this->artigo->timestamps=true;                        
            $artigo->temas()->sync($request->input('temas'));  //sincronização
            $a = Artigo::find($artigo->id);            
            return response()->json([                
                'user'  => $user,
                'artigo' => $a,
                'status'  => 200,
                'message' => 'Artigo adicionado com sucesso!',
            ]);            
        }             

    }

    
    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {
        $artigo = $this->artigo->find($id);
        return response()->json([
            'artigo' => $artigo,
            'status' => 200,
        ]);
   
    }

    
    public function update(Request $request, $id)
    {        
        $validator = Validator::make($request->all(),[
            'titulo'    => 'required|max:100',
            'descricao' => 'required|max:180',
            'conteudo'  => 'required',
        ],[
            'titulo.required'    => 'O campo TÍTULO é obrigatório!',
            'titulo.max'         => 'O TÍTULO deve conter no máximo :max caracteres!',
            'descricao.required' => 'O campo DESCRIÇÃO é obrigatório!',
            'descricao.max'      => 'A DESCRIÇÃO deve conter no máximo :max caracteres!',
            'conteudo.required'  => 'O campo CONTEÚDO é obrigatório',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors()->getMessages(),
            ]);
        }else{
            $artigo = $this->artigo->find($id);            
            $user = User::find(1);
            if($artigo){
                $artigo->titulo = $request->input('titulo');
                $artigo->descricao = $request->input('descricao');
                $artigo->conteudo = $request->input('conteudo');
                $artigo->slug = $request->input('slug');
                $artigo->user_id = $user->id;
                $artigo->update();
                $a = Artigo::find($id);                
                return response()->json([
                    'artigo'  => $a,
                    'user'    => $user,
                    'status'  => 200,
                    'message' => 'Artigo atualizado com sucesso!',
                ]);
            }else{
                return response()->json([
                    'status'  => 404,
                    'message' => 'Artigo não localizado!',
                ]);
            }
        }   

    }

    
    public function destroy($id)
    {
        $artigo = $this->artigo->find($id);
        $artigo->delete(); 
        return response()->json([
            'status'  => 200,
            'message' => 'Artigo excluído com sucesso!',
        ]);
    }
}
