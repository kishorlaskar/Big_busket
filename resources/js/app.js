
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
require('./bootstrap');

window.Vue = require('vue');

//var Vue = require('vue');
var VueResource = require('vue-resource');
Vue.use(VueResource);

Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('example-component2', require('./components/ExampleComponent2.vue'));

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

//Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
const app = new Vue({
    el: '#app4',
    data :{
    	message:'hello vue',
    	message2:'message2',
    	products:[],
    },
     created(){this.fetchdata();},
    methods:{
    	fetchdata(){
        this.$http.get("all_product_by_uve").then( response => { this.products = response.data.all_product_info});
    	},
    },
});
