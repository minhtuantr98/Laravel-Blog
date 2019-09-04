<template>
<div>
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
    <form :action="this.putUrl" method="post" @submit.prevent="editPassword()">
            <div class="form-group">
            <label>New-Password</label>
            <input class="form-control" placeholder="Enter Password..." type="password" v-model="password"><br>
            <label>Enter the password</label>
            <input type="password" class="form-control" placeholder="Enter Password Again..." v-model="password_confirmation"><br>
            <input class="btn btn-primary" type="submit" value="Lưu">
            </div>
    </form>
</div>
</template>
<script>
import { type } from 'os';
    export default {
        data: function() {
            return {
                password: '',
                password_confirmation: '',
                message: '',
                errors: [] ,
                putUrl: '/admin/user/password/'+this.id
            };
        },
        props: {
            id:{ 
            type: Number,
            required:true
            }
        },
        methods:{
            editPassword() {
                axios.put(this.putUrl, {password:this.password,password_confirmation:this.password_confirmation})
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
