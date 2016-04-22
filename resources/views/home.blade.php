<!DOCTYPE html>
<html>
    <head>
       <title>EventFinder - Un nuovo modo per cercare il divertimento</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <!-- @Egeo -> Inserimento bootstrap3 framework per parte grafica-->
        <!--{!! Html::style('assets/css/bootstrap.css') !!}-->
        <link media="all" type="text/css" rel="stylesheet" href="https://laravel-develop-app-p0f.c9users.io/assets/css/bootstrap.css">
        <link media="all" type="text/css" rel="stylesheet" href="https://laravel-develop-app-p0f.c9users.io/assets/css/bootstrap.min.css">

        <!-- @Egeo -> La cartella di boostrap si trova dentro public e si chiama assets -->
        <!-- @Egeo ->Inserimento google maps -->
         <style>
         #map-container {
             
             /*top:40%;
             width:100%;
             position:absolute;*/
             height: 700px ;
             
         }
	       .myInfobox {
					border: solid 1px black;
					background-color:rgba(255, 255, 255, 0.5);
					width: 280px;
					color: #000;
					font-family: Arial;
					font-size: 14px;
					padding: .5em 1em;
					border-radius: 10px;
					font-weight: bold;
					margin-left: -30px;
					margin-top: -6px
		  }
    </style>
        <!-- @egeo -> css per la ricerca 
         border: solid 1px #E4E4E4;
         border-radius: 6px;
        -->
        <style>
        
        #custom-search-input{
            text-align:center;
    padding: 3px;
   
    
    background-color: #fff;
}
.event_banner h5 {
    padding:0.5em;
    background-color: transparent;
    font-size: 1.5em;
    text-align: left;
}
#custom-search-input input{
    border: 0;
    box-shadow: none;
}

#custom-search-input button{
    margin: 2px 0 0 0;
    background: none;
    box-shadow: none;
    border: 0;
    color: #666666;
    padding: 0 8px 0 10px;
    border-left: solid 1px #ccc;
}

#custom-search-input button:hover{
    border: 0;
    box-shadow: none;
    border-left: solid 1px #ccc;
}

.infoBox{
    text-align:center;
    background-color:#ffffff;
    position:fixed;
}
.separator{
    text-align:left;
}
#box-container{
    /*
    padding-top:3em;
    
    position:fixed;/*relative;*/
    /*
    background-color:#337AB7;
    bottom:00%;
    height:35%;
    width:100%;
    color:#ffffff;
    */
    padding-top: 3em;
    position: relative;
    background: -webkit-linear-gradient(45deg, rgba(55,45,196,1) 0%, rgba(0,128,128,1) 100%); /*#333; /*#003300;*/
    bottom: 0%;
    /*margin-top: -250px;
    height: 250px;/*prova*/
    width: 100%;
    color: #ffffff;
}
.da-x-button:hover{
    cursor:pointer;
}


.da-x-button {
    border-radius: 200px 200px 200px 200px;
    -moz-border-radius: 200px 200px 200px 200px;
    -webkit-border-radius: 200px 200px 200px 200px;
    background-color: #ffffff;
    width: 30px;
    text-align: center;
    position: absolute;
    float: right;
    right: 1em;
    top: 1em;
    padding: 5px;
    height: 30px;
    color: #337AB7;
}

.img-circle{
    object-fit: cover;
    width: 100px;
    height: 100px;
    object-position: 0px 0px;
}
.event_info{
    /*width:80%;/*50%*/
    /*float:left;*/
    top:0px;
}
.pulsanti {
    text-align: center;
    margin-top:20px;
    margin-bottom:20px;
}
.event_banner{
    /*width:100%;
    float:left;*/
    
    top:0px;
}
.event_banner h5{
    text-align:center;
    border-radius: 10px 10px 10px 10px;
    -moz-border-radius: 10px 10px 10px 10px;
    -webkit-border-radius: 10px 10px 10px 10px;
    border: 3px solid #FFFFFF;
}
.event_thumb{
    /*width:20%;*/
    height:20%;
    /*float:right;*/
    
    top:0px;
}
.event_thumb img{
    width: 200px;
    height: 160px;
}
.img-responsive {
    margin: 0 auto;
}

