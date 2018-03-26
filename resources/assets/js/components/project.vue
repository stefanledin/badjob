<template>
    <div class="card bg-secondary text-light mb-4">
        <div class="card-header d-flex justify-content-between">
            <h4 class="card-title">{{ name }}</h4>
            <button class="btn btn-sm" v-on:click="deleteMe">
                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24"><path d="M9 19c0 .552-.448 1-1 1s-1-.448-1-1v-10c0-.552.448-1 1-1s1 .448 1 1v10zm4 0c0 .552-.448 1-1 1s-1-.448-1-1v-10c0-.552.448-1 1-1s1 .448 1 1v10zm4 0c0 .552-.448 1-1 1s-1-.448-1-1v-10c0-.552.448-1 1-1s1 .448 1 1v10zm5-17v2h-20v-2h5.711c.9 0 1.631-1.099 1.631-2h5.315c0 .901.73 2 1.631 2h5.712zm-3 4v16h-14v-16h-2v18h18v-18h-2z"/></svg>
            </button>
        </div>
        <div class="card-body" v-if="entries.length > 1">
            <ul class="list-group">
                <li class="list-group-item bg-secondary d-flex justify-content-between align-items-center" v-if="entry.ended_at" v-for="entry in entries" :key="entry.id">
                    <span>{{ entry.started_at }}-{{ entry.ended_at }}</span>
                    <span>0</span>
                </li>
            </ul>
        </div>
        <div class="card-footer">

            <form action="/entries" method="POST" class="d-flex justify-content-between">
                <h4 class="card-title js-timer">00:00:00</h4>
                <!--<input type="hidden" v-model="timer_started_at">-->
                <input type="submit" v-if="! timer_running" v-on:click="continueWork" value="Fortsätt" class="btn btn-dark">
                <input type="submit" v-else v-on:click="stopTimer" value="Stopp" class="btn btn-danger">
            </form>

        </div>
    </div>
</template>

<script>
    import db from '../database';
    import axios from 'axios';
    const Timer = require('easytimer');
    const moment = require('moment');
    const collect = require('collect.js');

    export default {

        props:['project'],

        data() {
            let data = {
                timer_running: false
            };
            data = Object.assign({}, data, this.project);
            return data;
        },

        mounted() {
            this.timer = new Timer();

            const collection = collect(this.entries);
            this.currentEntry = collection.where('ended_at', null).first();
            if (this.currentEntry) {
                this.startTimer(this.currentEntry.started_at);
            }
        },

        methods: {

            stopTimer(event) {
                event.preventDefault();

                this.timer.stop();
                this.timer_running = false;

                this.currentEntry.ended_at = moment().format('Y-MM-DD H:mm:ss');

                this.createEntry();
            },

            createEntry() {
                axios.put('/entries/'+this.currentEntry.id, {
                    ended_at: this.currentEntry.ended_at
                })
                .then()
                .catch(error => console.log(error));
            },

            startTimer(startTime) {
                const h4 = this.$el.querySelector('h4.js-timer');
                const now = moment();

                this.timer.start({
                    startValues: {
                        seconds: now.diff(moment(startTime), 'seconds')
                    }
                });
                this.timer.addEventListener('secondsUpdated', function (event) {
                     h4.innerHTML = this.timer.getTimeValues().toString();
                }.bind(this));

                this.timer_running = true;
            },

            continueWork(event) {
                event.preventDefault();
                const startTime = moment().format('Y-MM-DD H:mm:ss');
                axios.post('/entries', {
                    project_id: this.id,
                    started_at: startTime
                })
                    .then((response) => {
                        if (response.data) {
                            const entry = response.data;
                            this.entries.push(entry);
                            this.currentEntry = entry;
                            this.startTimer(startTime);                            
                        }
                    })
                    .catch(error => console.log(error));
            },

            deleteMe() {
                this.$emit('deleteproject', {
                    id: this.project.id
                });
            }

        }

    }
</script>