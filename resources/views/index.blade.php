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
                <div class="col col-sm-8 ml-sm-auto mr-sm-auto">

                    <form action="{{ route('start') }}" method="POST">
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
                        
                        <div id="entry-{{ $entry->id }}" class="entry-wrapper">
                            @if ($entry->ended_at)
                                <form action="{{ route('resume', ['id' => $entry->id]) }}" method="POST">
                                    {{ csrf_field() }}
                                    <div class="card bg-secondary text-light mb-4">
                                        <div class="card-header">
                                            <h4 class="card-title float-left js-time-spent">{{ $entry->timeSpent() }}</h4>
                                            <button class="btn btn-dark float-right js-start-timer">Fortsätt</button>
                                        </div>
                                        @include('entry/card-body')
                                    </div>
                                </form>
                            @else
                                <form action="{{ route('stop', ['id' => $entry->id]) }}" method="POST">
                                    {{ csrf_field() }}
                                    <div class="card bg-secondary text-light mb-4">
                                        <div class="card-header">
                                            <h4 class="card-title float-left">{{ $entry->timeSpent() }}</h4>
                                            <button class="btn btn-danger float-right">Stopp</button>
                                        </div>
                                        @include('entry/card-body')
                                    </div>
                                </form>
                            @endif
                        </div>

                    @endforeach @endif
                </div>
            </div>
        </div>

        <script src="{{ mix('/js/app.js') }}"></script>
    </body>
</html>