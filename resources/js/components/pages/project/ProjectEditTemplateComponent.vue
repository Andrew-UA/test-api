<template>
    <div>
        <h1>Project edit</h1>
        <form v-if="project && users">
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="staticEmail" v-model="project.name">
                </div>
            </div>
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Description</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="staticEmail" v-model="project.description">
                </div>
            </div>
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Status</label>
                <div class="col-sm-4">
                    <select class="form-control" v-model="project.status">
                        <option disabled>Select status</option>
                        <option v-for="status in project.statuses" v-bind:value="status">{{ status }}</option>
                    </select>
                </div>

            </div>
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">User</label>
                <div class="col-sm-4">
                    <select class="form-control" v-model="project.user_id">
                        <option disabled>Select user</option>
                        <option v-for="user in users" v-bind:value="user.id">{{ user.first_name + ' ' + user.last_name}}</option>
                    </select>
                </div>
            </div>
            <div class="btn btn-success" v-on:click="updateProject" v-bind:class="{ disabled: isDisabled}">Save</div>
        </form>
    </div>
</template>

<script>
    export default {
        name: "ProjectEditTemplateComponent",
        data: function () {
            return {
                project: '',
                users: ''
            }
        },
        methods: {
            getProject: function(id) {
                axios.get('/api/projects/'+id)
                    .then((response) => {
                        this.project = response.data;
                    });
            },
            getUsers: function() {
                axios.get('/api/users/')
                    .then((response) => {
                        this.users = response.data;
                    });
            },
            updateProject: function () {
                if (!this.isDisabled) {
                    axios.put('/api/projects/'+ this.project.id, {
                        name: this.project.name,
                        description: this.project.description,
                        status: this.project.status,
                        user_id: this.project.user_id
                    }).then((response) => {
                        if(response.status === 202) {
                            alert(response.data);
                            this.$router.push({ name: 'projects'});
                        }
                    });
                }
            }
        },
        created() {
            this.getProject(this.$route.params.id);
            this.getUsers();
        },
        computed: {
            isDisabled: function () {
                if (this.project.name && this.project.description && this.project.status && this.project.user_id) {
                    return false;
                }
                return true;
            }
        }
    }
</script>

<style scoped>

</style>