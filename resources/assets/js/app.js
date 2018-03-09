
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import Echo from 'laravel-echo';
window.Pusher = require('pusher-js');
window.Echo = new Echo({
    broadcaster: 'pusher',
    key: '5f1d1c5da0682b0f98fd',
    cluster: 'eu',
    encrypted: true
});


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.component('project', require('./components/project.vue'));

//import db from './database';
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

        window.Echo.channel('project')
            .listen('ProjectCreated', event => {
                //this.startWorking(event.project)
            })
            .listen('ProjectDeleted', event => {
                this.deleteProject({
                    id: event.project.id
                });
            });
        
        window.Echo.channel('entry')
            .listen('EntryCreated', async function(event) {
                const response = await axios.get('/projects/'+event.entry.project_id);
                const newProject = response.data[0];
                this.startWorking(newProject);                
            }.bind(this))
            .listen('EntryUpdated', event => console.log('EntryUpdated', event));
    },
    
    methods: {

        async createProject(event) {
            event.preventDefault();
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
            
            this.startWorking(project.data);
        },

        deleteProjectOnServer(projectToDelete) {
            axios.delete('/projects/'+projectToDelete.id);
            this.deleteProject(projectToDelete);
        },

        deleteProject(projectToDelete) {
            this.projects = this.projects.filter(project => project.id !== projectToDelete.id);
        },

        startWorking(project) {
            console.log(project.entries);
            this.projects.unshift(project);
            this.start_working_on = '';
        }

    }

});
