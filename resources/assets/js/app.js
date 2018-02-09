
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
Vue.component('project', require('./components/project.vue'));

import db from './database';
import moment from 'moment';
const app = new Vue({
    el: '#app',
    
    data: {
        working: false,
        start_working_on: '',
        projects: []
    },
    
    created: async function () {
        this.projects = await db.project.toArray();
        /*axios.get('/projects').then((response) => {
            this.projects = response.data;
        }).catch((error) => console.log(error));*/
    },
    
    methods: {

        async startWorking(event) {
            event.preventDefault();

            // Skapa ett entry och returnera ID
            const entryId = await db.entry.add({
                started_at: moment().format('Y-MM-DD H:mm:ss'),
                ended_at: ''
            });
            
            // Skapa ett nytt projekt som har det nya entryt.
            const projectId = await db.project.add({
                name: this.start_working_on,
                entries: [entryId],
                timer_running: true
            });

            const project = await db.project.get(projectId);
            this.projects.push(project);

            this.start_working_on = '';

            /* axios.post('/projects', {
                name: this.start_working_on
            })
                .then((response) => {
                    if (response.data) {
                        const project = response.data;
                        this.projects.unshift(project);
                    }
                    this.start_working_on = '';
                })
                .catch((error) => console.log(error)); */
        }

    }

});
