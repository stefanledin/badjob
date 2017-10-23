<template>
    <div class="card bg-secondary text-light mb-4">
        <div class="card-header">
            <h4 class="card-title float-left">00:00:00</h4>
            <button class="btn btn-dark float-right" v-if="ended_at" v-on:click="resume">Fortsätt</button>
            <button class="btn btn-danger float-right" v-else v-on:click="stop">Stopp</button>
        </div>
        <div class="card-body">
            <h4 class="card-title">{{ working_with }}</h4>
            <div class="input-group">
                <span class="input-group-btn">
                    <button class="btn btn-dark border-dark" type="button" v-on:click="decrease">-0,25</button>
                </span>
                <input type="number" class="form-control text-center border-dark" :value="duration">
                <span class="input-group-btn">
                    <button class="btn btn-dark border-dark" type="button" v-on:click="increase">+0,25</button>
                </span>
            </div>
        </div>
    </div>
</template>

<script>
    const Timer = require('easytimer');

    export default {

        props:['entry'],

        data() {
            return this.entry;
        },

        mounted() {
            this.timer = new Timer();
            if (!this.ended_at) {
                this.startTimer();
            }
        },

        methods: {
            
            decrease: function () {
                if (this.duration > 0) {
                    this.duration -= 0.25
                }
                this.sync();
            },

            increase: function () {
                this.duration += 0.25;
                this.sync();
            },

            sync() {
                axios.post(`/entry/${this.id}/stop`, {
                    working_with: this.working_with,
                    duration: this.duration
                });
            },

            resume() {
                this.startTimer();
                axios.post(`/entry/${this.id}/resume`, {
                    working_with: this.working_with,
                    duration: this.duration
                })
                    .then(this.update.bind(this))
                    .catch((error) => console.log(error));
            },

            stop() {
                this.timer.stop();
                this.timer.reset();
                
                axios.post(`/entry/${this.id}/stop`, {
                    working_with: this.working_with,
                    duration: this.duration
                })
                    .then(this.update.bind(this))
                    .catch((error) => console.log(error));
            },

            update(response) {
                this.duration = response.data.duration;
                this.working_with = response.data.working_with;
                this.ended_at = response.data.ended_at;
            },

            startTimer() {
                const h4 = this.$el.querySelector('h4');
                const timer = new Timer();
                this.timer.start();
                this.timer.addEventListener('secondsUpdated', function (event) {
                     h4.innerHTML = this.timer.getTimeValues().toString();
                }.bind(this));
            },
        },


    }
</script>