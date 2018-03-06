<template>
    <div class="card bg-secondary text-light mb-4">
        <div class="card-header">
            <h4 class="card-title">{{ name }}</h4>
        </div>
        <div class="card-body" v-if="entries.length">
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
                <input type="hidden" :value="id">
                <!--<input type="hidden" v-model="timer_started_at">-->
                <input type="submit" v-if="! timer_running" v-on:click="continueWork" value="Fortsätt" class="btn btn-dark">
                <input type="submit" v-else v-on:click="stopTimer" value="Stopp" class="btn btn-danger">
            </form>
            
            <!--
            <button class="btn btn-danger float-right" v-on:click="stop">Stopp</button>
            -->

            <!--
            <div class="input-group">
                <span class="input-group-btn">
                    <button class="btn btn-dark border-dark" type="button" v-on:click="decrease">-0,25</button>
                </span>
                <input type="number" class="form-control text-center border-dark" :value="duration">
                <span class="input-group-btn">
                    <button class="btn btn-dark border-dark" type="button" v-on:click="increase">+0,25</button>
                </span>
            </div>
            -->

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
<<<<<<< HEAD
            /*
            const getEntries = async function (entryId) {
                return await db.entry.get(entryId);
            }
            this.project.entries = this.project.entries.map(entryId => {
                
            });
            console.log(this.project.entries);
            */
            let data = {
                timer_running: false
            };
=======
            let data = {};
>>>>>>> c0742f64854691a2333ae5348f52d93646631c4c
            data = Object.assign({}, data, this.project);
            return data;
        },

        mounted() {
            this.timer = new Timer();
<<<<<<< HEAD
            if (this.timer_running) return;

            const collection = collect(this.entries);
            this.currentEntry = collection.where('ended_at', null).first();
            this.startTimer(this.currentEntry.started_at);
=======
            if (!this.timer_running) return;

            //const collection = collect(entries);
            //this.currentEntry = collection.where('ended_at', '').first();

            //this.startTimer(this.currentEntry.started_at);
>>>>>>> c0742f64854691a2333ae5348f52d93646631c4c
        },

        methods: {
            
            /*async getEntries() {
                const entries =  await Promise.all(this.project.entries.map(async function (entryID) {
                    const entry = await db.entry.get(entryID);
                    return entry;
                }));
                console.log('entries', entries);
                this.entries = entries;                
            },*/

            async stopTimer(event) {
                event.preventDefault();

                this.timer.stop();
                this.timer_running = false;

                const ended_at = moment().format('Y-MM-DD H:mm:ss');
                this.currentEntry.ended_at = ended_at;
<<<<<<< HEAD
                /*
=======
                
>>>>>>> c0742f64854691a2333ae5348f52d93646631c4c
                const currentEntry = await db.entry.update(this.currentEntry.id, {
                    ended_at
                }); 
                */
                this.createEntry();
            },

            createEntry() {
                axios.put('/entries/'+this.currentEntry.id, {
                    ended_at: moment().format('Y-MM-DD H:mm:ss')
                })
                .then(response => console.log(response))
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
                        console.log(response);
                        if (response.data) {
                            const entry = response.data;
                            this.entries.push(entry);
                            console.log(this.entries);
                        }
                    })

                axios.put(`/projects/${this.id}`, {
                    timer_started_at: startTime
                })
                    .then((response) => {
                        console.log(response);
                        this.timer_started_at = response.data.timer_started_at;
                    })
            }

        }

    }
</script>