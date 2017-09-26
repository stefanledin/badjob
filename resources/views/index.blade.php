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

                    <form action="/" method="POST">
                        {{ csrf_field() }}
                        <div class="card bg-secondary text-light mb-4">
                            <div class="card-header">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="working_with" placeholder="Vad ska du jobba med?">
                                    <span class="input-group-btn">
                                        <button class="btn btn-dark" type="submit">Börja!</button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </form>

                    @if (count($entries)) @foreach ($entries as $entry)
                        <form action="">
                            <div class="card bg-secondary text-light mb-4">
                                <div class="card-header">
                                    <h4 class="card-title float-left">{{ $entry->started_at }}</h4>
                                    <button class="btn btn-danger float-right">Stopp</button>
                                </div>
                                <div class="card-body">
                                    <h4 class="card-title">{{ $entry->working_with }}</h4>
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                            <button disabled="disabled" class="btn btn-dark border-dark" type="button">-0,25</button>
                                        </span>
                                        <input type="number" disabled="disabled" class="form-control text-center border-dark" value="{{ $entry->duration }}">
                                        <span class="input-group-btn">
                                            <button disabled="disabled" class="btn btn-dark border-dark" type="button">+0,25</button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </form>
                    @endforeach @endif

                </div>
                <div class="col col-sm-6">

                </div>
            </div>
        </div>


        <script src="{{ mix('/js/app.js') }}"></script>
    </body>
</html>