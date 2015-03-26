<?php namespace App\Modules\User\Database\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use DB;
use App\Modules\User\Models\User;

class UserSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('users')->delete();

        User::create([
        	'name' => 'test name',
        	'surname' => 'test surname',
        	'email' => 'test@mail.com',
        	'password' => '$2y$10$4dmOjsV5ITK5XxeFPTWRouKurygjwzA.4gcCEcmNY0Yj2PPiy4T8m'
        ]);
	}

}
