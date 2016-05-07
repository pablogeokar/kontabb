<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Hash;
use App\User;

class UsuariosController extends Controller {

    private $usuarios;

    public function __construct(User $usuarios) {
        $this->usuarios = $usuarios;
    }

    //*********************************************************************
    //Exibe a listagem inicial
    public function getIndex() {
        $usuarios = $this->usuarios->all();
        return view('painel.listagens.usuarios', compact('usuarios'));
    }

    //*********************************************************************
    //*********************************************************************
    //Exibe o formulário para edição
    public function getEditar($id) {
        $usuarios = $this->usuarios->find($id);
        return view('painel.forms.cadUsuarios', compact('usuarios', 'id'));
    }

    //*********************************************************************
    //*********************************************************************    
    //Exibe o formulário para cadastrar
    public function getCadastrar() {
        return view('painel.forms.cadUsuarios');
    }

    //*********************************************************************  
    //*********************************************************************
    //post Cadastrar
    public function postCadastrar(Request $request) {
        $dadosForm = $request->except('_token', 'id');

        //Realiza a validação dos dados
        $validator = validator($dadosForm, [
            'name' => 'required|min:3',
            'email' => 'required|email',
            'password' => 'required|min:3'
        ]);

        if ($validator->fails()) {
            return redirect('painel/usuarios/cadastrar/')
                            ->withErrors($validator)
                            ->withInput();
        }

        //Criptografa a senha
        $dadosForm['password'] = Hash::make($dadosForm['password']);

        //Cria um novo usuário
        User::create($dadosForm);

        //Redireciona para a rota de listagens
        return redirect('painel/usuarios');
    }

    //*********************************************************************
    //*********************************************************************    
    //post Editar
    public function postEditar(Request $request, $idUsuario) {
        $dadosForm = $request->except('_token', 'foto');


        //Realiza a validação dos dados
        $validator = validator($dadosForm, [
            'name' => 'required|min:3',
            'email' => 'required|email'
        ]);

        if ($validator->fails()) {
            return redirect("painel/usuarios/editar/$idUsuario")
                            ->withErrors($validator)
                            ->withInput();
        }

        //Se o usuário alterar a senha, então a mesma será criptografada
        if (!$dadosForm['password'] == null) {
            $dadosForm['password'] = Hash::make($dadosForm['password']);
        } else {
            //Caso a senha esteja em branco, o sistema ignora a alteração e mantém a senha antiga
            $dadosForm = $request->except('_token', 'password', 'foto');
        }

        //Upload de imagem Jpeg ou PNG
        $foto = $request->file('foto');
        if ($request->hasFile('foto') && $foto->isValid()) {
            if ($foto->getMimeType() == 'image/jpeg' || $foto->getMimeType() == 'image/png') {
                $foto->move('images/usuarios/', $idUsuario . '.' . $foto->getClientOriginalExtension());
            }
        }

        //Persiste a alteração no banco
        User::where('id', $idUsuario)->update($dadosForm);

        //Redireciona para a rota de listagens
        return redirect('painel/usuarios');
    }

    //*********************************************************************  
    //*********************************************************************    
    //get Excluir
    public function getExcluir($id) {
        //Realiza a exclusão
        User::where('id', '=', $id)->delete();

        //Redireciona para a rota de listagens
        return redirect('painel/usuarios');
    }

}
