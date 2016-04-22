<?php namespace App\Http\Controllers; 

use App\User;
use Auth;
use Socialite;
use Request;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;


class SocialController extends Controller { 
	/** * Rimanda l'utente al provider per fornire l'autorizzazione * * @param string $provider * @return mixed */ 
	public function redirectProvider( $provider = "facebook" ) { 
		return \Socialite::with( $provider )->redirect(); 
		} 
		/** * Recupera tutti i dati dell'utente * * @param string $provider * 
		 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector */ 
		 public function handleProvider( $provider = "facebook" ) { 
			 // Recuperiamo tutti i dati che ci fornisce facebook 
			 $response = \Socialite::with( $provider )->user(); 
			 //Qui controlliamo se dobbiamo creare un nuovo utente o se 
			 //ne esiste già uno con la stessa email, in questo caso 
			 //invece che crearlo andremo ad aggiornare i suoi dati 
			 $user = User::firstOrCreate([ 'email' => $response->email ]); 
			 //Impostiamo i dati dell'utente 
			 $user->name = $response->name; 
			 $user->provider_token = $response->token; 
			 //Salviamo l'utente 
			 $user->save(); 
			 //Effettuiamo il login con i dati ricevuti 
			 Auth::login($user, true);
			 return redirect()->route('home'); 
		} 		
}
	
