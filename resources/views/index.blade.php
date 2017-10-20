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
                <div class="col col-sm-10 col-md-8 ml-sm-auto mr-sm-auto">

                    <div id="app">
                        <div class="card bg-secondary text-light mb-4" v-if="! working">
                            <div class="card-header">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="working_with" placeholder="Vad ska du jobba med?" v-model="start_working_on">
                                    <span class="input-group-btn">
                                        <button class="btn btn-dark" type="submit" v-on:click="startWorking">Börja!</button>
                                    </span>
                                </div>
                            </div>
                        </div>
                        
                        <entry v-for="entry in entries" v-bind:entry="entry" v-bind:key="entry.id"></entry>
                    </div>

                </div>
            </div>
        </div>

        <script src="{{ mix('/js/app.js') }}"></script>
    </body>
</html>