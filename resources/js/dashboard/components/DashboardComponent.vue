<template>
	<div>
		<div class="my-2">
			<div class="card">
				<div class="card-body">
					<div class="card-title">
						<h3>Dashboard</h3>
					</div>
					
					<div class="row my-2">
						<div class="col-sm-12">
							<div class="progress">
							  <div class="progress-bar progress-bar-striped   bg-secondary" role="progressbar" id="PENDING" :aria-valuenow="totalPercentage['PENDING']" aria-valuemin="0" aria-valuemax="100">{{totalPercentage['PENDING']}}%</div>
							  <div class="progress-bar progress-bar-striped   bg-info" role="progressbar" id="ONGOING" :aria-valuenow="totalPercentage['ONGOING']" aria-valuemin="0" aria-valuemax="100">{{totalPercentage['ONGOING']}}%</div>
							  <div class="progress-bar progress-bar-striped   bg-success" role="progressbar" id="FINISHED" :aria-valuenow="totalPercentage['FINISHED']" aria-valuemin="0" aria-valuemax="100">{{totalPercentage['FINISHED']}}%</div>
							  <div class="progress-bar progress-bar-striped   bg-danger" role="progressbar" id="DELAYED" :aria-valuenow="totalPercentage['DELAYED']" aria-valuemin="0" aria-valuemax="100">{{totalPercentage['DELAYED']}}%</div>

							</div>	
						</div>
					</div>
		


				
					<div class="row my-2" style="min-height: 500px">

						<div class="col-md-3 px-1 mb-2">
							<div class="card bg-secondary text-white" style="height: 100%;" >
								<div class="card-header text-center">
									<h5 class="card-title">PENDING</h5>
								</div>
								<div class="card-body">
									<div class="row hover" v-for="(tasks, task_key) in userTasks['PENDING']" v-on:click="editTask(tasks.id,'PENDING')">
										<div class="col-sm-12 ">
											<i class="fas fa-edit"></i>
											{{tasks['task_title']}}
										</div>
									</div>
								</div>
							</div>	
						</div>

						<div class="col-md-3 px-1 mb-2">
							<div class="card bg-info text-white" style="height: 100%;" >
								<div class="card-header text-center">
									<h5 class="card-title">ONGOING</h5>
								</div>
								<div class="card-body">
									<div class="row hover" v-for="(tasks, task_key) in userTasks['ONGOING']"  v-on:click="editTask(tasks.id,'ONGOING')">
										<div class="col-sm-12 ">
											<i class="fas fa-edit"></i>

											{{tasks['task_title']}}
										</div>
									</div>
								</div>
							</div>	
						</div>


						<div class="col-md-3 px-1 mb-2">
							<div class="card bg-success text-white" style="height: 100%;" >
								<div class="card-header text-center">
									<h5 class="card-title">FINISHED</h5>
								</div>
								<div class="card-body">
									<div class="row hover" v-for="(tasks, task_key) in userTasks['FINISHED']"  v-on:click="editTask(tasks.id,'FINISHED')">
										<div class="col-sm-12 ">
											<i class="fas fa-edit"></i>

											{{tasks['task_title']}}
										</div>
									</div>
								</div>
							</div>	
						</div>


						<div class="col-md-3 px-1 mb-2">
							<div class="card bg-danger text-white" style="height: 100%;" >
								<div class="card-header text-center">
									<h5 class="card-title">DELAYED</h5>
								</div>
								<div class="card-body">
									<div class="row hover" v-for="(tasks, task_key) in userTasks['DELAYED']" v-on:click="editTask(tasks.id,'DELAYED')" >
										<div class="col-sm-12 ">
											<i class="fas fa-edit"></i>

											{{tasks['task_title']}}
										</div>
									</div>
								</div>
							</div>	
						</div>
					</div>
				</div>
			</div>
		</div>


		<task-modal :taskModal="taskModal" :task="task"  @updateComponent="updateDashboard($event)" ></task-modal>

	</div>
</template>

<script>

	function initialData(){
		return {
	        user_id : document.querySelector("meta[name='user_id']").getAttribute('content'),


			task : {
				taskName:'',
				status: 1,
				department : 0,
				assignedEmployee : 0,
				date_started: "",
				deadline: '',
				description : '',  
				id:0 //<---for update only
			},
			userTasks:{},	
			

			totalPercentage:{
				PENDING: 0,
				ONGOING: 0,
				FINISHED: 0,
				DELAYED: 0,
			},

			/*
			var: formAction
			1 = add user
			2 = edit user
			3 = view only
	        */
	        taskModal:{
	        	isShowModal:false,
	        	formAction:0,
	        	isReadOnly:false,
	        }


	    }
	}
    export default {
		props: [''],
		data: function(){
			return initialData();
		},
		mounted() {
		},
		created() {
			this.getUserTask(this.user_id);
			
		},
		beforeUpdate: function(){

		},
		updated: function(){

		},
    	methods: {
    		showModal: function(){
    			$('#formModal').modal({
    			      backdrop: 'static',
    			      keyboard: false
    			    });
    		},
    		
    		getUserTask:function (userId){
    			var axiosUrl = '/getUserTask';
    			var data= {
    				id: userId
    			}
    			let self = this;
    			axios.get(axiosUrl, {params: data}).then(response => {
	        		self.userTasks = response.data;
	        		self.getProgressPercent(response.data);
    			}).catch(function(error){
    				

    			})
    		},
    		updateDashboard: function(val){
    			this.taskModal = val['taskModal'];
    			if(this.taskModal['isUpdateDashboard']){
    				this.getUserTask(this.user_id);
    			}
    		},
    		getProgressPercent(tasks){
    			var totalItems = 0;
    			let self = this;

    			// Get total items of user's tasks
    			for (var key in tasks) {
    			    if (tasks.hasOwnProperty(key)) {
    			        totalItems += tasks[key].length;
    			    }
    			}

    			// Get percentage of task's status
    			if(totalItems > 0){
    				for (var key in tasks) {
    				    if (tasks.hasOwnProperty(key)) {
    				    	var item = tasks[key].length;

    				        var percentage = ((item / totalItems) * 100).toFixed(2);
    				        document.getElementById(key).style.width = percentage+'%';
    				        self.totalPercentage[key] = percentage;
    				    }
    				}
    			}
    		},
    		editTask(task_id,key){
    			let self = this;
    			self.taskModal['isShowModal'] = true;
    			self.taskModal['formAction'] = 2;

    			// Find task in tasks list using id
    			var obj = self.userTasks[key].find(function (obj) { 
    			    return obj.id === task_id; 
    			});
    			self.task['id'] = obj['id'];
    			self.task['taskName'] = obj['task_title'];
    			self.task['status'] = obj['status'];
    			self.task['department'] = obj['department_id'];
    			self.task['assignedEmployee'] = obj['assigned_to'];
    			self.task['deadline'] = obj['deadline'];
    			self.task['description'] = obj['description'];
    			self.task['date_started'] = obj['updated_at'];
    		},

    	},
    }
</script>
