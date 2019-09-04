/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

// require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

Vue.component('profile-edit', require('./components/Admin/ProfileEdit.vue').default);

Vue.component('password-edit', require('./components/Admin/PasswordEdit.vue').default);

Vue.component('category-index', require('./components/Admin/CategoryIndex.vue').default);

Vue.component('category-edit', require('./components/Admin/CategoryEdit.vue').default);

Vue.component('category-create', require('./components/Admin/CategoryCreate.vue').default);

Vue.component('user-index', require('./components/Admin/UserIndex.vue').default);

Vue.component('user-create', require('./components/Admin/UserCreate.vue').default);

Vue.component('user-profile', require('./components/Admin/UserProfile.vue').default);

Vue.component('user-password', require('./components/Admin/UserPassword.vue').default);

Vue.component('post-index', require('./components/Admin/PostIndex.vue').default);

Vue.component('post-edit', require('./components/Admin/PostEdit.vue').default);

Vue.component('post-create', require('./components/Admin/PostCreate.vue').default);

var Paginate = require('vuejs-paginate');

Vue.component('paginate', Paginate)

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
