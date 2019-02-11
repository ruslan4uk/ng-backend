import Vue from 'vue';
import VueRouter from 'vue-router';
import router from './router/router';
import { store } from './store'

import BootstrapVue from 'bootstrap-vue'

import CKEditor from '@ckeditor/ckeditor5-vue'

window.jsonp = require('jsonp');

Vue.use(BootstrapVue);
Vue.use(VueRouter);
Vue.use( CKEditor );

require('./bootstrap');

require('./app.jquery');

window.Vue = require('vue');


// constant
window.vk_access_token = '8edd56e88edd56e88edd56e8958eb535d488edd8edd56e8d28f98681c168aaf8c0b8785';
window.baseApiUrl = 'admin/api/v1/'



// file upload component
// const VueUploadComponent = require('vue-upload-component')
// Vue.component('file-upload', VueUploadComponent)

// old
Vue.component('services-list', require('./components/admin/ServicesList.vue').default);
// Vue.component('guide-list', require('./components/admin/GuideList.vue').default);
// Vue.component('guide-profile-show', require('./components/admin/GuideProfileShow.vue').default);
// Vue.component('guide-profile-show-phone', require('./components/admin/GuideProfileShowPhone.vue').default);
// Vue.component('guide-profile-other', require('./components/admin/GuideProfileOther.vue').default);

//new
Vue.component('giude-profile-index', require('./components/Guide/GuideProfileIndex.vue').default);


const app = new Vue({
    el: '#app',
    store,
    router,
});

