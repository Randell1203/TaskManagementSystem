<template>
	<div>
		
		
				

		<div class="row my-2">
			<div class="card col-sm-12">
				<div class="card-body">
					<div class="card-title">
						<h3>Tasks</h3>
					</div>
					<div class="card-text">

						<form v-on:submit.prevent="submitTaskFilter()">
							<!-- FILTER -->
							<div class="form-row">

								<!-- Date From -->
								<div class="form-group col-md-3">
									<label for="date_from" class="font-weight-bold">Date From</label>
									  <div class="input-group-prepend">
									    <span class="input-group-text">
									    	<i class="far fa-calendar-alt"></i>
									    </span>
									    <datepicker :input-class="'form-control'" name="date_from" id="date_from"  :format="'yyyy-MM-dd'"  v-model="taskFilter['date_from']"></datepicker>
									  </div>
								</div>

								<!-- Date To -->
								<div class="form-group col-md-3">
									<label for="date_to" class="font-weight-bold">Date To</label>
									  <div class="input-group-prepend">
									    <span class="input-group-text">
									    	<i class="far fa-calendar-alt"></i>
									    </span>
									    <datepicker :input-class="'form-control'" name="date_to" id="date_to"  :format="'yyyy-MM-dd'"   v-model="taskFilter['date_to']"></datepicker>
									  </div>
								</div>

								<!-- Date To -->
								<div class="form-group col-md-3">
									<label for="date_started" class="font-weight-bold">Date Started</label>
									  <div class="input-group-prepend">
									    <span class="input-group-text">
									    	<i class="far fa-calendar-alt"></i>
									    </span>
									    <datepicker :input-class="'form-control'" name="date_started" id="date_started"  :format="'yyyy-MM-dd'"  v-model="taskFilter['date_started']" ></datepicker>
									  </div>
								</div>

								<!-- Date To -->
								<div class="form-group col-md-3">
									<label for="deadline" class="font-weight-bold">Deadline</label>
									  <div class="input-group-prepend">
									    <span class="input-group-text">
									    	<i class="far fa-calendar-alt"></i>
									    </span>
									    <datepicker :input-class="'form-control'" name="deadline" id="deadline"  :format="'yyyy-MM-dd'"  v-model="taskFilter['deadline']" ></datepicker>
									  </div>
								</div>
								
							</div>

							<div class="form-row">
								

								<div class="form-group col-md-3">
									<label for="status" class="font-weight-bold">Status</label>
									<select name="status" id="status" class="form-control" v-model="taskFilter['status']">
					                    <option value="0" selected>All</option>

					                    <option :value="task['id']" v-for="(task, task_key) in defaultData['task_status']">{{ task['status'] }}</option>

									</select>
								</div>
								
								<!-- If not team member -->
								<template v-if="user_type != 4">


									<div class="form-group col-md-3" v-if="user_type <= 2">
										<label for="department" class="font-weight-bold">Department</label>
										<select name="department" id="department" class="form-control" v-model="taskFilter['department']">
						                    <option value="0" selected>All</option>

						                    <option :value="department['id']" v-for="(department, department_key) in defaultData['department']">{{ department['name'] }}</option>


										</select>
									</div>

									<div class="form-group col-md-3" >
										<label for="assigned_to" class="font-weight-bold">Assigned to</label>
										<select name="assigned_to" id="assigned_to" class="form-control" v-model="taskFilter['assigned_to']">
						                    <option value="0" selected>All</option>
											<option :value="user['id']" v-for="(user, user_key) in defaultData['user_list']">{{ user['full_name'] }}</option>

										</select>
									</div>	
								</template>
							</div>
							<!-- END FILTER -->		

							<div class="my-2">
								<button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#taskModal" v-on:click="addTask()" v-if="user_type != 4">
									<i class="fas fa-plus"></i> <span>Add Task</span>
								</button>

								<button type="submit" class="btn btn-primary text-white text-sm-right" data-toggle="modal" data-target="#taskModal">
									<i class="fas fa-search"></i> <span>Search Task</span>
								</button>
							</div>
						</form>

						<div class="table-responsive">
							<table class="table table-hover table-bordered">
								<thead class="thead-dark">
									<tr class="text-center">
										<th scope="col">#</th>
										<th scope="col">Employee Name</th>
										<th scope="col">Task Name</th>
										<th scope="col">Department</th>
										<th scope="col">Date Started</th>
										<th scope="col">Deadline</th>
										<th scope="col">Status</th>
										<th scope="col" >Action</th>
									</tr>
								</thead>
								<tbody>
									
									<template v-if=" ('data' in taskList)">
										<tr v-for="(task, task_key) in taskList['data']">
											<td scope="row">{{task_key + 1}}</td>
											<td>{{task['assigned_employee']}}</td>
											<td>{{task['task_title']}}</td>
											<td>{{task['department_name']}}</td>
											<td>{{task['start_date']}}</td>
											<td>{{task['deadline']}}</td>
											<td>
												<span class="p-2" :class="statusClass[task['status']]">
													{{task['task_status']}}
												</span>
											</td>
											<td class="text-center"  nowrap>

												<button type="button" class="btn btn-default" data-toggle="modal" data-target="#taskModal" v-on:click="viewTask(task.id,2)">
													<i class="fas fa-edit"></i>
												</button>
												<button type="button" class="btn btn-default" data-toggle="modal" data-target="#taskModal" v-on:click="viewTask(task.id,3)">
													<i class="fas fa-eye"></i>
												</button>

											</td>
										</tr>

										<template v-if="taskList['data'].length == 0">
											<tr>
												<td class="text-center font-weight-bold" colspan="8">
													<span>No Data Available</span>
												</td>	
											</tr>	
										</template>
									</template>
									
									
									
								</tbody>
							</table>	
						</div>

						<template v-if="taskList['total'] > 0 ">
							<nav aria-label="Page navigation example">
							  	<ul class="pagination">
								    <li class="page-item hover" v-on:click="submitTaskFilter(taskList['current_page'] - 1)" v-if="taskList['prev_page_url']">
								    	<a class="page-link" >Previous</a>
								    </li>

								    <li class="page-item hover" :class="{'active' : (pageNumber == taskList['current_page'])}" v-for="pageNumber in parseInt(taskList['last_page'])" v-on:click="submitTaskFilter(pageNumber)">
								    	<a class="page-link">{{pageNumber}}</a>
								    </li>

								    <li class="page-item hover" v-on:click="submitTaskFilter(taskList['current_page'] +1)" v-if="taskList['next_page_url']">
								    	<a class="page-link" >Next</a>
								    </li>
								</ul>
							</nav>	
						</template>
					</div>
				</div>
			</div>
		</div>

		<task-modal :taskModal="taskModal" :task="task"  @updateComponent="updateTaskComponent($event)" ></task-modal>

	</div>
