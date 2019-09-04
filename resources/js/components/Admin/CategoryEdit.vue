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
     <form :action="this.putUrl" method="post" @submit.prevent="editCategory()">
         <span  :key="category.id" v-for="category in categories">
                            <label >{{ category.locale }}</label>
                            <input  class="form-control" type="text" v-model="category.name" placeholder="Enter Category Name...."><br>
        </span>
        <input class="btn btn-primary" type="submit" value="Edit">
    </form>
</div>
</template>

<script>
    export default {
        data: function() {
            return {
                message: '',
                errors: [] ,
                putUrl : '/admin/category/'+this.categories[0].category_id,           
            };
        },

        props: {
            categories: {
                type: [Object,Array],
            },
        },

        methods:{
            editCategory() {
                axios.put(this.putUrl, {name_en:this.categories[0].name, name_jp: this.categories[1].name})
                    .then(response => {    
                        this.errors = [] 
                        this.message = response.data.message
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
