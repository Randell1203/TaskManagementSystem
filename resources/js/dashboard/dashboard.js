window.Vue = require('vue');

// GLOBAL COMPONENTS
Vue.component('task-modal', require('./../components/modals/TaskModalComponent.vue').default);


// LOCAL COMPONENTS
import DashboardComponent from './components/DashboardComponent';



const dashboard = new Vue({
    el: '#dashboardVue',
    components:{
    	 'dashboard-component': DashboardComponent,
    }
});






