<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <!--meta name="csrf-token" content="{{{ Session::token() }}}"-->
    <meta name="csrf_token" content="{{csrf_token()}}">
    <link media="all" type="text/css" rel="stylesheet" href="https://laravel-develop-app-p0f.c9users.io/assets/css/bootstrap.css">
    <link media="all" type="text/css" rel="stylesheet" href="https://laravel-develop-app-p0f.c9users.io/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.css">
    <title>Profilo - EventsFinder</title>
    <!-- BOOTSTRAP STYLE SHEET -->

<link href="assets/css/bootstrap.css" rel="stylesheet" />

 <!-- CUSTOM STYLE CSS -->
<style type="text/css">
        .img-circle{
        object-fit: cover;
        width: 100px;
        height: 100px;
        object-position: 0px 0px;
    }
       .btn-social {
            color: white;
            opacity: 0.8;
        }

        .btn-social:hover {
            color: white;
            opacity: 1;
            text-decoration: none;
        }

        .btn-facebook {
            background-color: #3b5998;
        }

        .btn-twitter {
            background-color: #00aced;
        }

        .btn-linkedin {
            background-color: #0e76a8;
        }

        .btn-google {
            background-color: #c32f10;
        }
</style>

<script data-rocketsrc="https://www.designbootstrap.com/track/ga.js"  type="text/rocketscript"></script>

</head>
<body>
      
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-6">
           	<ul class="nav nav-pills">
				<li>
					<a href="https://laravel-develop-app-p0f.c9users.io/home">Home</a>
				</li>
				<li class="active">
					<a href="https://laravel-develop-app-p0f.c9users.io/profilo">Profilo</a>
				</li>
				
			</ul>
          </div>
			<br>
			
			</br>
    <!-- NAVBAR CODE END -->


    <div class="container">
        <section style="padding-bottom: 50px; padding-top: 50px;">
            <div class="row">
                
                <div class="col-md-12">
                    
                    <div class="alert alert-info">
                        <?php
			                $UID =  Auth::user()->facebook_id ; //@federico-prova per pic
			               
			                $profile_pic = "https://graph.facebook.com/".$UID."/picture?type=large";
                            echo "<img src=\"" . $profile_pic . "\" class=\"img-circle\"/>" ;//img-rounded img-responsive
		                ?>
                        <h2>Benvenuto {{Auth::user()->name}} </h2>
                        <h4>Puoi utilizzare il nostro servizio nella tua applicazione/sito richiedendo una chiave Developer. </h4>
                        <h3>Inizia subito!</h3>
                        <a onclick="key_request()" class="btn btn-default" >Developer</a>
                    </div>
                  
                   
                </div>
            </div>
            <!-- ROW END -->


        </section>
        <!-- SECTION END -->
    </div>
    <!-- CONATINER END -->




<!-- db-footer-one-728-90 -->
<ins class="adsbygoogle"
     style="display:inline-block;width:728px;height:90px"
     data-ad-client="ca-pub-2936243881134126"
     data-ad-slot="5253257896"></ins>
<script type="text/rocketscript">
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>


<script type="text/javascript">
    
    //@Luciano  Richiesta developer key
    function key_request(){
        
        // Controllo che il valore della chiave sia Null
        var user_id = '<?php echo Auth::user()->id; ?>';
        var user_email = '<?php echo Auth::user()->email; ?>';
        var a_key='<?php echo Auth::user()->app_token; ?>';
        
        // Genero una chiave Random e la converto in stringa
        var new_key= Math.floor(Math.random() * 6000000000) + 100000000  
        new_key=new_key.toString();
        
        
        // Se user()->app_token = null eseguo l'Update
        console.log(a_key);
        if(a_key!=''){
            alert("You've already got an API key, check your email!");
        }else{
           
            alert('Registrazione effettuata! Il tuo token è: '+new_key);
            
            var link="https://laravel-develop-app-p0f.c9users.io/profilo/email="+user_email+",id="+user_id+",key="+new_key;
            $.ajax({
                        type    :"get",
                        url     :link,
                        async   :true,
            });
            window.location.reload();
                    
        }
    }
    
</script>
   
</center>
                        </div>
                    </div>
                   
                </div>
            </div>
        </div>
    </div>
    <!-- GOOGLE ADD SECTION END -->


    <!-- REQUIRED SCRIPTS FILES -->
    <!-- CORE JQUERY FILE -->
    <script data-rocketsrc="assets/js/jquery-1.11.1.js" type="text/rocketscript"></script>
    <!-- REQUIRED BOOTSTRAP SCRIPTS -->
    <script data-rocketsrc="assets/js/bootstrap.js" type="text/rocketscript"></script>
</body>

</html>