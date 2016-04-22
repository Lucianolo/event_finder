<!DOCTYPE html>
<html>
    <head>
        <title>EventFinder</title>
        <!--{!! Html::style('assets/css/bootstrap.css') !!}-->
        <link media="all" type="text/css" rel="stylesheet" href="https://laravel-develop-app-p0f.c9users.io/assets/css/bootstrap.css">
        <link media="all" type="text/css" rel="stylesheet" href="https://laravel-develop-app-p0f.c9users.io/assets/css/bootstrap.min.css">
        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                display: table;
                font-weight: 100;
                font-family: 'Lato';
            }

            .container-fluid {
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
        </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.1.1/js/bootstrap.min.js"></script>
   
    </head>
    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="content col-md-12">
                    <div class="title">EventFinder</div>
				    <a href="auth/provider/facebook" class="btn btn-danger" > Login with Facebook! </a>
                </div>
            </div>
        </div>
    
    
    <!--{!! Html::script('assets/js/bootstrap.min.js') !!}-->
    
     </body>
</html>
