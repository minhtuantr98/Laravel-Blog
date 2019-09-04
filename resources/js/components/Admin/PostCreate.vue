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
    <form action="/admin/post" method="post" @submit.prevent="createPost()">
        <label>Title Post in English</label>
        <input class="form-control" placeholder="Enter Title Post English..." type="text" v-model="title_en" ><br>
        <label>Title Post in Japanese</label>
        <input class="form-control" placeholder="Enter Title Post Japanese..." type="text" v-model="title_jp" ><br>
        <label>Content Post in English</label>
        <textarea class="form-control" placeholder="Enter Content Post English..." v-model="content_en"></textarea>
        <label>Content Post in Japanese</label>
        <textarea class="form-control" placeholder="Enter Content Post Japanese..." v-model="content_jp"></textarea>
        <br><label>Category</label>
        <select v-model="selected">
            <option :key="category.id" v-for="category in categories" :value="category.category_id" >
                {{ category.name }}
            </option>
        </select><br>
        <br><label>Status</label>
        <input type="checkbox" :v-model="active" value="1" @change="change()"/><br><br>
        <label for="">Time Publish</label>
        <div class='input-group date' id='datetimepicker1'>
            <input v-model="published"  type='text' class="form-control" />
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
        </div><br>
        <input class="btn btn-primary" type="submit" value="Create">
    </form>
</div>
</template>
<script language="javascript">
    export default {
        data: function() {
            return {
                title_en: '',
                title_jp: '',
                content_en: '',
                content_jp: '',
                active: 0,
                message: '',
                published: '',
                errors: [] ,
                selected: 0 ,
            };
        },
        props: {
            categories: {
                type: [Object,Array]
            },
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
            createPost() {
                axios.post('/admin/post', {title_en:this.title_en,title_jp:this.title_jp, content_en:this.content_en, content_jp:this.content_jp , category:this.selected, active:this.active, published:this.published})
                    .then(response => {    
                        window.location.href = "/admin/post"
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
