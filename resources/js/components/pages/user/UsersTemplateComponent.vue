<template>
    <div>
        <h1>Users</h1>
        <form>
            <div class="row">
                <div class="col-md-2">
                    <input type="text" class="form-control" placeholder="First name" v-model="first_name">
                </div>
                <div class="col-md-2">
                    <input type="text" class="form-control" placeholder="Last name" v-model="last_name">
                </div>
                <div class="col-md-2">
                    <input type="text" class="form-control" placeholder="Email" v-model="email">
                </div>
                <div class="col-md-2">
                    <input type="password" class="form-control" placeholder="Password" v-model="password">
                </div>
                <div class="btn btn-success"
                     v-bind:class="{ disabled: isDisabled}"
                     v-on:click="storeUser"
                >Save</div>
            </div>
        </form>
        <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">First name</th>
            <th scope="col">Last Name</th>
            <th scope="col">Email</th>
            <th scope="col">Edit</th>
            <th scope="col">Remove</th>
        </tr>
        </thead>
        <tbody>
            <tr v-for="(user, index) in users">
                <th scope="row">{{ index + 1 }}</th>
                <td>{{ user.first_name }}</td>
                <td>{{ user.last_name }}</td>
                <td>{{ user.email }}</td>
                <td>
                    <router-link :to="{ name: 'user-view', params: {id: user.id}}"
                                 class="btn btn-info"
                    >View</router-link>
                </td>
                <td>
                    <div class="btn btn-danger" v-on:click="deleteUser(user)">Remove</div>
                </td>
            </tr>
        </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        name: "UsersTemplateComponent",
        data: function () {
            return {
                users: {},
                first_name : '',
                last_name: '',
                email: '',
                password: ''
            }
        },
        methods: {
            getUsers: function() {
                axios.get('api/users/')
                    .then((response) => {
                       this.users = response.data;
                    });
            },
            storeUser: function() {
                if (this.isDisabled === false) {
                    axios.post('api/users', {
                        first_name: this.first_name,
                        last_name: this.last_name,
                        email: this.email,
                        password: this.password
                    })
                        .then((response) => {
                            if(response.status === 201) {
                                this.getUsers();
                            }

                            this.first_name = '';
                            this.last_name = '';
                            this.email = '';
                            this.password = '';
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                }
            },
            deleteUser: function(user) {
                if (confirm('Delete user '+user.first_name+' '+user.last_name+'?' )) {
                    axios.delete('api/users/'+user.id)
                        .then((response) =>  {
                            if(response.status === 202) {
                                this.getUsers();
                            }
                        });
                }
            }
        },
        created() {
            this.getUsers();
        },
        computed: {
            isDisabled: function () {
                if (this.first_name && this.last_name && this.email && this.password) {
                    return false;
                }
                return true;
            }
        }


    }
</script>

<style scoped>

</style>