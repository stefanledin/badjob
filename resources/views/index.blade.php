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
                                <form v-on:submit="createProject">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="working_with" placeholder="Vad ska du jobba med?" v-model="start_working_on">
                                        <span class="input-group-btn">
                                            <button class="btn btn-dark" type="submit">Börja!</button>
                                        </span>
                                    </div>
                                </form>
                            </div>
                        </div>
                        
                        <project v-for="project in projects" v-bind:project="project" v-bind:key="project.id" v-on:deleteproject="deleteProjectOnServer"></project>
                    </div>

                </div>
            </div>
        </div>

        <script src="{{ mix('/js/app.js') }}"></script>
    </body>
</html>