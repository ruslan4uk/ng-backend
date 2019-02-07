import Vue from 'vue'
import Vuex from 'vuex'
// import axios from 'axios'
import { getField, updateField } from 'vuex-map-fields'
import guide from './modules/guide'


Vue.use(Vuex)

const debug = process.env.NODE_ENV !== 'production'


export const store = new Vuex.Store({
  modules: {
    guide
  },
  strict: debug
})