/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import TodoSave from "./components/TodoSave";

require('./bootstrap');

window.Vue = require('vue').default;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/TodoList.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('todo-list', require('./components/TodoList.vue').default);
Vue.component('todo-edit', require('./components/TodoEdit.vue').default);
Vue.component('todo-save', require('./components/TodoSave.vue').default);
Vue.component('login', require('./components/Login.vue').default);
Vue.component('register', require('./components/Register.vue').default);

import VueIziToast from "vue-izitoast";
import "izitoast/dist/css/iziToast.css";

Vue.use(VueIziToast);
Vue.config.productionTip = false;

const app = new Vue({
    el: '#app',
});
