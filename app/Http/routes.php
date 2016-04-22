<?php

require_once "HTTP/Request2.php";

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('/', function () {
    return view('welcome');
});
Route::get('auth/provider/facebook', 'Auth\AuthController@redirectToProvider');
Route::get('auth/provider/response/facebook', 'Auth\AuthController@handleProviderCallback');
Route::get('home', array('as' => 'home', 'uses' => function(){
    
    return view('home');
}));

Route::get('apis',function(){
    return view('apis');
});

Route::post('/search-route', function(){
    
        $lat_val = (string)\Request::input('lat');
        $lon_val = (string)\Request::input('lng');
        
        
        $request = new Http_Request2("https://api.allevents.in/events/geo/?latitude=".$lat_val."&longitude=".$lon_val."&radius=40", HTTP_Request2::METHOD_POST);

        $headers = array(
        // Request headers
        'Ocp-Apim-Subscription-Key' => '15132f174c1f4481835961e2d0a596a2'
        );
        $request->setHeader($headers);

       try{
       $response = $request->send();

        }
        catch (HttpException $ex){ echo $ex; }

        return view('home')->with('response', $response->getBody());
            
        }); 

//@egeo permette di visulizzare il profilo
Route::get("/profilo",function(){
    $tmp=0;
    $user_id = Auth::user()->id;
    
    
    //@Luciano  in caso di utente che ha già richiesto una chiave developer profilo diventa developer page.
    $app_token_query = DB::select("select id, app_token from users");
    $resultArray = json_decode(json_encode($app_token_query), true);
    
    foreach($resultArray as $t) {
            if($t['id']==$user_id && $t['app_token']!='') $tmp=1;
        }
    

    if ($tmp==0){
            return view('profile'); 
    }
        
    return view('developer');
});



/* @Fede - api REST */ 

//@fede- API:Read  ritorna tutti gli eventi cercati tramite posizione(documentare)
/* Descrizione API 
*   Resource URL https://laravel-develop-app-p0f.c9users.io/events/list/lat={lat}-lon={lon}
*   Resource Information
*
*       Response formatsJSON
*       Requires authentication? No
*       Rate limited? No
*
*   Parameters
*   
*       Lat: Latitude of your position, needed for geolocation.
*       Lon: Longitude of your position, needed for geolocaiton.
*
*   Example Request
*   
*       GET
*       https://laravel-develop-app-p0f.c9users.io/events/list/lat=16-lon=15
*
*   Example Result
*
*   {\"message\":\"\",\"error\":0,\"request\":{\"page\":0,\"rows\":100},\"data\":[{\"event_id\":\"1183054415045766\",\"eventname\":\"Il fal\\u00f2 delle abilitazioni inutili\",\"thumb_url\":\"https:\\/\\/graph.facebook.com\\/1183054415045766\\/picture\",\"thumb_url_large\":\"https:\\/\\/graph.facebook.com\\/1183054415045766\\/picture?type=large\",\"start_time\":1460419200,\"start_time_display\":\"Tue Apr 12 2016 at 12:00 am\",\"end_time\":1460419200,\"end_time_display\":\"Tue Apr 12 2016 at 12:00 am\",\"location\":\"Ministero della Pubblica Istruzione\",\"venue\":"}],\"count\":100}\n"
*/

Route::get("/events/list/lat={lat}-lon={lon}", function($lat, $lon){
   
   
        
        // Accedo al token inviato dall'utente nell'header
        $events_token = getallheaders()['authorization'];
        $tmp = 0;
    
        // Controllo che la chiave sia una tra quelle fornite da noi
        $keys = DB::select('select app_token from users');
        $resultArray = json_decode(json_encode($keys), true);
        
        // resultArray è un array associativo [{app_token: '...'},{app_token: '...'},..]
        foreach($resultArray as $t) {
            if($t['app_token']==$events_token) $tmp=1;
        }
        if ($tmp==0){
            return json_encode("400: Invalid Token");
        }
        
        
        $request = new Http_Request2("https://api.allevents.in/events/geo/?latitude=".$lat."&longitude=".$lon."&radius=40", HTTP_Request2::METHOD_POST);

        $headers = array(
            // Request headers
            'Ocp-Apim-Subscription-Key' => '15132f174c1f4481835961e2d0a596a2'
        );
        $request->setHeader($headers);

        try{
            $response = $request->send();

        }
        catch (HttpException $ex){ echo $ex; }

        return Response::json($response->getBody());
});


//@Luciano Descrizione API : Partecipazione a un evento

/* Descrizione API 
*   Resource URL https://laravel-develop-app-p0f.c9users.io/events/{eventID}/attend/token={token}
*   Resource Information
*
*       Response formats JSON
*       Requires authentication? Yes
*       Rate limited? No
*
*   Parameters
*       
*       eventID: The facebook ID of the event you want to attend.
*       token: Facebook access token. This token is needed in order to have access to an user's special permissions (in this case just for responding to an event) 
*               To obtain a valid Facebook token you'll have to register your application on facebook and to request a token for user permissions (including events and rsvp)
*
*   Header
*       
*      authorize: You have specify an "Authorize" field in your request's header for EventFinder's API token. You can request your developer token in the Profile section
*
*   Example Request
*   
*       POST
*       https://laravel-develop-app-p0f.c9users.io/events/212538109113067/attend/token=CAAYGZC2QrYOoBABSMH6H3P3rccZBTtZBOV0EOJnan36qPUsjDOMrUk7i1NWHNRp0ye7icYoTI7ZCEFJvcYZBPgwHSXccQF09y8ZCvu8ZBFHgnZBLeprgnTnZADIZCsmoaLVeb7O7LZCXzinIrj6G1LMSgAFUZBF9Arutjc4CEevWkocnoOzOLiMR1yGOwGXLZBZAxjECcZD
*
*   Example Result
        
        "{\"success\":true}"
*/



