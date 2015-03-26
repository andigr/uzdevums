<?php namespace App\Modules\User\Controllers;

use App\Modules\User\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
 
class UserController extends Controller {

	public function index() 
	{
		return view("user::user_info");
	}

	public function create() 
	{
		$json = [
			'messages'=>$this->messages_for_json(),
			'latvian_alphabet'=>$this->latvian_alphabet(),
			'client_side_validation'=>true,
			'email_check_link'=>url('/user/user-by-email')
		];
		$json = json_encode($json);
		return view("user::registration_form", ['json'=>$json]);
	}

	public function store(Request $request)
	{
		$latvian_alphabet = $this->latvian_alphabet();
		$this->validate($request, [
			'name'=>'required|max:30|regex:/^['.$latvian_alphabet.' ]+$/',
			'surname'=>'required|max:50|regex:/^['.$latvian_alphabet.' ]+$/',
			'email'=>'required|max:255|email|unique:users',
			'password'=>'required|min:8|max:255|confirmed',
		], $this->messages());

		$input = $request->all();
		$input['password'] = Hash::make($input['password']);

		$user = User::create($input);

		Auth::loginUsingId($user->id);

		return redirect('user');
	}

	function user_by_email(Request $request)
	{
		$input = $request->all();
		$user = User::where('email', $input['email'])->first();
		return json_encode(['user'=>$user]);
	}

	private function latvian_alphabet() 
	{
		return 'AaĀāBbCcČčDdEeĒēFfGgĢģHhIiĪīJjKkĶķLlĻļMmNnŅņOoPpRrSsŠšTtUuŪūVvZzŽž';
	}

	private function messages() 
	{
		return [
			'name.required'=>'Lūdzu ievadiet vārdu',
			'name.max'=>'Vārds ir pārāk garš',
			'name.regex'=>'Vārds var saturēt tikai lielos un mazos latviešu alfabēta burtus un atstarpes',
			'surname.required'=>'Lūdzu ievadiet uzvārdu',
			'surname.max'=>'Uzvārds ir pārāk garš',
			'surname.regex'=>'Uzvārds var saturēt tikai lielos un mazos  latviešu alfabēta burtus un atstarpes',
			'email.required'=>'Lūdzu ievadie e-pastu',
			'email.email'=>'Jāievada derīgo e-pastas adrese',
			'email.unique'=>'E-pastas adrese ir aizņemta',
			'password.required'=>'Lūdzu ievadiet parole',
			'password.min'=>'Parolei jābūt vismaz 8 simbolu garai',
			'password.confirmed'=>'Paroles nesakrīt'
		];
	}

	private function messages_for_json()
	{
		$messages = $this->messages();
		$messages_for_json = array();
		foreach ($messages as $key => $value) {
			$messages_for_json[str_replace('.', '_', $key)] = $value;
		}
		return $messages_for_json;
	}

}
