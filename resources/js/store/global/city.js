import axios from "axios-jsonp-pro";

export default {
    namespaced: true,

    state: {
        city: ''
    },

    mutations: {
        setCity (state, payload) {
            state.city = payload
        }
    },

    actions: {
        async searchCity(store, query) {
            await axios.get('/geo?q=' + encodeURIComponent(query)).then(r => r.data)
                .then(response => {
                    store.commit('setCity', response)
                })
                .catch(error => {
                    console.log(error);
                })
        },
    },

    getters: {
        cities (state) {
            return state.city
        }
    }
}