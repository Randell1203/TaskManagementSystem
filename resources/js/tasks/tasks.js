window.Vue = require('vue');

Vue.component('app-message', require('./../components/AppMessagesComponent.vue').default);

import TasksComponent from './components/TasksComponent';

const task = new Vue({
    el: '#tasksVue',
    components:{
    	 'task-component': TasksComponent,
    },
});





