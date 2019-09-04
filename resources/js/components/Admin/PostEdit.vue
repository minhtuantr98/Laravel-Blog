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
    <form :action="this.putUrl" method="post" @submit.prevent="editPost()">
        <span  :key="post.id" v-for="post in posts">
            <label>Title Post {{ post.locale }}</label>
            <input class="form-control" placeholder="Enter Title Post..." type="text" v-model="post.title" ><br>
            <label>Content Post {{ post.locale }}</label>
            <textarea class="form-control" placeholder="Enter Content Post..."  v-model="post.content"></textarea><br>
        <label>Category</label>
        </span>
        <select v-model="selected">
            <option :key="category.id" v-for="category in categories" :value="category.id" >
                {{ category.name }}
            </option>
        </select><br>
        <br><label>Status</label>
        <input type="checkbox" :checked="active==1" value="1" @click="change()"/><br><br>
        <label>Time Publish</label>
        <div class='input-group date' id='datetimepicker1'>
            <input v-model="published"  type='text' class="form-control" />
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
        </div><br> 
        <input class="btn btn-primary" type="submit" value="Edit">
    </form>
</div>
</template>
<script language="javascript">
    export default {
        data: function() {
            return {
                selected: this.$attrs['categoryid'],
                message: '',
                errors: [] ,
                putUrl: '/admin/post/'+this.id ,
            };
        },
          
        props: {
            posts: {
                type: [Object,Array]
            },

            id: {
                type: String,
                required: true
            },

            categoryId: {
                type: String,
                required: true
            },

            categories: {
                type: [Object,Array],
            },

            active: {
                type: String,
               
            },

            published: {
                type: String,
                required: true
            }
        },
        
        created: function() {
             $(function () {
                $('#datetimepicker1').datetimepicker({
                    format: "YYYY-MM-DD H:m:s",
                });
            });
        },

        methods:{
            change() {
                if(this.active==0) 
                {
                    this.active=1
                } else {
                    this.active=0
                }
            },
            editPost() {
                axios.put(this.putUrl, {title_en:this.posts[0].title, title_jp:this.posts[1].title, id:this.id, content_en:this.posts[0].content, content_jp:this.posts[1].content, category:this.selected, active:this.active, published:this.published})
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
