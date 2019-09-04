<template>
    <div>
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
        <tr v-for="category in categories" :key="category.id">
            <th scope="row" style="padding-top: 16px;">{{ category.category_id }}</th>
            <td>
                <form method="post" @submit.prevent="deleteCategory(category.category_id)">
                    <div id="category">
                        <p>{{ category.name }}</p>
                        <input type="submit" class="btn btn-danger" onclick="return confirm('Are you sure ?') " value="Delete">
                        <a class="btn btn-primary" href="#" @click="goToEditPost(category.category_id)" role="button">Edit</a>
                    </div>
                </form>
            </td>
        </tr>
    </tbody>
    </table>
        <pagination
            :max-visible-buttons="2"
            :render="existCategory"
            :total-pages="totalPage"
            :total="totalCategory"
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
                existCategory: true,
                totalPage: '',
                totalCategory: '',
                currentPage: 1,
                message: '',
                error: '' ,
                categories: []
            };
        },

        created() {
            axios.get('/admin/categorylist')
                .then(response =>{ 
                    this.categories = response.data.data
                    this.totalCategory = response.data.total
                    this.totalPage = response.data.last_page
                    })
        },
        
        components: {
            pagination: Pagination,
        },

        methods:{
            onPageChange(page) {
                console.log(page)
                this.currentPage = page;
                axios.post('/admin/categorylist', {search:this.search, active:this.status, page:this.currentPage})
                    .then(response => {
                            this.categories = response.data.data
                            this.totalCategory = response.data.total
                            this.totalPage = response.data.last_page 
                });
            },

            goToEditPost(id) {
                window.location.href = "/admin/category/"+id+'/edit'
            },

            deleteCategory(id) {
                axios.delete('/admin/category/'+ id)
                    .then(response => {    
                        if (response.data.error == 'U can delete it') {
                            this.error = response.data.error
                        } else {
                            this.categories = response.data.data
                            this.totalCategory = response.data.total
                            this.totalPage = response.data.last_page 
                        }
                    });
            }
        }
    };
</script>