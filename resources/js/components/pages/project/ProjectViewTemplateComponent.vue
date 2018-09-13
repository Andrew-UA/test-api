<template>
    <div>
        <h1>Project view</h1>
        <form v-if="project">
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-10">
                    <input type="text" readonly class="form-control-plaintext" id="staticEmail" v-model="project.name">
                </div>
            </div>
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Description</label>
                <div class="col-sm-10">
                    <input type="text" readonly class="form-control-plaintext" id="staticEmail" v-model="project.description">
                </div>
            </div>
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Status</label>
                <div class="col-sm-10">
                    <input type="text" readonly class="form-control-plaintext" id="staticEmail" v-model="project.status">
                </div>
            </div>
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">User</label>
                <div class="col-sm-10">
                    <input type="text"
                           readonly class="form-control-plaintext"
                           v-model="project.user.first_name + ' ' + project.user.last_name">
                </div>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        name: "ProjectViewTemplateComponent",
        data: function () {
            return {
                project: '',
            }
        },
        methods: {
            getProject: function(id) {
                axios.get('/api/projects/'+id)
                    .then((response) => {
                        this.project = response.data;
                    });
            },
        },
        created() {
            this.getProject(this.$route.params.id);
        },
    }
</script>

<style scoped>

</style>