//@Luciano  API:Create - conferma partecipazione a un evento
Route::post("/events/{eventID}/attend/token={token}", function($eventID, $fb_token){
    
        // Accedo al token inviato dall'utente nell'header
        $events_token = getallheaders()['authorization'];
        $tmp = 0;
    
        //@Luciano
        // Nella Post request va specificato l'header 'authorization' con la chiave fornita da noi
        
        // Controllo che la chiave sia una tra quelle fornite da noi
        $keys = DB::select('select app_token from users');
        $resultArray = json_decode(json_encode($keys), true);
        
        // resultArray è un array associativo [{app_token: '...'},{app_token: '...'},..]
        foreach($resultArray as $t) {
            if($t['app_token']==$events_token) $tmp=1;
        }
        if ($tmp==0){
            return json_encode("400: Invalid Token");
        }
        
        // Se arrivo a questo punto vuol dire che il token è valido, posso processare la richiesta.
        $request = new Http_Request2("https://graph.facebook.com/".$eventID."/attending?access_token=".$fb_token, HTTP_Request2::METHOD_POST);
        try{
            $response = $request->send();

        }
        catch (HttpException $ex){ echo $ex; }

        return Response::json($response->getBody());
        
});


//@Luciano Descrizione API : Rifiuta/Elimina partecipazione a un evento

/* Descrizione API 
*   Resource URL https://laravel-develop-app-p0f.c9users.io/events/{eventID}/decline/token={token}
*   Resource Information
*
*       Response formats JSON
*       Requires authentication? Yes
*       Rate limited? No
*
*   Parameters
*       
*       eventID: The facebook ID of the event you want to attend.
*       token: Facebook access token. This token is needed in order to have access to an user's special permissions (in this case just for responding to an event) 
*               To obtain a valid Facebook token you'll have to register your application on facebook and to request a token for user permissions (including events and rsvp)
*      
*
*   Header
*       
*      authorize: You have specify an "Authorize" field in your request's header for EventFinder's API token. You can request your developer token in the Profile section
*
*   Example Request
*   
*       POST
*       https://laravel-develop-app-p0f.c9users.io/events/212538109113067/decline/token=CAAYGZC2QrYOoBABSMH6H3P3rccZBTtZBOV0EOJnan36qPUsjDOMrUk7i1NWHNRp0ye7icYoTI7ZCEFJvcYZBPgwHSXccQF09y8ZCvu8ZBFHgnZBLeprgnTnZADIZCsmoaLVeb7O7LZCXzinIrj6G1LMSgAFUZBF9Arutjc4CEevWkocnoOzOLiMR1yGOwGXLZBZAxjECcZD
*
*   Example Result
        
        "{\"success\":true}"
*/


//@Luciano  API:Update/Delete   cancella/rifiuta partecipazione a un evento
Route::post("/events/{eventID}/decline/token={fb_token}", function($eventID, $fb_token){
    
        
        // Accedo al token inviato dall'utente nell'header
        $events_token = getallheaders()['authorization'];
        $tmp = 0;
        
        // Controllo che il token sia uno tra quelli forniti da noi
        $keys = DB::select('select app_token from users');
        $resultArray = json_decode(json_encode($keys), true);
       
        // resultArray è un array associativo [{app_token: '...'},{app_token: '...'},..]
        foreach($resultArray as $t) {
            if($t['app_token']==$events_token) $tmp=1;
        }
        if ($tmp==0){
            return json_encode("400: Invalid Token");
        }
        
        // Se arrivo a questo punto vuol dire che il token è valido, posso processare la richiesta.
        $request = new Http_Request2("https://graph.facebook.com/".$eventID."/declined?access_token=".$fb_token, HTTP_Request2::METHOD_POST);
        try{
            $response = $request->send();

        }
        catch (HttpException $ex){ echo $ex; }

        return Response::json($response->getBody());
        
});


//@Luciano Route dedicata all'assegnazione delle chiavi developers
Route::get("/profilo/email={user_email},id={user_id},key={new_key}", function($user_email, $user_id, $new_key){
    
    
        // 1) Aggiorno il valore di app_token per l'utente corrente con new_key

            
        DB::table('users')->where('id', $user_id)->update(array('app_token' => $new_key));
        
        
        // 2) Invio un'email all'utente con il nostro token
 
        $user_name = Auth::user()->name;
        
        Mail::send('emails.tokenmail',['name'=>$user_name, 'new_key'=>$new_key], function($message) use($user_email) {

                $message->subject('EventsFinder API key');
                $message->to($user_email);

            });
        
        // 3) Ritorno la view Developer
        return route('/developer');
});


Route::get("/developer/", function(){
    return view('developer');
});


/******************************  NEWSLETTER  ************************************************/

//When the queue is pushed and waiting to be marshalled, we should assign a Class to make the job done 
class SendEmail {

    public function fire($job,$data) {

        //We first get the all data from our subscribers//database
        $results = DB::select('select email from users');
        $result1=json_decode(json_encode($results), true);


        foreach ($result1 as $each) {
            

            //Now we send an email to each subscriber
            Mail::send('emails.test',['name'=>'hehe'], function($message) use($each) {

                $message->subject('Notificacion');
                $message->to($each['email']);

            });
        }

        $job->delete();
    }
}


//controller newsletter
Route::controller('subscribers', 'SubscribersController');

//This code will trigger the push request
Route::get('queue/process',function(){
    Queue::push('SendEmail');
    return 'Queue Processed Successfully!';
});

Route::post('/email/push', function()
{
    return Queue::marshal();
});

/*********************************************************************************/