<template>
	<div>
		<!-- Modal -->
		<div class="modal fade" id="takModal" tabindex="-1" role="dialog" aria-labelledby="takModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="takModalLabel">Task</h5>
						<button type="button" class="close" aria-label="Close" v-on:click="closeModalComponent()">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<form v-on:submit.prevent="submitTaskForm()">
						<div class="modal-body">
								<div class="form-row">
									<div class="form-group col-md-6">
										<label for="taskName">Task Name</label>
										<input type="text" v-model="task.taskName" name="taskName" class="form-control" id="taskName" placeholder="Task Name" :required="isMember" :readonly="(user_type == 4 )">
									</div>

									<div class="form-group col-md-6">
										<label for="status">Status</label>
										<select v-model="task.status" name="status" id="status" class="form-control" :disabled="taskModal['formAction'] == 3 || isStart == true">
			                                <option value="0" disabled selected>--Select Status--</option>

		                                	<option :value="task['id']" v-for="(task, task_key) in taskStatusList">{{ task['status'] }}</option>
										</select>
									</div>
									
								</div>

								<div class="form-row">
									<div class="form-group col-md-6">
										<label for="department">Department</label>
    		
										<select v-model="task.department" class="form-control" name="department" id="department" :disabled="(user_type == 4 || taskModal['formAction'] == 3)" @change="task['assignedEmployee'] = 0;">
			                                <option value="0" disabled selected>--Select Department--</option>

		                                	<option :value="department['id']" v-for="(department, department_key) in departmentList">{{ department['name'] }}</option>
										</select>
									</div>

									<div class="form-group col-md-6">
										<label for="assignedEmployee">Assigned to</label>
										<select v-model="task.assignedEmployee" name="assignedEmployee" id="assignedEmployee" class="form-control" :required="isMember" :disabled="(user_type == 4 || taskModal['formAction'] == 3)">
											<option value="0" disabled="disabled">--Select Employee--</option>
											<option :value="user['id']" v-for="(user, user_key) in defaultData['user_list']">{{ user['full_name'] }}</option>
										</select>
									</div>
								</div>


								<div class="form-row">
									<div class="form-group col-md-6">
										<label for="date_started">Date Started</label>
										<datepicker :input-class="'form-control'" name="date_started" id="date_started" v-model="task.date_started" :format="'yyyy-MM-dd'"  :disabled="true"></datepicker>
									</div>

									<div class="form-group col-md-6">
										<label for="deadline">Deadline</label>
										<datepicker :input-class="'form-control'" name="deadline" id="deadline" v-model="task.deadline" :format="'yyyy-MM-dd'" :disabled="taskModal['formAction'] == 3"></datepicker>
									</div>
								</div>

								<div class="form-row">
									<label for="description">Description</label>
									<div class="form-group col-md-12">
										<textarea v-model="task.description" class="form-control" name="description" id="description" cols="30" rows="10" :required="isMember" :readonly="(user_type == 4 || taskModal['formAction'] == 3)"></textarea>
									</div>
								</div>

							
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-danger" data-dismiss="modal" v-on:click="closeModalComponent()">Close</button>

							<button type="submit" class="btn btn-primary" v-if="taskModal['formAction'] != 3">
								{{buttonAction}}
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>

	</div>
		


	</div>
</template>

