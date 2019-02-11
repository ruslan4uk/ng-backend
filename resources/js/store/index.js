import Vue from 'vue'
import Vuex from 'vuex'
import { getField, updateField } from 'vuex-map-fields'
import guide from './modules/guide'

import article from '../components/AdminPanel/Article/store'



Vue.use(Vuex)

const debug = process.env.NODE_ENV !== 'production'


export const store = new Vuex.Store({
  modules: {
    guide,
    article,
  },
  strict: debug,

  getters: {
    getField,
  },
  mutations: {
    updateField,
  },
})