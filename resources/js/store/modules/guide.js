import axios from 'axios'
import {getField,updateField} from 'vuex-map-fields'
export default {
    namespaced: true,

    state: {
        profile: {
            id: String,
            name: null,
            active: Boolean,
        },
    },

    // action
    actions: {
        getProfile ({ commit }) {
            axios.get('admin/api/v1/guide/1')
                .then(r => r.data)
                .then(response => {
                    commit('SET_PROFILE', response)})
                .catch(error => {
                    console.log('State guide error', error)
                })
        },
        setProfile({ commit }, payload) {
            axios.put('admin/api/v1/guide/' + payload.id, payload )
                .then(r => r.data)
                .then(response => {
                    console.log(response)
                })
                    //commit('SET_PROFILE', response)})
                .catch(error => {
                    console.log('State guide error', error)
                })
            }
    },  

    getters: {
        getField,
    },

    mutations: {
        updateField,
        SET_PROFILE(state, profile) {
            state.profile = profile
        },
        
    },
}