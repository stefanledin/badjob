
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
import axios from 'axios';
const app = new Vue({
    el: '#app',
    
    data: {
        working: false,
        start_working_on: '',
        projects: []
    },
    
    created: async function () {
        const projects = await axios.get('/projects')
        this.projects = projects.data;
    },
    
    methods: {

        async startWorking(event) {
            event.preventDefault();

            /*const entryId = await db.entry.add({
                started_at: moment().format('Y-MM-DD H:mm:ss'),
                ended_at: ''
            });
            const projectId = await db.project.add({
                name: this.start_working_on,
                entries: [entryId],
                timer_running: true
            });

            const project = await db.project.get(projectId);*/

            /**
             * Skapa ett projekt.
             */
            let project = await axios.post('/projects', {
                name: this.start_working_on    
            }).catch(error => console.log('error: ', error));
            
            /**
             * Skapa ett entry.
             */
            const entry = await axios.post('/entries', {
                started_at: moment().format('Y-MM-DD H:mm:ss'),
                ended_at: '',
                project_id: project.data.id
            }).catch(error => console.log(error));

            /**
             * Lägg till entryt i projektet.
             */
            project.data.entries = [entry.data];

            this.projects.push(project.data);
            this.start_working_on = '';
        }

    }

});
