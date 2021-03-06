<?php
 /**
 * 
 */
 class Auth
 {
 	
 	public static function isLogged()
 	{
 
 		if (!isset($_SESSION['user'])) {
 
 			$router = Config::get('router');
 			
 			header('Location: '.$router->generate('login', []));
 		} 
 	}

 	public static function authorizePromotor($params)
	{
		
		$promotor = Promotor::where('email=? AND password_degest=?', ['email'=>$params['login'], 'password_degest'=>Password::encryptPassword($params['password'])]);
		
		$router = Config::get('router');

		if (isset($params['page']) && $params['page'] == 'home') {
			$page = $router->generate('home', []).'?login-error';
		} else {
			$page = $router->generate('promotor_login', []);
		}

		if (!empty($promotor)) {
			setcookie('remember_promotor_email', $promotor->email);
			Auth::login($promotor[0]);
			header('Location: '.$router->generate('stats_promotors', ['promotors_id'=>$_SESSION['user']->id]));
		} else {
			new Alerts('error', 'Błędny login lub hasło');
			header('Location: '.$page);
		}
	} 

	public static function authorizeAdmin($params)
	{
		$router = Config::get('router');

		if (isset($params['page']) && $params['page'] == 'home') {
			$page = $router->generate('home', []).'?login-error';
		} else {
			$page = $router->generate('promotor_login', []);
		}

		if ($params['password'] == Config::get('admin_password')) {
			Auth::login(new Admin);
			header('Location: '.$router->generate('show_admin', []));
		} else {
			new Alerts('error', 'Błędny login lub hasło');
			header('Location: '.$page);
		}
	}

	public static function authorizeClient($params)
	{
		$router = Config::get('router');

		$client = [];
		$login_error = '';
		
		if (isset($params['page']) && $params['page'] == 'home') {
			$page = $router->generate('home', []).'?login-error';
		} else {
			$page = $router->generate('login', []);
		}

		if (isset($params['hash'])) {
			$client = Client::findBy('hash', $params['hash']);
			$login_error = 'Błędny identyfikator klienta';
		} else {
			$client = Client::where('email=? AND password_digest=?', ['email'=>$params['client']['email'], 'password_digest'=>Password::encryptPassword($params['client']['password'])]);
			$client = $client[0];
			$login_error = 'Błędny login lub hasło';

			if (empty($client) || $client->password_digest == Password::encryptPassword('')) {
				new Alerts('error', $login_error);
				header('Location: '.$page);
			}
		}
		
		if (!empty($client)) {
			setcookie('remember_client_email', $client->email);

			Auth::login($client);
			if ($client->password_digest == Password::encryptPassword('')) {
				header('Location: '.$router->generate('edit_client', ['client_id'=>$_SESSION['user']->id]));
			} else {
				header('Location: '.$router->generate('show_client', ['client_id'=>$_SESSION['user']->id]));
			}
		} else {
			new Alerts('error', $login_error);
			header('Location: '.$page);
		}
	} 

	public static function login($user)
	{
		$_SESSION['user'] = $user;
	}
}

	
	