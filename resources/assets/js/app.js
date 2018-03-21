import Vue from 'vue';
import VueRouter from 'vue-router';
import App from './AppMain.vue';
import { routes } from './routes';
Vue.use(VueRouter);

require('./bootstrap');

window.Vue = require('vue');

Vue.use(VueRouter);
const router = new VueRouter({
    mode: 'history',
    routes
});

const app = new Vue({
    el: '#app',
    router,
    template: '<App/>',
    components: { App },
});

export {app, router}