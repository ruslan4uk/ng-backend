import Vue from 'vue';

import BootstrapVue from 'bootstrap-vue'
Vue.use(BootstrapVue);

import CKEditor from '@ckeditor/ckeditor5-vue'
Vue.use( CKEditor );

import { store } from './store'

window.jsonp = require('jsonp');
window.jsonpAdapter = require('axios-jsonp');

require('./bootstrap');

window.Vue = require('vue');

// constant
window.baseApiUrl = 'admin/api/v1/'


/**
 * CKEditor
 */
import ClassicEditor from '@ckeditor/ckeditor5-build-classic'
import VueCkeditor from 'vue-ckeditor5'

const options = {
  editors: {
    classic: ClassicEditor,
  },
  name: 'ckeditor'
}

Vue.use(VueCkeditor.plugin, options);

// register custom compontns
Vue.component('navigation-toogle', require('./components/general/NavigationToogle.vue').default);
Vue.component('profile-avatar', require('./components/general/ProfileAvatar.vue').default);

// profile
Vue.component('profile-general', require('./components/Profile/ProfileGeneral.vue').default);
Vue.component('profile', require('./components/Profile/Profile.vue').default);

// Tour profile (edit)
Vue.component('tour', require('./components/Tour/Tour.vue').default);

// Frontend guide contact component
Vue.component('guide-contact', require('./components/Frontend/Guide/GuideContact.vue').default)

// Main search ajax (vue)
Vue.component('main-search', require('./components/Frontend/MainSearch.vue').default)


const app = new Vue({
    el: '#app',
    store,
});


// main tabs 
$(document).on('click', '[data-tab]', function(){

  var current = $(this).data('tab')
  
  $('[data-tab]').removeClass('active')
  $(this).addClass('active')

  $('.main-tabs').addClass('d-none')
  $('.main-tabs-' + current).removeClass('d-none')
});


/**
 * fix Google Chrome anchor navigation
 */
$(document).ready(function () {
  var isChrome = /Chrome/.test(navigator.userAgent) && /Google Inc/.test(navigator.vendor);
  if (window.location.hash && isChrome) {
      setTimeout(function () {
          var hash = window.location.hash;
          window.location.hash = "";
          window.location.hash = hash;
      }, 300);
  }
});