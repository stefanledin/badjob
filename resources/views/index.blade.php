<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title></title>
        <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
    </head>
    <body>

        <div class="container">
            <div class="row">
                <div class="col col-sm-6">
                    
                    <div class="card bg-secondary text-light">
                        <div class="card-header">Tidsrapport</div>
                        <div class="card-body">
                            <h4 class="card-title">Projektnamn</h4>
                            <button class="btn btn-dark">Börja jobba</button>
                            <button class="btn btn-light">Lägg till tid</button>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>


        <script src="{{ mix('/js/app.js') }}"></script>
    </body>
</html>