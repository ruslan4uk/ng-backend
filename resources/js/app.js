import Vue from 'vue';
import { store } from './store'
import axios from 'axios';
import BootstrapVue from 'bootstrap-vue'
import {getField,updateField} from 'vuex-map-fields'



window.jsonp = require('jsonp');
Vue.use(BootstrapVue);

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

// My jquery code
require('./app.jquery');

window.Vue = require('vue');




// file upload component
// const VueUploadComponent = require('vue-upload-component')
// Vue.component('file-upload', VueUploadComponent)

// old
// Vue.component('services-list', require('./components/admin/ServicesList.vue').default);
// Vue.component('guide-list', require('./components/admin/GuideList.vue').default);
// Vue.component('guide-profile-show', require('./components/admin/GuideProfileShow.vue').default);
// Vue.component('guide-profile-show-phone', require('./components/admin/GuideProfileShowPhone.vue').default);
// Vue.component('guide-profile-other', require('./components/admin/GuideProfileOther.vue').default);

//new
Vue.component('giude-profile-index', require('./components/Guide/GuideProfileIndex.vue').default);


const app = new Vue({
    el: '#app',
    store,
});

