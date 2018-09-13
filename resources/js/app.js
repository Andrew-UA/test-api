
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import VueRouter from "vue-router";
import App from './App'

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.use(VueRouter);

const UsersTemplate =  Vue.component('users-template', require('./components/pages/user/UsersTemplateComponent.vue'));
const UserViewTemplate = Vue.component('user-view-template', require('./components/pages/user/UserViewTemplateComponent'));
const ProjectsTemplate = Vue.component('projects-template', require('./components/pages/project/ProjectsTemplateComponent'));
const ProjectViewTemplate = Vue.component('project-view-component', require('./components/pages/project/ProjectViewTemplateComponent'));
const ProjectEditTemplate = Vue.component('project-edit-component', require('./components/pages/project/ProjectEditTemplateComponent'));

const routes = [
    {
        name: 'users',
        path: '/users',
        component: UsersTemplate
    },
    {
        name: 'user-view',
        path: '/users/:id',
        component: UserViewTemplate
    },
    {
        name: 'projects',
        path: '/projects',
        component: ProjectsTemplate
    },
    {
        name: 'project-view',
        path: '/projects/:id',
        component: ProjectViewTemplate
    },
    {
        name: 'project-edit',
        path: '/projects/:id/edit',
        component: ProjectEditTemplate
    }
];

const router = new VueRouter(
    {
        mode: 'history',
        routes: routes
    }
);

new Vue ({
    el: '#app',
    components: { App },
    router
});