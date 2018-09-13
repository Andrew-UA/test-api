<template>
    <div>
        <h1>Projects</h1>
        <form>
            <div class="row">
                <div class="col-md-2">
                    <input type="text" class="form-control" placeholder="Name" v-model="name">
                </div>
                <div class="col-md-2">
                    <input type="text" class="form-control" placeholder="Description" v-model="description">
                </div>
                <div class="col-md-2">
                    <select id="inputState" class="form-control" v-model="status">
                        <option disabled>Select status</option>
                        <option v-for="status in statuses" v-bind:value="status">{{ status }}</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select class="form-control" v-model="user_id">
                        <option disabled>Select user</option>
                        <option v-for="user in users" v-bind:value="user.id">{{ user.first_name + ' ' + user.last_name}}</option>
                    </select>
                </div>
                <div class="btn btn-success"
                     v-bind:class="{ disabled: isDisabled}"
                     v-on:click="storeProject"
                >Save</div>
            </div>
        </form>
        <table class="table table-striped" v-if="projects">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Status</th>
                    <th scope="col">User</th>
                    <th scope="col">View</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Remove</th>
                </tr>
            </thead>
            <tbody>

                <tr v-for="(project, index) in projects">
                    <td scope="row">{{ index + 1 }}</td>
                    <td>{{ project.name }}</td>
                    <td>{{ project.description }}</td>
                    <td>{{ project.status }}</td>
                    <td>{{ project.user.first_name + ' ' + project.user.last_name}}</td>
                    <td>
                        <router-link :to="{ name: 'project-view', params: {id: project.id}}"
                                     class="btn btn-info"
                        >View</router-link>
                    </td>
                    <td>
                        <router-link :to="{ name: 'project-edit', params: {id: project.id}}"
                                     class="btn btn-warning"
                        >Edit</router-link>
                    </td>
                    <td>
                        <div class="btn btn-danger" v-on:click="deleteProject(project)">Remove</div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        name: "ProjectsTemplateComponent",
        data: function () {
            return {
                projects: {},
                statuses: {},
                users: {},
                name: '',
                description: '',
                status: '',
                user_id: ''
            }
        },
        methods: {
            getProjects: function() {
                axios.get('api/projects/')
                    .then((response) => {
                        this.projects = response.data.projects;
                        this.statuses = response.data.statuses;
                    });
            },
            storeProject: function() {
                if (this.isDisabled === false) {
                    axios.post('api/projects', {
                        name: this.name,
                        description: this.description,
                        status: this.status,
                        user_id: this.user_id
                    })
                        .then((response) => {
                            if(response.status === 201) {
                                alert(response.data);
                                this.getProjects();
                            }

                            this.name = '';
                            this.description = '';
                            this.status = '';
                            this.user_id = '';
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                }
            },
            deleteProject: function(project) {
                if (confirm('Delete project '+project.name+'?' )) {
                    axios.delete('api/projects/'+project.id)
                        .then((response) =>  {
                            if(response.status === 202) {
                                alert(response.data);
                                this.getProjects();
                            }
                        });
                }
            },
            getUsers: function() {
                axios.get('api/users/')
                    .then((response) => {
                        this.users = response.data;
                    });
            },
        },
        created() {
            this.getProjects();
            this.getUsers();
        },
        computed: {
            isDisabled: function () {
                if (this.name && this.description && this.status && this.user_id) {
                    return false;
                }
                return true;
            }
        }

    }
</script>

<style scoped>

</style>