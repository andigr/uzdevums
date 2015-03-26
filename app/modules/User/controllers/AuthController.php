<?php namespace App\Modules\User\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
 
class AuthController extends Controller {

	public function login()
	{
		return view("user::login_form");	
	}

	public function logout()
	{
		Auth::logout();
		return redirect()->intended('auth/login');
	}

	public function authenticate(Request $request)
	{
		$this->validate($request, [
			'email'=>'required',
			'password'=>'required',
		], $this->messages());

		$input = $request->all();

		if (Auth::attempt(['email' => $input['email'], 'password' => $input['password']]))
        {
            return redirect()->intended('user');
        }

        return redirect('auth/login')
        	->withInput($request->only('email'))
        	->withErrors([
        		'email'=>'Lietotājs neeksistē vai bija ievadīta neparaiza parole'
        	]);
	}

	private function messages() 
	{
		return [
			'email.required'=>'Lūdzu ievadie e-pastu',
			'password.required'=>'Lūdzu ievadiet parole',
		];
	}

}
