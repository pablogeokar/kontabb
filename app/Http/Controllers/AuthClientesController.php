<?php

namespace App\Http\Controllers;

use App\Cliente;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;

//use Illuminate\Support\Facades\Auth;

class AuthClientesController extends Controller {

    use AuthenticatesAndRegistersUsers,
        ThrottlesLogins;

    /*
    protected $redirectTo = 'clientes/painel/';
    protected $guard = 'logclientes';
     * 
     */

    // protected $session = true;
    public function __construct() {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    protected function validator(array $data) {
        return Validator::make($data, [
                    'cpf_cnpj' => 'required|max:255',
                    'email' => 'required|email|max:255|unique:users',
                    'password' => 'required|min:6',
        ]);
    }

    /*
      public function showLoginForm() {

      if (Auth::guard('clientes')->check()) {
      return redirect('/clientes');
      }

      return view('clientes.login');
      }
     */

    //Login do cliente

    public function postLogin(Request $request) {
        $dadosForm = $request->except('_token', 'logar');

        $autentica = auth()->guard('logclientes')->attempt($request->only('cpf_cnpj', 'email', 'password'));

        if ($autentica) {
            return redirect()->intended('clientes/');
        }
        return back()
                        ->withErrors('authError', 'Email ou senha inválidos')
                        ->withInput($request->except('password'));
    }
    
    

    public function logout() {
        auth()->guard('logclientes')->logout();
        return redirect('/clientes');
    }

}
