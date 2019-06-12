



export default {
	
	methods:{

		 async getDefaultData(data){
			let self= this;
			var axiosUrl = "/getDefaultData";

			await axios.get(axiosUrl, {params: data}).then(response => {
				self.defaultData = response.data;
			}).catch(function(error){
				
			});
		},

		getUsersListByDeparment(data){
			let self= this;
			var axiosUrl = "/getUsersListByDeparment";
			axios.get(axiosUrl, {params: data}).then(response => {
				self.defaultData['user_list'] = response.data;
		    	self.$forceUpdate();
			}).catch(function(error){
				
			});
		},


		
	}
}
