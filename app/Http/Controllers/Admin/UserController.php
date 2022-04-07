<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function index(Request $request)
    {
        if(is_null($request->pesquisa)){
            $users = $this->user->orderByDesc('id')->paginate(5);
        }else{
            $query = $this->user->query()
                   ->where('name','LIKE','%'.$request->pesquisa.'%');
            $users = $query->orderByDesc('id')->paginate(5);
        }
        return view('user.index',[
            'users' => $users,
        ]);
    }

    
    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|max:100',
            'email' => 'required|email|max:100|unique:users',
            'password' => 'required|min:8|max:100',            
        ],[
            'name.required'  => 'O campo NOME é obrigatório!',
            'name.max'       => 'O NOME deve ter no máximo :max caracteres!',
            'email.required' => 'O campo EMAIL é obrigatório!',
            'email.email'    => 'O EMAIL é inválido!',
            'email.max'      => 'O EMAIL deve conter no máximo :max caracteres!',
            'email.unique'   => 'O EMAIL já existe!',
            'password.required' => 'A SENHA é obrigatória!',
            'password.min' => 'A SENHA deve ter no mínimo :min caracteres!',
            'password.max' => 'A SENHA deve ter no máximo :max caracteres!',
        ]);
        if($validator->fails()){
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors()->getMessages(),
            ]);
        }else{
        $filePath="";
        if($request->hasFile('imagem')){
        $file = $request->file('imagem');                           
        $fileName =  $file->getClientOriginalName();
        $filePath = 'avatar/'.$fileName;
        $storagePath = public_path().'/storage/avatar/';
        $file->move($storagePath,$fileName);
        }
        $data = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'moderador' => $request->input('moderador'),
            'inativo' => false,
            'avatar'  => $filePath,
            'link_instagram' => $request->input('link_instagram'),
            'link_facebook' => $request->input('link_facebook'),
            'link_site' => $request->input('link_site'),            
        ];
        $user = $this->user->create($data);
        return response()->json([
            'user' => $user,
            'status' => 200,
            'message'=> 'Registro incluído com sucesso!',
        ]);
    }

    }

    
    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {
        $user = $this->user->find($id);
        return response()->json([
            'user' => $user,
            'status' => 200,
        ]);

    }

    
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|max:100',
            'email' => 'required|email|max:100',
            'password' => 'required|min:8|max:100',            
        ],[
            'name.required'  => 'O campo NOME é obrigatório!',
            'name.max'       => 'O NOME deve ter no máximo :max caracteres!',
            'email.required' => 'O campo EMAIL é obrigatório!',
            'email.email'    => 'O EMAIL é inválido!',
            'email.max'      => 'O EMAIL deve conter no máximo :max caracteres!',     
            'password.required' => 'A SENHA é obrigatória!',
            'password.min' => 'A SENHA deve ter no mínimo :min caracteres!',
            'password.max' => 'A SENHA deve ter no máximo :max caracteres!',       
        ]);
        if($validator->fails()){
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors()->getMessages(),
            ]);
        }else{        
        $user = $this->user->find($id);
        if($user){
        $filePath="";
        if($request->hasFile('imagem')){
        //exclui o arquivo de avatar anterior se houver
          if($user->avatar){
            $antigoPath = public_path('/storage/'.$user->avatar);
            if(file_exists($antigoPath)){
            unlink($antigoPath);
            }
          }
        //upload do novo arquivo
        $file = $request->file('imagem');                           
        $fileName =  $user->id.'_'.$file->getClientOriginalName();
        $filePath = 'avatar/'.$fileName;
        $storagePath = public_path().'/storage/avatar/';
        $file->move($storagePath,$fileName);
        }        
        $data['name'] = $request->input('name');
        $data['email'] = $request->input('email');
        $data['password'] = bcrypt($request->input('password'));
        $data['moderador'] = $request->input('moderador');
        $data['inativo'] = $request->input('inativo');
        if($filePath!=""){
        $data['avatar']  = $filePath;
        }
        $data['link_instagram'] = $request->input('link_instagram');
        $data['link_facebook'] = $request->input('link_facebook');
        $data['link_site'] = $request->input('link_site');        
        $user->update($data);
        $u = User::find($id);
        return response()->json([
            'user' => $u,
            'status' => 200,
            'message'=> 'Registro atualizado com sucesso!',
        ]);
    }else{
        return response()->json([
            'status' => 404,
            'message' => 'Registro não localizado!',
        ]);
    }
    }

    }

    
    public function destroy($id)
    {
        $user = $this->user->find($id);
        //exclusão do arquivo do avatar se houver
        if($user->avatar){
            $avatarPath = public_path('/storage/'.$user->avatar);
            if(file_exists($avatarPath)){
                unlink($avatarPath);
            }
        }
        //exclusão dos comentários
        $comentarios = $user->comentarios;
        $user->comentarios()->delete($comentarios);
        //exclusão dos arquivos pdf
        $arquivos = $user->arquivos;
             foreach($arquivos as $arq){
                 $arqPath = public_path('/storage/'.$arq->path);
                 if(file_exists($arqPath)){
                     unlink($arqPath);
                 }
             }
        $user->arquivos()->delete($arquivos);
        //exclusão dos artigos
        $artigos = $user->artigos;              
              foreach($artigos as $art){
        //excluisão os arquivos de capa dos artigos se houver
                  if($art->imagem){
                  $capaPath = public_path('/storage/'.$art->imagem);
                  if(file_exists($capaPath)){
                      unlink($capaPath);
                  }
                }
                //exclusão da relação com os temas se houver
                $temas = $art->temas;
                if($temas){
                $art->temas()->detach($temas);
                }
              }              
        $user->artigos()->delete($artigos);
        //Exclusão do usuário
        $user->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Registro excluído com sucesso!',
        ]);

    }

    public function moderadorUsuario(Request $request,$id){
        $moderador = $request->input('moderador');
        $data = ['moderador' => $moderador];
        $user = $this->user->find($id);
        $user->update($data);
        $u = User::find($id);
        return response()->json([
            'user' => $u,
            'status'=> 200,
        ]);
    }

    public function inativoUsuario(Request $request,$id){
        $inativo = $request->input('inativo');
        $data = ['inativo' => $inativo];
        $user = $this->user->find($id);
        $user->update($data);
        $u = User::find($id);
        return response()->json([
            'user' => $u,
            'status'=> 200,
        ]);
    }

}