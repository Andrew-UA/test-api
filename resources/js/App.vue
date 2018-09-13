<template>
    <div>
        <ul class="nav nav-pills">
            <li class="nav-item">
                <router-link :to="{ name: 'users'}"
                             active-class="active"
                             class="nav-link"
                >Users</router-link>
            </li>
            <li class="nav-item">
                <router-link :to="{ name: 'projects'}"
                             active-class="active"
                             class="nav-link"
                >Projects</router-link>
            </li>
        </ul>
        <router-view></router-view>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                activeIndex: '1',
                activeIndex2: '1'
            };
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
