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
        <tr v-for="user in users" :key="user.id">
            <th scope="row" style="padding-top: 16px;">{{ user.id }}</th>
            <td>
                <form method="post" @submit.prevent="deleteUser(user.id)">
                    <div id="category">
                        <p>{{ user.name }}</p>
                        <input type="submit" class="btn btn-danger" onclick="return confirm('Are you sure ?') " value="Delete">
                        <a class="btn btn-primary" href="#" @click="goToEditUser(user.id)" role="button">Edit</a>
                    </div>
                </form>
            </td>
        </tr>
    </tbody>
    </table>
        <pagination
            :max-visible-buttons="2"
            :render="existUser"
            :total-pages="totalPage"
            :total="totalUser"
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
                existUser: true,
                totalPage: '',
                totalUser: '',
                currentPage: 1,
                message: '',
                error: '' ,
                users: []
            };
        },

        created() {
            axios.get('/admin/userlist')
                .then(response =>{ 
                    this.users = response.data.data
                    this.totalUser = response.data.total
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
                axios.post('/admin/userlist', { page:this.currentPage})
                    .then(response => {
                            this.users = response.data.data
                            this.totalUser = response.data.total
                            this.totalPage = response.data.last_page
                });
            },

            goToEditUser(id) {
                window.location.href = "/admin/user/"+id+'/edit'
            },

            deleteUser(id) {
                axios.delete('/admin/user/'+ id)
                    .then(response => {    
                        if (response.data.error == 'U can delete it') {
                            this.error = response.data.error
                        } else {
                            this.users = response.data.data
                            this.totalUser = response.data.total
                            this.totalPage = response.data.last_page
                        }
                    });
            }
        }
    };
</script>