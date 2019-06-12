window.Vue = require('vue');


Vue.component('app-message', require('./../components/AppMessagesComponent.vue').default);


import UsersComponent from './components/UsersComponent';

const users = new Vue({
    el: '#usersVue',
    components:{
    	 'users-component': UsersComponent,
    },
});





