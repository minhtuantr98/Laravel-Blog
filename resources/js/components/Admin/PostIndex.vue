<template>
    <div >
    <form  method="get" >
       <div id="search">
            <input type="text" placeholder="Search...." v-model="search">
            <select  v-model="status">
                <option value="" selected>----</option>
                <option value="1">Active</option>
                <option value="0">In-active</option>
            </select>  
            <button type="submit" @click.prevent="searchPost()" class="btn btn-secondary">Search</button>
       </div>
    </form>
    <div v-if="error && error.length" class="alert alert-danger">
                    {{error}}
    </div>
    <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                      </tr>
                    </thead>
    <tbody>
        <tr v-for="post in posts" :key="post.id">
            <th scope="row" style="padding-top: 16px;">{{ post.id }}</th>
            <td> 
                <form method="post" @submit.prevent="deletePost(post.post_id)">
                    <div id="category">
                        <p>{{ post.title }}</p>
                        <input type="submit" class="btn btn-danger" onclick="return confirm('Are you sure ?')" value="Delete">
                        <a class="btn btn-primary" href="#" @click="goToEditPost(post.post_id)" role="button">Edit</a>
                    </div>
                </form>
            </td>
        </tr>
    </tbody>
    </table>
        <pagination
            :render="existPost"
            :total-pages="totalPage"
            :total="totalPosts"
            :current-page="currentPage"
            @pagechanged="onPageChange"
        ></pagination>
    </div>
</template>

<script>
    import Pagination from './Pagination'
    export default {
        data: function() {
            return {
                existPost: true,
                totalPage: '',
                totalPosts: '',
                currentPage: 1,
                search: '',
                status: '',
                error: '' ,
                posts: [],
            };
        },

        created() {
            axios.get('/admin/postlist')
                .then(response =>{ 
                    this.posts = response.data.data
                    this.totalPosts = response.data.total
                    this.totalPage = response.data.last_page
                    })
        },
        
        components: {
            pagination: Pagination,
        },

        methods:{
            searchPost() {
                axios.post('/admin/postlist', {search:this.search, active:this.status})
                .then(response => {
                    if (response.data.data == '') {
                        this.posts = response.data[0]
                        this.error = 'Not Found!'
                        this.existPost = false 
                    } else {
                        this.error = ''
                        this.posts = response.data.data
                        this.totalPosts = response.data.total
                        this.totalPage = response.data.last_page
                        this.existPost = true
                    }
                });
            },

            onPageChange(page) {
                console.log(page)
                this.currentPage = page;
                axios.post('/admin/postlist', {search:this.search, active:this.status, page:this.currentPage})
                    .then(response => {
                        this.posts = response.data.data
                        this.totalPosts = response.data.total
                        this.totalPage = response.data.last_page
                });
            },
            
            goToEditPost(id) {
                window.location.href = "/admin/post/"+id+'/edit'
            },

            deletePost(id) {
                axios.delete('/admin/post/'+id)
                    .then(response => {    
                        this.posts = response.data.data
                        this.totalPosts = response.data.total
                        this.totalPage = response.data.last_page
                    });
            }
        },
    
    };
</script>

<style>
    #search { 
        float: right;
        margin-top: -47px ;
        margin-right: 5px;
    }
</style>