#logo {
    float:left;
}
#search_icon {
    float:right;
    
}
.nice_text{
    font-family: cursive;
    font-style: bold ;
    text-align: left;
    text-shadow: 0.5px 0.5px #0000fa;
}
.info_text{
    font-family: fantasy;
    float:left;
    padding:20px 0 0 40px;
    
}
</style>
        
    </head>
    <body onload = "getLocation()">
        
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.1.1/js/bootstrap.min.js"></script>
   
    <script src="https://maps.google.com/maps/api/js"></script><!-- #stefano: tolgo sto "sensor" (?sensor=false) -->
    <script src="https://google-maps-utility-library-v3.googlecode.com/svn/trunk/infobox/src/infobox.js"></script>
    
             
        
        
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-6">
           	<ul class="nav nav-pills">
				<li class="active">
					<a href="https://laravel-develop-app-p0f.c9users.io/home">Home</a>
				</li>
				<li>
					<a href="https://laravel-develop-app-p0f.c9users.io/profilo">Profilo</a>
				</li>
			</ul>
          </div>
			<br>
			
			</br>
               <div class="container">
                   
	                <div class="row">
	                     <div class="col-md-6">
                               <h3 class="nice_text">Ciao {{ Auth::user()->name }} !</h3>
                             <!-- Controllo che la variabile non sia vuota perchè si valorizza solo dopo avere fatto una ricerca e quindi dopo essere andata nella route /search-route -->
                               <!-- @egeo valore inserito dentro la searchbox possiamo richiamarlo cosi -->
                               <!-- Controllo perchè prima del loggin la variabile è vuoto uso un operatore ternario per valure l'espressionee -->
                               <!-- <h2>Valore cercato: {{ !empty($valore) ? $valore : "" }}</h2> -->
                                    <?php
					                $UID =  Auth::user()->facebook_id ; //@federico-prova per pic
					                 // @egeo commentato echo "<h4>Your user ID is ".$UID."</h4>" ;
					                $profile_pic = "https://graph.facebook.com/".$UID."/picture?type=large";
                                    echo "<img src=\"" . $profile_pic . "\" class=\"img-circle\"   />" ; //width=\"130px\"
					                ?>
                </div>
    
        <div class="col-md-6 ">
            <div>
            <img src="https://scontent-mxp1-1.xx.fbcdn.net/hphotos-xfa1/t39.2081-0/p128x128/12765856_1730907213819191_22741148_n.png" id="logo" alt="Logo" style="width:128px;height:128px;">
    		<br>
    		<br>
    		<h4 class="nice_text">Un nuovo modo per cercare il Divertimento!</h4>
    		</div>
    		<br>
                <div id="custom-search-input">
              <form method="post" action="https://laravel-develop-app-p0f.c9users.io/search-route" name="f">
                        <div >
                            <!--label for="search">Visualizza gli eventi vicini a te!</label-->
                            
                            
                            <!--<input type="text" class="form-control input-lg" placeholder="Visualizza gli eventi vicini a te" name="value"/>-->
                                <span >
                                    <!-- #stefano passo i valori della mia latitudine e longitudine che setto tramite js-->
                                    <!--  <input type="hidden" id="state_ev" name="state" value=""/> -->
                                    <!--  <input type="hidden" id="city_ev" name="city" value=""/>  -->
                                    <input type="hidden" id="lng_input" name="lng" value=""/>
                                    <input type="hidden" id="lat_input" name="lat" value=""/>
                                    <input type="hidden"  name="_token" value="{{ csrf_token() }}"/>
                                    <!-- getlocation prende in considerazione la mia latitudine e longitudine -->
                                        <!-- <button type="submit" id="search" class="btn btn-info btn-lg"><span class="glyphicon glyphicon-search"></span></span></button> -->
                                        <p class="info_text">Visualizza eventi nelle vicinanze</p>
                                        <button type="submit" id="search" class="btn btn-primary">
                                        <img src="http://icons.iconarchive.com/icons/alecive/flatwoken/512/Apps-Search-icon.png" id="search_icon" alt="Cerca" style="width:64px;height:64px;">
                                        </button>
                                        <!--<button  type="submit" class="btn btn-info btn-lg" type="button" placeholder="Nome evento"> <i class="glyphicon glyphicon-search"></i>-->
             </form>
                             </button>
                    </span>
                </div>
            </div>
        </div>
	</div>
