<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ $title }}</title>
        <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
    </head>
    <body>

        <div class="container">
            <div class="row">
                <div class="col col-sm-6">

                    <div class="card bg-secondary text-light mb-4">
                        <div class="card-header">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Vad ska du jobba med?">
                                <span class="input-group-btn">
                                    <button class="btn btn-dark" type="button">Börja!</button>
                                </span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card bg-secondary text-light mb-4">
                        <div class="card-header">
                            <h4 class="card-title float-left">1 h 14 min 15 sek</h4>
                            <button class="btn btn-danger float-right">Stopp</button>
                        </div>
                        <div class="card-body">
                            <h4 class="card-title">Beskrivning</h4>
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <button disabled="disabled" class="btn btn-dark border-dark" type="button">-0,25</button>
                                </span>
                                <input type="number" disabled="disabled" class="form-control text-center border-dark" value="1.25">
                                <span class="input-group-btn">
                                    <button disabled="disabled" class="btn btn-dark border-dark" type="button">+0,25</button>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="card bg-secondary text-light mb-4">
                        <div class="card-header">
                            <h4 class="card-title float-left">1 h 14 min 15 sek</h4>
                            <button class="btn btn-dark float-right">Fortsätt</button>
                        </div>
                        <div class="card-body">
                            <h4 class="card-title">Beskrivning</h4>
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <button class="btn btn-dark border-dark" type="button">-0,25</button>
                                </span>
                                <input type="number" class="form-control text-center border-dark" value="1.25">
                                <span class="input-group-btn">
                                    <button class="btn btn-dark border-dark" type="button">+0,25</button>
                                </span>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col col-sm-6">

                </div>
            </div>
        </div>


        <script src="{{ mix('/js/app.js') }}"></script>
    </body>
</html>