<script>
	import Datepicker from 'vuejs-datepicker';

	function initialData(){
		return {
	        user_type : document.querySelector("meta[name='user_type']").getAttribute('content'),

			isMember:false,

			departmentList:{},
			taskStatusList:{},
			user_list:{},

			defaultData:{},
			buttonAction:'',
			isStart:false,

	    }
	}
    export default {
		props: ['task', 'taskModal'],
		components:{
			 'datepicker': Datepicker,

		},
		data: function(){
			return initialData();
		},
		mounted() {
			
		},
		created() {
			this.getDefaultData();
		},
		beforeUpdate: function(){

		},
		updated: function(){

		},
		watch: {
		    'taskModal.isShowModal': function (val) {
		    	if(val){
		    		this.showModal();
		    	}else{
		    		this.hideModal();
		    	}
		    },
		    'task.department': function (val){
    			var data = {
    					id:val,
    			};
    	    	this.getUsersListByDeparment( data);
		    },

		    'taskModal.formAction': function (val){
    			switch(this.taskModal['formAction']){
    				case 1:
    					// Create
    					this.buttonAction = 'Add';
    				break;

    				case 2:
    					// Update
    					this.buttonAction = 'Update';

    					if(this.task['date_started'] == '' || this.task['date_started'] == null){
    						this.buttonAction = 'Start';
    						this.task['status'] = 2;
    						this.isStart = true;
    						this.task['date_started'] = new Date();
    					}
    				break;
    			}
		    }
	  	},
    	methods: {
    		showModal: function(){
    			$('#takModal').modal({
    			      backdrop: 'static',
    			      keyboard: false
    			    });
    		},
    		hideModal: function(){
    			$('#takModal').modal('hide');
    		},
    		getDefaultData:function(){
    			let self= this;
    			var axiosUrl = "/getDefaultData";

    			var data = ['department','task_status'];

    			axios.get(axiosUrl, {params: data}).then(response => {
    				var data = response.data;
	        		self.departmentList = data['department'];
	        		self.taskStatusList = data['task_status'];
    			}).catch(function(error){
    				

    			});

    		},
    		submitTaskForm:function (){

    			var action = this.taskModal['formAction'];
    			var axiosUrl = '';
    			let self = this;

    			if(action == 1){
    				// ADD
    				axiosUrl = "/createTask";

	    			axios.post(axiosUrl, self.task).then(response => {
	    				var response = response.data;	 
	    				self.closeModalComponent(response);
		       //  		self.validationError = {};
	    				// self.messageData.isShow= true;
	    				// self.messageData.status = 1;  
	    				// self.messageData.appMessage = 'User Successfully updated.';
	    				// self.hideModal();
	    			}).catch(function(error){
	    				// Validation error from laravel validation
	    				self.validationError = error.response.data.errors;
	    				self.messageData.isShow= true;
	    				self.messageData.status = 0; 
	    				self.messageData.appMessage = 'Error on saving data.'; 
	    			});


    			}else if(action == 2){
    				// EDIT
    				axiosUrl = "/updateTask";

	    			axios.put(axiosUrl, self.task).then(response => {
	    				var response = response.data;	 
	    				self.closeModalComponent(response);
		       //  		self.validationError = {};
	    				// self.messageData.isShow= true;
	    				// self.messageData.status = 1;  
	    				// self.messageData.appMessage = 'User Successfully updated.';
	    				// self.hideModal();
	    			}).catch(function(error){
	    				// Validation error from laravel validation
	    				self.validationError = error.response.data.errors;
	    				self.messageData.isShow= true;
	    				self.messageData.status = 0; 
	    				self.messageData.appMessage = 'Error on saving data.'; 
	    			});
    			}
    			
    		},
    		closeModalComponent:function(addedTask){

    			var taskModal = {
    				isShowModal:false,
    				formAction:0,
    				isReadOnly:false,
    				isUpdateDashboard:false,
    			};


    			if(addedTask){
    				taskModal['isUpdateDashboard'] = true;
    			}

    			var emitData = {
    				"taskModal": taskModal,
    				"newTask":addedTask,
    			}

				this.$emit('updateComponent',emitData);
    		},
    		getUsersListByDeparment(data){
    			
    			let self= this;
    			var axiosUrl = "/getUsersListByDeparment";
    			axios.get(axiosUrl, {params: data}).then(response => {
    				self.defaultData['user_list'] = response.data;


    				// // if action create new task
    				// if(self.taskModal['formAction'] != 3 ){
    				// 	self.task['assignedEmployee'] = 0;
    				// } 

    		    	self.$forceUpdate();
    			}).catch(function(error){
    				
    			});
    		},
    	},
    }
</script>
