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
                            <h4 class="card-title float-left">0 h 14 min 15 sek</h4>
                            <button class="btn btn-danger float-right">Stopp</button>
                        </div>
                        <div class="card-body">
                            <h4 class="card-title">Beskrivning</h4>
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <button disabled="disabled" class="btn btn-dark border-dark" type="button">-0,25</button>
                                </span>
                                <input type="number" class="form-control text-center border-dark" value="1.25">
                                <span class="input-group-btn">
                                    <button disabled="disabled" class="btn btn-dark border-dark" type="button">+0,25</button>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="card bg-secondary text-light mb-4">
                        <div class="card-header">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Vad ska du jobba med?">
                                <span class="input-group-btn">
                                    <button class="btn btn-dark" type="button">Börja!</button>
                                </span>
                            </div>
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


                    <div class="card bg-secondary text-light mb-4">
                        <div class="card-header">Jobbnummer</div>
                        <div class="card-body">
                            <ul class="list-group text-dark">
                                <li class="list-group-item">
                                    Beskrivning
                                    <span class="badge badge-secondary badge-pill">2,25</span>
                                    <div class="btn-group btn-group-sm float-right">
                                        <button class="btn bg-secondary text-light">-0,25</button>
                                        <button class="btn bg-dark text-light">+0,25</button>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-dark">Börja jobba</button>
                        </div>
                    </div>
                    
                    <div class="card bg-secondary text-light">
                        <div class="card-header">Nobeli intranät</div>
                        <div class="card-body">
                            <ul class="list-group text-dark">
                                <li class="list-group-item">
                                    Bakgrundsbild
                                    <div class="btn-group btn-group-sm float-right">
                                        <button class="btn btn-secondary">-0,25</button>
                                        <button class="btn btn-secondary">+0,25</button>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    Kalender
                                    <div class="btn-group float-right">
                                        <button class="btn">plask</button>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-dark">Börja jobba</button>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>


        <script src="{{ mix('/js/app.js') }}"></script>
    </body>
</html>