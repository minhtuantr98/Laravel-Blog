<template>
<div>
    <div v-if="errors && errors.length" class="alert alert-danger">
            <ul>
                <li v-bind:key="error" v-for="error of errors">
                    {{error.message}}
                </li>
            </ul>
    </div>
    <form action="/admin/category" method="post" @submit.prevent="createCategory()">
        <div class="form-group">
            <input class="form-control" placeholder="Enter Name Category English..." type="text" v-model="name_en"><br>
            <input class="form-control" placeholder="Enter Name Category Japan..." type="text" v-model="name_jp"><br>
            <input class="btn btn-primary" type="submit" value="Create">
        </div>
    </form>
</div>
</template>

<script>
    export default {
        data: function() {
            return {
                name_en: '',
                name_jp: '',
                errors: [] 
            };
        },
        methods:{
            createCategory() {
                axios.post('/admin/category', {name_en:this.name_en, name_jp:this.name_jp})
                    .then(response => {    
                        window.location.href = "/admin/category"
                    })
                    .catch(error => {
                        this.errors = [] 
                        this.errors.push(error);
                    });
            }
        }
    };
</script>
