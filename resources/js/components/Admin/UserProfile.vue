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
    <form :action="this.putUrl" method="post" @submit.prevent="editUser()">
        <div class="form-group">
            <label>User</label>
            <input class="form-control" placeholder="Enter Name..." type="text" v-model="name"  ><br>
            <label>Email</label>
            <input class="form-control" placeholder="Enter Email..." type="text" v-model="email" ><br>
            <input class="btn btn-primary" type="submit" value="Lưu"><br>
        </div>
    </form>
</div>
</template>

<script>
    export default {
        data: function() {
            return {
                message: '',
                errors: [],
                putUrl: '/admin/user/'+this.id
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
            },

            id: {
                type:Number,
                required:true
            }
        },

        methods:{
            editUser() {
                axios.put(this.putUrl, {name:this.name, email:this.email})
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
