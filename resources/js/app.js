import BootstrapVue from 'bootstrap-vue'
window.jsonp = require('jsonp');

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

// My jquery code
require('./app.jquery');



window.Vue = require('vue');



Vue.use(BootstrapVue);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('services-list', require('./components/admin/ServicesList.vue').default);
Vue.component('guide-list', require('./components/admin/GuideList.vue').default);
Vue.component('guide-profile-show', require('./components/admin/GuideProfileShow.vue').default);
Vue.component('guide-profile-show-phone', require('./components/admin/GuideProfileShowPhone.vue').default);
Vue.component('guide-profile-other', require('./components/admin/GuideProfileOther.vue').default);



window.config = {
    'dadata': {
        'token': '269a9f62065bb9d83dde8c9365becab8ed74225d'
    }
};

const app = new Vue({
    el: '#app'
});

