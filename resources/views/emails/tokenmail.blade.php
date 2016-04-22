 <!DOCTYPE html>
       <html lang="en-US">
         <head>
           <meta charset="utf-8">
         </head>
         <body>
           <h2>Hello Developer!</h2>
           
           <div>
               <h4>
                   Hello {{$name}}, this is your API key:
               </h4>
               <h3>Token : {{$new_key}}.</h3>
               <br>
               <h4>Use it as Authorization header for your API requests.</h4>
            </div>
         </body>
       </html>