<?php

use Illuminate\Database\Seeder;
use \App\Models\Users\User;
use \App\Models\Users\Collaborator;
use \App\Models\Users\Role;

class ZizacoSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		//['manager','coordenator','buyer','financial']
		//php artisan db:seed --class=ZizacoSeeder
		User::flushEventListeners();
		User::getEventDispatcher();
		Collaborator::flushEventListeners();
		Collaborator::getEventDispatcher();
		$start = microtime(true);
		$this->command->info( 'Iniciando os Seeders ZizacoSeeder' );
		$this->command->info( 'SETANDO GERÊNCIA' );
		$admin = new Role(); // Gerência = tudo
		$admin->name = 'manager';
		$admin->display_name = 'GERENTE'; // optional
		$admin->description = 'Usuário com acesso total ao sistema'; // optional
		$admin->save();

		$this->command->info( 'SETANDO COORDENADOR' );
		$client = new Role();
		$client->name = 'coordenator'; //Preenchimento de requisição + cadastro de clientes
		$client->display_name = 'COORDENADOR'; // optional
		$client->description = 'Usuário com acessos restritos'; // optional
		$client->save();

		$this->command->info( 'SETANDO COMPRADOR' );
		$client = new Role();
		$client->name = 'buyer'; //tudo
		$client->display_name = 'COMPRADOR';
		$client->description = 'Usuário com acesso total ao sistema'; // optional
		$client->save();

		$this->command->info( 'SETANDO FINANCEIRO' );
		$client = new Role();
		$client->name = 'financial'; //tudo
		$client->display_name = 'FINANCEIRO';
		$client->description = 'Usuário com acessos restritos'; // optional
		$client->save();

		$users = ['gerente', 'coordenador', 'comprador', 'financeiro'];
		foreach ($users as $key => $user){
			$usr = User::create([
				'name'              => 'User teste (' . strtoupper($user) . ')',
				'email'             => $user . '@email.com',
				'password'          => bcrypt('123'),
				'remember_token'    => str_random(10)
			]);
			Collaborator::create([
				'user_id'       => $usr->id,
				'description'   => 'TESTANDO USER '.strtoupper($user)
			]);
			$usr->roles()->attach($key+1); // id only
		}

		$user = User::create([
			'name'              => 'Leonardo',
			'email'             => 'silva.zanin@gmail.com',
			'password'          => bcrypt('123'),
			'remember_token'    => str_random(10)
		]);

		Collaborator::create([
			'user_id'       => $user->id,
			'description'   => 'PRIMEIRO USER'
		]);
		$user->roles()->attach(1); // id only

		$user = User::create([
			'name'              => 'Glauco',
			'email'             => 'glauco@email.com',
			'password'          => bcrypt('123'),
			'remember_token'    => str_random(10)
		]);

		Collaborator::create([
			'user_id'       => $user->id,
			'description'   => 'Glauco teste'
		]);
		$user->roles()->attach(1); // id only


		echo "\n*** Completo em " . round((microtime(true) - $start), 3) . "s ***";
	}
}
