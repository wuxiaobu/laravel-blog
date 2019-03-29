
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import ElementUI from 'element-ui';
import VueRouter from 'vue-router';

//安装 Vue.js 插件
Vue.use(ElementUI);
Vue.use(VueRouter);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

//注册或获取全局组件。注册还会自动使用给定的id设置组件的名称
Vue.component('example-component', require('./components/ExampleComponent.vue'));

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
import App from './app.vue';
import Login from './components/user/login.vue';
import Index from './components/main/index.vue';
import Dashboard from './components/main/dashboard.vue';
import Category from './components/category.vue';

const routes = [
    {
        path: '/login',
        component: Login,
        hidden: true
    },
    {
        path: '/',
        component: Index,
        name:'',
        iconCls: 'fa fa-home',
        leaf: true,
        children: [
            {path: '/index', component: Dashboard, name: '仪盘表'}
        ]
    },
    {
        path: '/',
        component: Index,
        name:'文章', //命名路由,过一个名称来标识一个路由显得更方便一些，特别是在链接一个路由
        iconCls: 'fa fa-file-word-o',
        children: [
           
            {path: '/article/category', component: Category, name: '分类管理'},
           
        ]
    },
];

// 创建 router 实例，然后传 `routes` 配置
const router = new VueRouter({
    history: true,
    routes // (缩写) 相当于 routes: routes
});

// 创建和挂载根实例。
// 记得要通过 router 配置参数注入路由，
// 从而让整个应用都有路由功能
const app = new Vue({
    el: '#app',
    router,
    render: h => h(App)
}).$mount('#app');

// 现在，应用已经启动了！

//通过注入路由器，我们可以在任何组件内通过 this.$router 访问路由器，也可以通过 this.$route 访问当前路由：