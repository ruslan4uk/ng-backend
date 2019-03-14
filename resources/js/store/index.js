import Vue from 'vue'
import Vuex from 'vuex'

import error from './global/error'
import guide from './modules/guide'
import article from './modules/article'

import city from './global/city'
import profile from './modules/profile'



Vue.use(Vuex)

const debug = process.env.NODE_ENV !== 'production'


export const store = new Vuex.Store({
    modules: {
        error,
        guide,
        article,
        city,
        profile,
    },

    getters: {},

    mutations: {},

    strict: debug,
})