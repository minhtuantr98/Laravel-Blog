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
    <form action="/admin/profile" method="post" @submit.prevent="editProfile()">
        <div class="form-group">
            <label>User</label><br>
            <input class="form-control" placeholder="Enter Name..." type="text" v-model="name"><br>
            <label>Email</label><br>
            <input class="form-control" placeholder="Enter Email..." type="email" v-model="email">
            <br><input class="btn btn-primary" type="submit" value="Lưu">
        </div>
    </form>
</div>
</template>

<script>
    export default {
        data: function() {
            return {
                message: '',
                errors: []
            };
        },

        props: {
            name: {
                type: String,
                required: true
            },

            email: {
                type: String,
                required: true
            }
        },

        methods:{
            editProfile() {
                axios.put('/admin/profile', {name:this.name, email:this.email})
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
