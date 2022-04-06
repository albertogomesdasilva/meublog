<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use App\Models\Arquivo;
use App\Models\Artigo;
use App\Models\Tema;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private $artigo;

    public function __construct(Artigo $artigo)
    {
        $this->artigo = $artigo;
    }

    public function master(Request $request){

        setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        date_default_timezone_set('America/Sao_Paulo');

        if(is_null($request->pesquisa)){
            $artigos = $this->artigo->orderByDesc('id')->paginate(5);            
        }else{
            $query = $this->artigo->query()
                   ->where('titulo','LIKE','%'.$request->pesquisa.'%');
            $artigos = $query->orderByDesc('id')->paginate(5);
        }
        $temas = Tema::all();
        return view('page.artigos.master',[
            'temas' => $temas,
            'artigos' => $artigos,
        ]);
    }

    public function detail($slug){

        setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        date_default_timezone_set('America/Sao_Paulo');

        $artigo = $this->artigo->whereSlug($slug)->first();
        return view('page.artigos.detail',[
            'artigo' => $artigo,
        ]);
    }

    public function downloadArquivo($id){                      
        
        $arquivo = Arquivo::find($id);                
        $downloadPath = public_path('/storage/'.$arquivo->path);                

        $headers = [
            'HTTP/1.1 200 OK',
            'Pragma: public',
            'Content-Type: application/pdf'
        ];                   
        return response()->download($downloadPath,$arquivo->rotulo,$headers);    
    }

}
