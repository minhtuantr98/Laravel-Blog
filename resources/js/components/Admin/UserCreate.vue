<template>
<div>
    <form action="/admin/user" method="post" @submit.prevent="createUser()">
        <div class="form-group">
        <label>Name</label>
        <input class="form-control" placeholder="Enter Name..." type="text" v-model="name" ><br>
        <label>Email</label>
        <input class="form-control" placeholder="Enter Email..." type="email" v-model="email" ><br>
        <label>Password</label>
        <input class="form-control" placeholder="Enter Password..." type="password" v-model="password"><br>
        <label>Enter Password</label>
        <input class="form-control" placeholder="Enter Password Again..." type="password" v-model="password_confirmation" ><br>
        <label>Admin</label>
        <input type="checkbox" v-model="admin" value="1"><br>  
        <input class="btn btn-primary" type="submit" value="Create">
        </div>
    </form>
    
</div>
</template>

<script>
    export default {
        data: function() {
            return {
                name: '',
                email: '',
                password: '',
                password_confirmation: '',
                admin: 0,
                errors: [] 
            };
        },
        methods:{
            createUser() {
                axios.post('/admin/user', {name:this.name,email:this.email,password:this.password,password_confirmation:this.password_confirmation,admin:this.admin})
                    .then(response => {    
                        window.location.href = "/admin/user"
                    })
                    .catch(error => {
                        this.errors = [] 
                        this.errors.push(error);
                    });
            }
        }
    };
</script>