</div>
               
    <br>
               
 
<script type="text/javascript">

    
    
    
    
    var flist;
    var evid;
    var var_map;
    var marker;
    
	function initialize(lat,lng) {

            var var_location = new google.maps.LatLng(lat,lng);
            var location_json = {lat:lat, lng:lng};

           
            var var_mapoptions = {
                scrollwheel: false,
                draggable: true,
			    zoom: 14,
			    center: location_json,/* #stefano: provo a passargli un json con le due variabili lat e lng*/
			    mapTypeId: google.maps.MapTypeId.ROADMAP
		    };
            var_map = new google.maps.Map(document.getElementById('map-container'), var_mapoptions);
		
		    var box_container = document.getElementById('box-container');
		    
		    marker = new google.maps.Marker({
		        title: "Tu sei qui!",
			    map: var_map,
			    draggable: false,
			    position: location_json,
			    visible: true
		    });


	     //Faccio un decoding del json e lo faccio diventare un array associativo multidimensionale
         //Utilizziamo JSON.parse dato che è javascript
         
         var l=jQuery.parseJSON(
            JSON.stringify(
                <?php if (isset($response)) echo $response; else echo "" ;?>));
         //Fede- prova
         var id='<?php echo Auth::user()->facebook_id; ?>';
         var i;
         for(i=0; i < 100; i++){
        //@fede - cicla tutti gli eventi e mette il relativo marker nella mappa
                    
                    
                    var str=l.data[i].eventname;
		            var var_location1 = { lat:l.data[i].venue.latitude, lng: l.data[i].venue.longitude};
                    var image = l.data[i].thumb_url_large;
                    
                    var link="https://www.facebook.com/events/"+l.data[i].event_id;

                    var marker1 = new google.maps.Marker({
		                title: str,
			            map: var_map,
			            position: var_location1,
			            visible: true
		            });

                  

                    //Costruisco la Stringa che costituisce l'Html del box di descrizione degli eventi
                    //Contiene : Nome evento, indirizzo, immagine, bottoni: Visualizza su Fb, Partecipa, Rifiuta, Partecipanti(di cui amici)
                    
                    var cString =
                    '<div id="box_content" class="row">'+
                    '<div class="col-md-12 event_banner">'+
                    '<h5>'+str+'</h5>'+
                    '</div><br>'+
                    '<div class="col-md-6 event_info">'+
                    '<h5>Indirizzo: '+l.data[i].venue.full_address+'</h5>'+
                    '<h5>Data: '+l.data[i].start_time_display+'</h5>'+
                    '<h5 class="partecipanti"></h5>'+
                    '<br><br>'+
                    '</div>'+
                    '<div class="col-md-6 "><img src= '+image+' class=img-responsive center-block" /></div>'+ //@stefano sto facendo il box-container responsive per mobile ed ho rimosso .event_thumb
                    '<div class="event_info pulsanti col-md-12" method="POST">'+
                    '<a href=' + link + ' class="btn btn-primary" target="_blank">Visualizza Evento</a>'+
                    '<a onclick="attend('+l.data[i].event_id+')" class="btn btn-success" >Partecipa</a>'+
                    '<a onclick="decline('+l.data[i].event_id+')" class="btn btn-danger"  >Rifiuta</a>'+
                    '<a onclick="nFriends('+id+','+l.data[i].event_id+')" class="btn btn-info"  >Partecipanti</a>'+
                    '</div>'+
                    '</div>'+
                    '<div class="popup">'+
                    '</div><div onclick="closeBox()" class="da-x-button">X</div>';
                 
                    //@fede- funzione che aggiunge l'evento al listener
                    attachMessage(marker1, cString,l.data[i].event_id,id);
           // }
                
        //qui finisce il for
        
         }
	};
	
	
	//Luciano Funzioni per partecipare/non partecipare a un evento
    function attend(eventID) {
        var token='<?php echo Auth::user()->provider_token; ?>';
        var link="https://graph.facebook.com/"+eventID+"/attending?access_token="+token;
        var resp=jQuery.parseJSON($.ajax({
                        type    :"POST",
                        url     :link,
                        async   :false
                    }).responseText);
        alert("Partecipazione Confermata");
        
    };
    
    function decline(eventID) {
        var token='<?php echo Auth::user()->provider_token; ?>';
        var link="https://graph.facebook.com/"+eventID+"/declined?access_token="+token;
        var resp=jQuery.parseJSON($.ajax({
                        type    :"POST",
                        url     :link,
                        async   :false
                    }).responseText);
        alert("Partecipazione Cancellata");
    };
    
    //@Luciano  Funzione per il numero di partecipanti a un evento
    function count(eventID){
        var token='<?php echo Auth::user()->provider_token; ?>';
        var link= 'https://graph.facebook.com/v2.5/'+eventID+'?fields=attending.summary(true).limit(1)&access_token='+token;
        var resp = jQuery.parseJSON($.ajax({
                type : "GET",
                url : link,
                async : false
                
        }).responseText);
        var number= resp.attending.summary.count;
        $('.partecipanti').html(''+number);
    }


    function showErrors(error){ //#stefano
        /* Quì abbiamo quattro casistiche di errore per la geolocalizzazione sul mobile
        UNKNOWN_ERROR (code 0)
        PERMISSION_DENIED (code 1)
        POSITION_UNAVAILABLE (code 2)
        TIMEOUT (code 3)
        */
        //alert(error.code);
        console.log(error.code);
        switch(error.code){
            case 0:
                alert("Errore sconosciuto, non è stato possibile ottenere la geolocalizzazione!");
                break;
            case 1:
                alert("Errore 1, negato l'accesso alla geolocalizzazione," 
                +"assicurati che il browser che utilizzi abbia i permessi necessari "
                +"per ottenere i dati GPS!");
                break;
            case 2:
                alert("Errore 2, spiacenti, posizione non disponibile!");
                break;
            case 3:
                alert("Errore 3, timeout di connessione!");
                break;
        }
    };

  
    function getLocation() { //#stefano, questa è la funzione che dal navigator e chiama initialize(lat,lon) passandogli le coordinate appunto
        if(navigator.geolocation){
            
        navigator.geolocation.getCurrentPosition(function(position){
           
            var var_map;
            var var_location;
	        //#egeo dobbiamo mettere la autolocalizzazione dell'utente come latitudine e longitudine
	        
            var pos_json = {
                lat:position.coords.latitude,
                lon:position.coords.longitude
            };
            var lat = pos_json.lat;
            var lon = pos_json.lon;
            console.log(lat,lon)
            document.getElementById('lat_input').value = lat;
            document.getElementById('lng_input').value = lon;
            
            
            //@Luciano  gestione dell'errore in caso ci troviamo in /home;
            try {
                initialize(lat,lon);
            }
            catch(SyntaxError){
                console.log('Event List is Empty');
            }
        }
        ,showErrors,{maximumAge: 600000, timeout:10000,enableHighAccuracy: true}); 
        /*    ^            ^
              |__        __|
                 #stefano 
        questi altri parametri di getCurrentPosition 
        servono ad avere degli errori e a settare i 
        parametri di connessione gps dello smartphone
        */
    }else{
            alert('La geo-localizzazione NON è possibile');
        }
    };
    
    
    //Funzione che inizializza la chiamata alla google maps dove viene parsato in JSON la request 
    //in http di all events

	
	
	function attachMessage(marker, secretMessage,event_ID_attach,user_ID_attach) {
	    var box_container2 = document.getElementById('box-container');
	    var map_container = document.getElementById('map-container');
	    var BoxOptions2 = {
            	boxStyle: {
            		        
            width:"100%",
            height:"300px"
            },
            content: secretMessage
        };
        //var map_html = map_container.innerHTML;
        
	    var var_infobox2 = new InfoBox(BoxOptions2);
	    
        marker.addListener('click', function () {
            $('#box-container').slideUp();
            var_infobox2.open(box_container2, marker); //la prima variabile era "var_map", ma noi lo vogliamo fuori dalla mappa
            var_infobox2.setVisible(true);
            //map_container.style.display = 'none';
            box_container2.innerHTML = var_infobox2.getContent();
            //var info_partecipanti2 = $('#box-container').find('a.btn.btn-info.partecipanti');
            //var info_partecipanti2 = $('#box-container').find('h5.nfriends');
            $('#box-container').blur();
            //info_partecipanti2.html(nFriends(user_ID_attach,event_ID_attach)); //onclick="nFriends('+id+','+l.data[i].event_id+')"
            //box_container2.style.display = 'block';
            $('#box-container').slideDown();
            //infowindow.open(var_map, marker); //Ho sostituito la vecchia variabile var_infobox alla nuova infowindow
        });
        
	};


	function closeBox(){
	        var map_container = document.getElementById('map-container');
            var box_container3 = document.getElementById('box-container');
            //box_container3.style.display= 'none';
            $('#box-container').slideUp();
            //map_container.style.display = 'block';
        };
        
  
        
