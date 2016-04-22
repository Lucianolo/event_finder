<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap-table.css">
    
    {!! Html::style('assets/css/bootstrap.css') !!}
    
    </head>
    <body>
        
    <div class="container">

        <!-- table -->
        <table class='table' data-url="data.json" data-height="299">
        <thead>
        <tr>
            <th data-field="nome" data-align="center" data-sortable="true">nome</th>
            <th data-field="luogo" data-align="center" data-sortable="true">luogo</th>
            <th data-field="data" data-align="center" data-sortable="true">data</th>
        </tr>
        </thead>
        </table>
    
    </div>
    
    </body>
    
    
    
</html>