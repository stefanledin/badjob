
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('entry', require('./components/entry.vue'));

const app = new Vue({
    el: '#app',
    
    data: {
        working: false,
        start_working_on: '',
        entries: []
    },
    
    created: function () {
        axios.get('/entries').then((response) => {
            this.entries = response.data;
        }).catch((error) => console.log(error));
    },
    
    methods: {
        startWorking: function () {
            axios.post('/entry/start', {
                working_with: this.start_working_on
            })
            .then((response) => this.entries.push(response.data))
            .catch((error) => console.log(error));
        }
    }

});
