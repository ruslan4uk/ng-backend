import Vue from 'vue';
import Router from 'vue-router';
import Main from '../components/AdminPanel/Main'

import articleRoutes from '../components/AdminPanel/Article/route/router';



Vue.use(Router);

const baseRoutes = [
    {
        path: '/',
        name: 'index',
        title: 'Dashboard',
        component: Main,
    },
  ];

const routes = baseRoutes.concat(articleRoutes);

export default new Router({
  routes,
});