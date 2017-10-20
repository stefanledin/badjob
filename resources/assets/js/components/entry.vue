<template>
    <div class="card bg-secondary text-light mb-4">
        <div class="card-header">
            <h4 class="card-title float-left"></h4>
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
    export default {

        props:['entry'],

        data() {
            return {
                id: this.entry.id,
                working_with: this.entry.working_with,
                duration: this.entry.duration,
                ended_at: this.entry.ended_at
            }
        },

        methods: {
            decrease: function () {
                if (this.entry.duration > 0) {
                    this.entry.duration -= 0.25
                }
                this.sync();
            },

            increase: function () {
                this.entry.duration += 0.25;
            },

            sync() {
                axios.post(`/entry/${this.id}/stop`, {
                    working_with: this.working_with
                })
                    .then(function (response) {
                        console.log(response);
                    })
                    .catch((error) => console.log(error));
            },

            resume() {
                axios.post(`/entry/${this.id}/resume`)
                    .then(function (response) {
                        this.working_with = response.data.working_with;
                        this.duration = response.data.duration;
                        this.ended_at = response.data.ended_at;
                    })
                    .catch((error) => console.log(error));
            },

            stop() {
                axios.post(`/entry/${this.id}/stop`)
                    .then(function (response) {
                        this.working_with = response.data.working_with;
                        this.duration = response.data.duration;
                        this.ended_at = response.data.ended_at;
                    })
                    .catch((error) => console.log(error));
            }
        },


    }
</script>