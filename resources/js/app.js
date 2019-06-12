/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');


import NavigationComponent from './components/NavigationComponent';
import FooterComponent from './components/FooterComponent';

const navigation = new Vue({
    el: '#navigationVue',
    components:{
    	 'navigationcomponent': NavigationComponent,
    }
});

const footer = new Vue({
    el: '#footerVue',
    components:{
    	 'footercomponent': FooterComponent
    }
});

