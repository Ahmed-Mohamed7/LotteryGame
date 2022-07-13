/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");
window.Vue = require("vue").default;


import App from './App.vue';
import VueAxios from 'vue-axios';
import axios from 'axios';
Vue.use(VueAxios, axios);

const app = new Vue(Vue.util.extend(App)).$mount('#app');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component(
//     "example-component",
//     require("./components/ExampleComponent.vue").default
// );
// Vue.component(
//     "secret-component",
//     require("./components/SecretComponent.vue").default
// );

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// const app = new Vue({
//     el: '#app',
// // });
// Vue.component('Home', require('./components/Home.vue').default);
// window.Vue = require("Vue").default;

// import App from "./App.vue";
// import Home from "../js/components/Home";
// import Navbar from "../js/components/Navbar";
// import ContactList from "../js/components/ContactList";
// // import SecretComponent from "../js/components/SecretComponent";
// import VueAxios from "vue-axios";
// import axios from "axios";

// import { createRouter, createWebHistory } from "vue-router";

// // Vue.use(VueRouter);
// import Vue from "vue";
// import { times } from "lodash";

// Vue.use(VueAxios, axios);

// const routes = [
//     { name: "/", path: "/", component: Home },
//     { name: "login", path: "/login", component: Home },
// ];
// const router = createRouter({
//     history: createWebHistory(),
//     routes,
// });
// // const app = new Vue(Vue.util.extend({router},App).$mount("#app"));

// const app = new Vue({
//     el: "#app",
//     router,
// }).$mount("#app");
// console.log("Vue");

