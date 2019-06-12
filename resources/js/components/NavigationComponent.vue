<template>
    <div>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">

                    
                <a class="navbar-brand font-weight-bold" href="#"><span class="custom-light">Board</span> <span class="custom-secondary">Worklog</span></a>



                <template v-if="is_authenticated">
                        
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item">
                                <a class="nav-link" :href="base_url+'/dashboard'">Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" :href="base_url+'/tasks'">Tasks</a>
                            </li>
                       
                            <li class="nav-item" v-if="auth_user['user_type'] == 1">
                                <a class="nav-link" :href="base_url+'/users'">Users</a>
                            </li>

                        </ul>

                        <button type="button" class="btn btn-default">
                               
                        </button>

                        <ul class="navbar-nav ">
                            <li class="nav-item dropdown ">
                                <a class="nav-link dropdown-toggle text-right" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                                    <span class="custom-light font-weight-bold">  {{auth_user['user_type_priv']}} |</span>
                                    <span class="custom-secondary font-weight-bold">
                                        {{auth_user['full_name']}} 
                                    </span>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item hover" v-on:click="submitEntry()" ><span>Log Out </span> </a>
                                </div>
                            </li>
                           
                        </ul>
                        

                    </div>
                </template>
            </div>
            
        </nav>

    </div>
</template>

<script>
    export default {
        props:['is_authenticated', 'auth_user'],
       
        data: function(){
        return {
                base_url : document.querySelector("meta[name='base_url']").getAttribute('content'),
  
            }
        },
        mounted() {
        },
        created() {

            // this.getAllTasks();
        },
        beforeUpdate: function(){

        },
        updated: function(){

        },
        methods: {
            submitEntry: function() {
                var data = {};
                var axiosUrl = "/logout";
                let self = this;
                axios.post(axiosUrl,data).then(response => {
                    window.location.replace(this.base_url+'/login');
                });
            }
           
        },
    }
</script>