//fede- presi la lista amici e la lista partecipanti, merga per trovare il numero di amici partecipanti all'evento

    function nFriends(user_id_nfriend,event_id_nfriend){ //prima prendeva friendList, attendingList
        
        //@Fede - prova n amici
		            var token='<?php echo Auth::user()->provider_token; ?>';
            		            
                     var fList=jQuery.parseJSON($.ajax({
                            type    :"GET",
                            url     :"https://graph.facebook.com/v2.5/me"+/*+user_id_nfriend+*/"?fields=friendlists&access_token="+token,
                            async   :false,
                    }).responseText);
                    console.log(token);
		            var evId=jQuery.parseJSON($.ajax({
                        type    :"GET",
                        url     :"https://graph.facebook.com/v2.5/"+event_id_nfriend+"/attending?access_token="+token,
                        async   :false,
                    }).responseText);
		            
		if(!fList.friendlists){
		    $('.partecipanti').html("L'applicazione non dispone dei permessi necessari per accedere alla tua lista amici. ");
		    return;
		}
        var j, f;
		var count=0;
		if(evId.length!=0){
		    for(f=0; f<evId.data.length; f++) {
		            //console.log(evId.data[0])
		        for(j=0; j<fList.friendlists.data.length; j++) {
		           
		            if(evId.data[f]==fList.friendlists.data[j]) count++;
		    }
		}
		$('.partecipanti').html('partecipanti: '+evId.data.length+' ('+count+' amici in comune)');
    };
    }
    
</script>               
               
               <!-- Luciano   fine modifica -->
               
        <!-- @Egeo Mappa di google maps, bisogna localizzare-->  
        <!-- @Egeo prima della mappa di google maps otteniamo la posizione, la cui funzione richiama "initialize()" -->    
                <div id="box-container" class="col-md-12" style="display:none">
                    <!--div id="box_content"></div>
                    <div class="da-x-button"></div-->
                </div>
                <div id="map-container" class="col-md-12"></div><!---->
                <!-- #Stefano Questo cerco di inserirlo nel map-container tramite js-->
                
                  </div> <!-- /body -->
  
  </div>
</div> 
        
     
    
    
    
    <!-- @EGEO funzione javascript per la mappa -->
    
       		
</div>
	</div>
</div>
</div>
</div>
</div>
      
					 
        <!-- @Egeo -> Inserimento bootstrap3 framework per parte grafica-->
        <!--{!! Html::script('assets/js/bootstrap.min.js') !!}-->
         <!-- @Egeo -> La cartella di boostrap si trova dentro public e si chiama assets -->
    </body>
</html>
