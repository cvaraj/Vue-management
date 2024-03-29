<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PHP| MySQL | Vue.js | Axios Example</title>
    <script src="https://cdn.jsdelivr.net/npm/vue"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/style.css">

</head>
<body>

	<h1>Employee Management</h1>
	<div id='vueapp'>
	<div class="left">	
	<table width='100%' style='border-collapse: collapse;'>
	   <tr>
	   	<th>Id</th>
	     <th>Name</th>
	     <th>Email</th>
	     <th>Country</th>
	     <th>City</th>
	     <th>Job</th>

	   </tr>

	   <tr v-for='(contact,index) in contacts'>
	   	 <td>{{ contact.id }}</td>
	     <td>{{ contact.name }}</td>
	     <td>{{ contact.email }}</td>
	     <td>{{ contact.country }}</td>
	     <td>{{ contact.city }}</td>
	     <td>{{ contact.job }}</td>
	     <td><input type='button' value='Delete' @click='deleteRecord(index,contact.id)'></td>
	   </tr>


	 </table>
	</div>
	<div class="right">
	 <form method="post">
      <label>Name</label>
      <input type="text" name="name" v-model="name">
	</br>
	      <label>Email</label>
	      <input type="email" name="email" v-model="email">
	      </br>
	      <label>Country</label>
	      <input type="text" name="country" v-model="country">
	      </br>
	      <label>City</label>
	      <input type="text" name="city" v-model="city">
	      </br>
	      <label>Job</label>
	      <input type="text" name="job" v-model="job">
	      </br>
	      <input type="button" @click="createContact()" value="Add">
	      <input type="button" @click="resetForm()" value="reset">
	      
	    </form>
	</div>

	</div>

	<script>
	var app = new Vue({
	  el: '#vueapp',
	  data: {
	      name: '',
	      email: '',
	      country: '',
	      city: '',
	      job: '',
	      contacts: []
	  },
	  mounted: function () {
	    console.log('Hello from Vue!')
	    this.getContacts()
	  },

	  methods: {
	    getContacts: function(){
	        axios.get('api/contacts.php')
	        .then(function (response) {
	            console.log(response.data);
	            app.contacts = response.data;

	        })
	        .catch(function (error) {
	            console.log(error);
	        });
    	},
	    createContact: function(){
	    	console.log("Create contact!")

	        let formData = new FormData();
	        //console.log(formData);
	        console.log("name:", this.name)
	        //alert("name:", this.name);
	        formData.append('name', this.name)
	        formData.append('email', this.email)
	        formData.append('city', this.city)
	        formData.append('country', this.country)
	        formData.append('job', this.job)

	        var contact = {};
	        formData.forEach(function(value, key){
	            contact[key] = value;
	        });


	        axios({
	            method: 'post',
	            url: 'api/contacts.php',
	            data: formData,
	            config: { headers: {'Content-Type': 'multipart/form-data' }}
	        })
	        .then(function (response) {
	            //handle success
	            console.log(response)
	            app.contacts.push(contact)
	            app.resetForm();
	        })
	        .catch(function (response) {
	            //handle error
	            console.log(response)
	        });
	    },
	    resetForm: function(){
	    	this.name = '';
	        this.email = '';
	        this.country = '';
	        this.city = '';
	        this.job = '';
	    },
	    deleteRecord: function(index,id){
 		
	     axios.post('api/delete.php', {
	       request: 2,
	       id: id
	       
	     })
	     .then(function (response) {

	       // Remove index from users
	        app.contacts.splice(index, 1);
	       console.log(response.data);
	     })
	     .catch(function (error) {
	       console.log(error);
	     });
	 
	    } 
	  },

 
	})    
	</script>
</body>
</html> 
