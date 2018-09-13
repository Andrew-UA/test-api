<template>
    <div>
        <h1>User view</h1>

        <form>
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">First name</label>
                <div class="col-sm-10">
                    <input type="text" readonly class="form-control-plaintext" id="staticEmail" v-model="user.first_name">
                </div>
            </div>
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Lats name</label>
                <div class="col-sm-10">
                    <input type="text" readonly class="form-control-plaintext" id="staticEmail" v-model="user.last_name">
                </div>
            </div>
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="text" readonly class="form-control-plaintext" id="staticEmail" v-model="user.email">
                </div>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        name: "UserViewTemplateComponent",
        data: function () {
            return {
                user: {
                    id: '',
                    first_name: '',
                    last_name:' ',
                    email: ''
                },
            }
        },
        methods: {
            getUser: function(id) {
                axios.get('/api/users/'+id)
                    .then((response) => {
                        this.user = response.data;
                    });
            },
        },
        created() {
            this.getUser(this.$route.params.id);
        },
    }
</script>

<style scoped>

</style>