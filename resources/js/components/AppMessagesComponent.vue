<template>
    <div>
    	<div v-bind:class="alertStatus" role="alert" v-if="messageData['isShow']">

    		<h5 class="alert-heading">{{messageStatus}}</h5>
    		{{appMessage}}
    		<button type="button" class="close" data-hide="alert" aria-label="Close">
    			<span aria-hidden="true">&times;</span>
    		</button>
    	</div>
    </div>
</template>


<script>
    export default {
        props:['messageData'],
        data: function(){
			return {
				alertStatus : '',
				messageStatus: '',
				appMessage: '',

			}
		},
		watch: {
		    'messageData.status': function (val) {
		    	switch(val){
		    		case 1:
		    			this.alertStatus = 'alert alert-success alert-dismissible fade show';
		    			this.messageStatus = 'Success';
		    		break;
		    		case 0:
		    		case -1:
		    			this.alertStatus = 'alert alert-danger alert-dismissible fade show';
		    			this.messageStatus = 'Error';
		    		break;
		    	}
    			this.appMessage = this.messageData.appMessage;
		    },
		   
	  	}
    }
</script>