</template>

<script>
	import Datepicker from 'vuejs-datepicker';
	import utilities from './../../utilities/utilities.js';
	import TaskModalComponent from './../../components/modals/TaskModalComponent.vue';




	//Initial Data

	function initialData(){
		return {
	        user_type : document.querySelector("meta[name='user_type']").getAttribute('content'),

	        taskList:[],
	        task : {
	        	taskName:'',
	        	status: 1,
	        	department : 0,
	        	assignedEmployee : 0,
	        	date_started: "",
	        	deadline: '',
	        	description : '' ,
				id:0 //<---for update only


	        },

	        taskFilter:{
	        	date_from:'',
	        	date_to:'',
	        	date_started:'',
	        	deadline:'',
	        	status:0,
	        	department:0,
	        	assigned_to:0
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
	        },

	        defaultData:{},

	        paginate:"",


	        statusClass:{
	        	'1' : 'badge  badge-secondary text-white',
	        	'2' : 'badge  badge-info text-white',
	        	'3' : 'badge  badge-success text-white',
	        	'4' : 'badge  badge-danger text-white',
	        }

	    }
	}

    export default {
    	props: ['auth_user'],
    	components:{
    		 'datepicker': Datepicker,
    		 'task-modal': TaskModalComponent,
    	},
    	mixins: [utilities],
		data: function(){
			return initialData();
		},
		mounted() {
			this.initializeData();
		},
		created() {
			this.getDefaultData(['department','task_status']);
			this.submitTaskFilter();


		},
		beforeUpdate: function(){
		},
		updated: function(){

		},
		
		watch:{
			'taskFilter.department': function(val){
				var data = {
						id:val,
				};
		    	this.getUsersListByDeparment(data);
			},
		},
    	methods: {
    		clearForm: function(){
    			 Object.assign(this.$data.task, initialData().task);
    		},
    		viewTask(task_id,action){

    			let self = this;
    			self.taskModal['isShowModal'] = true;
    			self.taskModal['formAction'] = action;

    			// Find task in tasks list using id
    			var obj = self.taskList['data'].find(function (obj) { 
    			    return obj.id === task_id; 
    			});

    			self.task['id'] = obj['id'];
    			self.task['taskName'] = obj['task_title'];
    			self.task['status'] = obj['status'];
    			self.task['department'] = obj['department_id'];
    			self.task['assignedEmployee'] = obj['assigned_to'];
    			self.task['date_started'] = obj['start_date'];
    			self.task['deadline'] = obj['deadline'];
    			self.task['description'] = obj['description'];


    		},
    		addTask:function(){
    			this.taskModal['isShowModal'] = true;
    			this.taskModal['formAction'] = 1;
    			this.clearForm();
    		},
			submitTaskFilter: function(page){
				var axiosUrl = "/getAllTasks";

				// paginate
				if(page > 0){
					axiosUrl = "/getAllTasks?page=" + page;
				}

				let self = this;
				axios.get(axiosUrl, {params: self.taskFilter}).then(response => {
					self.taskList = response.data;
				});
				
			},
			updateTaskComponent:function(val){
				this.taskModal = val['taskModal'];
				// this.taskList.push(val['newTask']);
			},
			initializeData:function(){
				//Initialize date
				this.taskFilter['date_to'] = new Date();
				var date = new Date();
				date.setDate(date.getDate()-10);
				this.taskFilter['date_from'] = date;

				// initialize department for team leader
				this.taskFilter['department'] = this.auth_user['department'];
			}
    	},
    }
</script>
