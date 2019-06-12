<template>
	<div>

		<div class="row my-2" >
			<div class="col-sm-12">
				<button type="button" class="btn btn-dark" v-on:click="showEditViewModal(user['id'],1)">
					<i class="fas fa-plus"></i> <span class="custom-secondary ">Create User</span>
				</button>
			</div>	
		</div>




		<div class="row my-2">
			<div class="card col-sm-12">
				<div class="card-body">
		            	<app-message v-bind:messageData="messageData"></app-message>
					<div class="card-title">
						<h3>Users</h3>
					</div>

					<div class="card-text">
						<div class="table-responsive">
							<table class="table table-hover">
								<thead class="thead-dark">
									<tr class="text-center">
										<th scope="col">#</th>
										<th scope="col">Employee Name</th>
										<th scope="col">Username</th>
										<th scope="col">User Type</th>
										<th scope="col">Department</th>
										<th scope="col">Job Title</th>
										<th scope="col">Status</th>
										<th scope="col">Email</th>
										<th scope="col" style="width: 60px">Action</th>
									</tr>
								</thead>
								<tbody>
									<tr v-for="(user, user_key) in usersList">
										<td>2019000{{user['id']}}</td>
										<td>{{user['full_name']}}</td>
										<td>{{user['username']}}</td>
										<td>{{user['user_type_priv']}}</td>
										<td>{{user['department_name']}}</td>
										<td>{{user['job_role']}}</td>
										<td>
											<template v-if="user['status'] == 1">
												Active
											</template>
											<template v-else-if="user['status'] == 2">
												Inactive
											</template>
										</td>
										<td>{{user['email']}}</td>
										<td class="text-center" nowrap >
											
											<button type="button" class="btn btn-default"  v-on:click="showEditViewModal(user['id'],2)" >
												<i class="fas fa-edit"></i>
											</button>
											<button type="button" class="btn btn-default" v-on:click="showEditViewModal(user['id'],3)">
												<i class="fas fa-eye"></i>
											</button>

										</td>
									</tr>
								</tbody>
							</table>	
						</div>
					</div>
				</div>
			</div>
		</div>


		<!-- Modal -->
		<div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="formModalLabel">User Details</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close" v-on:click="showModal()">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
						<div class="modal-body">
			                <form v-on:submit.prevent="submitUserForm()" >
			                    <div class="form-row">
			                        <div class="form-group col-md-4" v-bind:class="{'text-danger' : (validationError['firstName'])}" >
			                            <label for="firstName">First Name <i class="text-danger">*</i></label>
			                            <input type="text" class="form-control" v-bind:class="{'is-invalid' : (validationError['firstName'])}" placeholder="Ex. Juan" id="firstName" name="firstName" v-model="user['firstName']" :readonly="isViewOnly">
			                            <span class="help-block" v-if="validationError['firstName']">{{validationError['firstName'][0]}}</span>

			                        </div>

			                        <div class="form-group col-md-4" v-bind:class="{'text-danger' : (validationError['middleName'])}">
			                            <label for="middleName">Middle Name <span class="text-primary">(optional)</span></label>
			                            <input type="text" class="form-control"  v-bind:class="{'is-invalid' : (validationError['middleName'])}" placeholder="Ex. Carlos" id="middleName" name="middleName" v-model="user['middleName']" :readonly="isViewOnly">
			                            <span class="help-block" v-if="validationError['middleName']">{{validationError['middleName'][0]}}</span>
			                        </div>

			                        <div class="form-group col-md-4" v-bind:class="{'text-danger' : (validationError['lastName'])}">
			                            <label for="lastName">Last Name <i class="text-danger">*</i></label>
			                            <input type="text" class="form-control"  v-bind:class="{'is-invalid' : (validationError['lastName'])}" placeholder="Ex. Dela Cruz" id="lastName" name="lastName" v-model="user['lastName']" :readonly="isViewOnly">
			                            <span class="help-block" v-if="validationError['lastName']">{{validationError['lastName'][0]}}</span>
			                        </div>
			                    </div>

			                    <div class="form-row">
			                        <div class="form-group col-md-6" v-bind:class="{'text-danger' : (validationError['email'])}">
			                            <label for="email">Email Address <i class="text-danger">*</i></label>
			                            <input type="email" class="form-control"  v-bind:class="{'is-invalid' : (validationError['email'])}" placeholder="Ex. juanCarlos23@gmail.com" id="email" name="email" v-model="user['email']" :readonly="isViewOnly">
			                            <span class="help-block" v-if="validationError['email']">{{validationError['email'][0]}}</span>
			                        </div>

			                        <div class="form-group col-md-6" v-bind:class="{'text-danger' : (validationError['username'])}">
			                            <label for="username">Username <i class="text-danger">*</i></label>
			                            <input type="text" class="form-control"  v-bind:class="{'is-invalid' : (validationError['username'])}" placeholder="Ex. JuanDelaCruz03" id="username" name="username" v-model="user['username']" :readonly="isViewOnly">
			                            <span class="help-block" v-if="validationError['username']">{{validationError['username'][0]}}</span>
			                        </div>
			                    </div>

			                    <div class="form-row" v-if="formAction == 1">
			                        <div class="form-group col-md-6" v-bind:class="{'text-danger' : (validationError['password'])}">
			                            <label for="password">Password <i class="text-danger">*</i></label>
			                            <input type="password" class="form-control"  v-bind:class="{'is-invalid' : (validationError['password'])}"  id="password" name="password" v-model="user['password']">
			                            <span class="help-block" v-if="validationError['password']">{{validationError['password'][0]}}</span>
			                        </div>

			                        <div class="form-group col-md-6" v-bind:class="{'text-danger' : (validationError['password_confirmation'])}">
			                            <label for="password_confirmation">Confirm Password <i class="text-danger">*</i></label>
			                            <input type="password" class="form-control"  v-bind:class="{'is-invalid' : (validationError['password_confirmation'])}" id="password_confirmation" name="password_confirmation" v-model="user['password_confirmation']">
			                            <span class="help-block" v-if="validationError['password_confirmation']">{{validationError['password_confirmation'][0]}}</span>
			                        </div>
			                    </div>

			                    <div class="form-row">
			                        <div class="form-group col-md-6" v-bind:class="{'text-danger' : (validationError['contactNo'])}">
			                            <label for="contactNo">Contact No. <span class="text-primary">(optional)</span></label>
			                            <input type="text" class="form-control"  v-bind:class="{'is-invalid' : (validationError['contactNo'])}" placeholder="Ex. 09501234567" id="contactNo" name="contactNo" v-model="user['contactNo']" :readonly="isViewOnly">
			                            <span class="help-block" v-if="validationError['contactNo']">{{validationError['contactNo'][0]}}</span>
			                        </div>

			        
			                        <div class="form-group col-md-6" v-bind:class="{'text-danger' : (validationError['userType'])}">
			                            <label for="userType">User Type <i class="text-danger">*</i></label>
			                            <select name="userType" id="userType" class="form-control"  v-bind:class="{'is-invalid' : (validationError['userType'])}" v-model="user['userType']" :disabled="isViewOnly">
			                                <option value="0" disabled selected>--Select User Type--</option>
		                                	<option :value="userType['id']" v-for="(userType, userType_key) in userTypeList">{{ userType['role'] }}</option>

			                            </select>
			                            <span class="help-block" v-if="validationError['userType']">{{validationError['userType'][0]}}</span>
			                        </div>
			                        
			                    </div>

			                    <div class="form-row">
			                        <div class="form-group col-md-6" v-bind:class="{'text-danger' : (validationError['department'])}">
			                            <label for="department">Department <i class="text-danger">*</i></label>
			                            <select name="department" id="department" class="form-control"  v-bind:class="{'is-invalid' : (validationError['department'])}" v-model="user['department']" @change="changeDepartment()" :disabled="isViewOnly">
			                                <option value="0" disabled selected>--Select Department--</option>
		                                	<option :value="department['id']"  v-for="(department, department_key) in departmentList">{{ department['name'] }}</option>
			                            </select>
			                            <span class="help-block" v-if="validationError['department']">{{validationError['department'][0]}}</span>
			                        </div>

			                        <div class="form-group col-md-6" v-bind:class="{'text-danger' : (validationError['jobTitle'])}">
			                            <label for="jobTitle">Job Title <i class="text-danger">*</i></label>
			                            <select name="jobTitle" id="jobTitle" class="form-control"  v-bind:class="{'is-invalid' : (validationError['jobTitle'])}" v-model="user['jobTitle']" :disabled="isViewOnly">
			                                <option value="0" disabled selected>--Select Job Title--</option>
			                                <option :value="jobTitle['id']" v-for="(jobTitle, jobTitleKey) in jobTitleList">{{ jobTitle['name'] }}</option>
			                            </select>
			                            <span class="help-block" v-if="validationError['jobTitle']">{{validationError['jobTitle'][0]}}</span>
			                        </div>
			                    </div>

			                    
			                    <div class="form-group row mb-0" v-if="!isViewOnly">
			                        <div class="col-md-12 text-center">
			                            <button type="button" class="btn btn-secondary" v-on:click="clearForm()">
			                                Clear <i class="fas fa-undo"></i>
			                            </button>
			                            <button type="submit" class="btn btn-primary">
			                                {{formButtonAction}} <i class="fas fa-user"></i>
			                            </button>
			                        </div>
			                    </div>
			                </form>
						</div>
				</div>
			</div>
		</div>

	</div>
