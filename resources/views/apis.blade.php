<!DOCTYPE html>
<html>
    <head>
        <title>Api documentation</title>
        <!--{!! Html::style('assets/css/bootstrap.css') !!}-->
        <link media="all" type="text/css" rel="stylesheet" href="https://laravel-develop-app-p0f.c9users.io/assets/css/bootstrap.css">
        <link media="all" type="text/css" rel="stylesheet" href="https://laravel-develop-app-p0f.c9users.io/assets/css/bootstrap.min.css">
        <!--link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css"-->

        <style>
            html, body {
            }

            body {
                color:#000000;
                margin: 0;
                padding: 0;
                width: 100%;
                display: table;
                font-weight: 100;
                font-family: 'Arial';
            }

            .container-fluid {
                color:#000000;
                text-align: center;
                display: table-cell;
                vertical-align: middle;
                background:-webkit-linear-gradient(45deg, rgba(55,45,196,1) 0%, rgba(0,128,128,1) 100%);

            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 10em;/*96px;*/
                color: #FFF;
            }
            
            .btn {
              display: inline-block;
              padding: 6px 12px;
              margin-bottom: 0;
              font-size: 14px;
              font-weight: normal;
              line-height: 1.42857143;
              text-align: center;
              white-space: nowrap;
              vertical-align: middle;
              -ms-touch-action: manipulation;
                  touch-action: manipulation;
              cursor: pointer;
              -webkit-user-select: none;
                 -moz-user-select: none;
                  -ms-user-select: none;
                      user-select: none;
              background-image: none;
              border: 1px solid transparent;
              border-radius: 4px;
              text-decoration: none;
            }
            .btn-primary {
                  color: #fff;
                  background-color: #337ab7;
                  border-color: #2e6da4;
            }
            .btn-danger {
              color: #fff;
              background-color: #d9534f;
              border-color: #d43f3a;
            }
            .single_api{
                color:black;
            }
        </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.1.1/js/bootstrap.min.js"></script>
   
    </head>
    <body>
        <div class="container-fluid">
            <div class="row">
                <div style="color:#000000" class="content col-md-12">
                    <!--div class="title">EventFinder</div-->
                    

<div style="text-align:left;padding:1em;background-color:#F2F2F2;margin-top:3%" class="single_api">
        <h2>API:Update/Delete - delete/deny partecipation</h2>
        Resource URL https://laravel-develop-app-p0f.c9users.io/events/{eventID}/decline/token={token}<br>
        Resource Information<br>
        Response formats JSON<br>
        Requires authentication? Yes<br>
        Rate limited? No<br>
        Parameters<br>
        eventID: The facebook ID of the event you want to attend.<br>
        token: Facebook access token. This token is needed in order to have access to an user's special permissions (in this case just for responding to an event) 
               To obtain a valid Facebook token you'll have to register your application on facebook and to request a token for user permissions (including events and rsvp)<br>
        Header<br>
        authorize: You have specify an "Authorize" field in your request's header for EventFinder's API token. You can request your developer token in the Profile section<br>
        Example Request<br>
        <code>POST https://laravel-develop-app-p0f.c9users.io/events/212538109113067/decline/token={token}</code><br>
       Example Result<br>
       <code>"{\"success\":true}"</code><br>
</div>
<div style="text-align:left;padding:1em;background-color:#F2F2F2" class="single_api">
        <h2>API:Create - confirm partecipation</h2>
        Resource URL https://laravel-develop-app-p0f.c9users.io/events/{eventID}/attend/token={token}<br>
        Resource Information<br>
        Response formats JSON<br>
        Requires authentication? Yes<br>
        Rate limited? No<br>
        Parameters<br>
        eventID: The facebook ID of the event you want to attend.<br>
        token: Facebook access token. This token is needed in order to have access to an user's special permissions (in this case just for responding to an event) 
               To obtain a valid Facebook token you'll have to register your application on facebook and to request a token for user permissions (including events and rsvp)<br>
        Header<br>
        authorize: You have specify an "Authorize" field in your request's header for EventFinder's API token. You can request your developer token in the Profile section<br>
        Example Request<br>
        <code>POST https://laravel-develop-app-p0f.c9users.io/events/212538109113067/attend/token=xxxxx</code><br>
        Example Result<br>
        <code>"{\"success\":true}"</code><br>
</div>
<div style="text-align:left;padding:1em;background-color:#F2F2F2;margin-bottom:3%" class="single_api">
        <h2>API:Read  Returns all searched events passing latitude and longitude</h2>
        Resource URL https://laravel-develop-app-p0f.c9users.io/events/list/lat={lat}-lon={lon}<br>
        Resource Information<br>
        Response formats: JSON<br>
        Requires authentication? No<br>
        Rate limited? No<br>
        Parameters<br>
        Lat: Latitude of your position, needed for geolocation.<br>
        Lon: Longitude of your position, needed for geolocaiton.<br>
        Example Request<br>
        <code>GET https://laravel-develop-app-p0f.c9users.io/events/list/lat=16-lon=15</code><br>
        Example Result<br>
        <code>{message:"message",error:0,request:{page:0,rows:100},data:<br>[{event_id:1183054415045766,<br>eventname:"Il fal\\u00f2 delle abilitazioni inutili",<br>thumb_url:https://graph.facebook.com/1183054415045766/picture,<br>thumb_url_large:https://graph.facebook.com/1183054415045766/picture?type=large,<br>start_time:1460419200,<br>start_time_display:Tue Apr 12 2016 at 12:00 am,<br>end_time:1460419200,<br>end_time_display:Tue Apr 12 2016 at 12:00 am,<br>location:Ministero della Pubblica Istruzione,<br>venue:"venue"}],count:100}</code><br>
</div>
     </body>
</html>
