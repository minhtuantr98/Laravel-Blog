<template>
<div class="container">
    <div v-if="message && message.length" class="alert alert-success">
            <ul>
                <li>{{ message }}</li>
            </ul>
    </div>
    <div v-if="errors && errors.length" class="alert alert-danger">
            <ul>
                <li v-bind:key="error" v-for="error of errors">
                    {{error.message}}
                </li>
            </ul>
    </div>
    <form action="/admin/password" method="post" @submit.prevent="editPassword()">
        <div class="form-group">
            <label>Old-Password</label>
            <input class="form-control" placeholder="Enter Old Password..." type="password" v-model="old_password"><br>
            <label>New-Password</label>
            <input class="form-control" placeholder="Enter New Password..." type="password" v-model="password"><br>
            <label>Enter the password</label>
            <input class="form-control" placeholder="Enter Password Again..." type="password" v-model="password_confirmation">
            <br><input class="btn btn-primary" type="submit" value="Lưu">
        </div>
    </form>
</div>
</template>

<script>
    export default {
        data: function() {
            return {
                old_password: '',
                password: '',
                password_confirmation: '',
                message: '',
                errors: []
            };
        },

        methods:{
            editPassword() {
                axios.put('/admin/password', {old_password:this.old_password,password:this.password,password_confirmation:this.password_confirmation})
                    .then(response => {    
                        this.errors = [] 
                        this.message = response.data.message
                        console.log(response.data.message)
                    })
                    .catch(error => {
                        this.message = ''
                        this.errors = [] 
                        this.errors.push(error);
                    });
            }
        }
    };
</script>