</template>

<script>

	function initialData(){
		return {
	        user_id : document.querySelector("meta[name='user_id']").getAttribute('content'),
			// Initial User Data
	        user:{
	        	firstName : '',
	        	middleName: '',
	        	lastName: '',
	        	email: '',
	        	username: '',
	        	password: '',
	        	password_confirmation: '',
	        	contactNo: '',
	        	userType: 0,
	        	department: 0,
	        	jobTitle: 0,	

	        	id: 0, //<<--For Update only
	        },

	        //Validation Data
	        validationError:{},
	        messageData:{
	        	status :'',
	        	isShow :false,
	        },

	        usersList:{},

	        departmentList:{},
	        userTypeList:{},
	        jobTitleList:{},

	        /*
			var: formAction
			1 = add user
			2 = edit user
			3 = view only
	        */
	        formAction:0,
	        isDisabled:false,
	        isReadOnly:false,
	        isViewOnly:false,
	        formButtonAction:'',
	    }
	}


    export default {
		data: function(){
			return initialData();
		},
		mounted() {
		},
		created() {
			this.getUserList();
			this.getDefaultData();

		},
		beforeUpdate: function(){

		},
		updated: function(){

		},
		watch: {
		    'user.department': function (val) {
		    	this.getJobTitleListByDepartmentId(val);
		    },
		   
	  	},
    	methods: {
    		showModal: function(){
    			$('#formModal').modal({
    			      backdrop: 'static',
    			      keyboard: false
    			    });
    		},
    		hideModal: function(){
    			$('#formModal').modal('hide');
    		},
    		clearForm: function(){
    			let self = this;
    			self.messageData.isShow= false;
    			self.messageData.status = ''; 
    			self.validationError = {};
			 	Object.assign(self.$data.user, initialData().user);
    		},
    		getUserList:function (){
    			var axiosUrl = '/getUserList';
    			let self = this;
    			axios.get(axiosUrl, {}).then(response => {
	        		self.usersList = response.data;
    			}).catch(function(error){
    				

    			})
    		},
    		getDefaultData:function(){
    			let self= this;
    			var axiosUrl = "/getDefaultData";

    			var data = ['department','user_type'];

    			axios.get(axiosUrl, {params: data}).then(response => {
    				var data = response.data;
	        		self.departmentList = data['department'];
	        		self.userTypeList = data['user_type'];
    			}).catch(function(error){
    				

    			});

    		},
    		getJobTitleListByDepartmentId:function (dept_id){
    			var axiosUrl = '/getJobTitleListByDepartmentId';
    			var data= {
    				id: dept_id
    			}
    			let self = this;
    			axios.get(axiosUrl, {params: data}).then(response => {
	        		self.jobTitleList = response.data;
    			}).catch(function(error){
    				

    			})
    		},

    		submitUserForm: function(){
    			if(this.formAction == 1){
	    			//ADD
	    			var axiosUrl = "/createUser";
	    			let self = this;
	    			axios.post(axiosUrl, self.user).then(response => {
	    				var data = response.data;
		        		self.validationError = {};
	    				self.messageData.isShow= true;
	    				self.messageData.status = 1;  
	    				self.messageData.appMessage = 'New user successfully created.';
	    				self.usersList.push(data);
	    				// self.hideModal();
	    			}).catch(function(error){
	    				// Validation error from laravel validation
	    				self.validationError = error.response.data.errors;
	    				// self.messageData.isShow= true;
	    				// self.messageData.status = 0; 
	    				// self.messageData.appMessage = 'Error on saving data.'; 

	    			});

    			}else if(this.formAction == 2){
	    			//EDIT
	    			var axiosUrl = "/updateUser";
	    			let self = this;
	    			axios.put(axiosUrl, self.user).then(response => {
	    				var data = response.data;


	    				var obj = self.usersList.find(function (obj,key) { 
	    					if(obj.id == data['id']){
	    				    	self.usersList[key] = data;
	    					}
	    				});

	    				if(data['id'] == self.user_id){
	    					location.reload();
	    				}

		        		self.validationError = {};
	    				self.messageData.isShow= true;
	    				self.messageData.status = 1;  
	    				self.messageData.appMessage = 'User Successfully updated.';
	    				self.hideModal();
	    			}).catch(function(error){
	    				// Validation error from laravel validation
	    				self.validationError = error.response.data.errors;
	    				// self.messageData.isShow= true;
	    				// self.messageData.status = 0; 
	    				// self.messageData.appMessage = 'Error on saving data.'; 
	    			});
    			}
    		},
    		showEditViewModal(id,action){
    			let self = this;
    			self.showModal();
    			self.formActionMethod(action);
	        	self.validationError = {}

    			if(id != 0){
    			// Find user in user list using id
	    			var obj = self.usersList.find(function (obj) { 
	    			    return obj.id === id; 
	    			});
					self.user['id'] = obj['id'];	
					self.user['firstName']  = obj['first_name'];
					self.user['middleName'] = obj['middle_name'];
					self.user['lastName'] = obj['last_name'];
					self.user['email'] = obj['email'];
					self.user['username'] = obj['username'];
					self.user['contactNo'] = obj['mobile_no'];
					self.user['userType'] = obj['user_type'];
					self.user['department'] = obj['department'];
					self.user['jobTitle'] = obj['job_title'];	
    			}

    		},
    		changeDepartment: function(){
    			this.user['jobTitle'] = 0;
    		},
    		formActionMethod: function(action){
    			this.formAction = action;
    			
    			this.isViewOnly = false;
    			if(action == 1){
    				// Add user
    				this.formButtonAction = "Create User";
    			}else if(action == 2){
    				//Edit user
    				this.formButtonAction = "Update User";
    			}else if(action == 3){
    				// View only
    				this.isViewOnly = true;

    			}
    		}
    		
    	},

    }
</script>
