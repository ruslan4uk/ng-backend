import Axios from "axios-jsonp-pro";

export default {
    namespaced: true,

    state: {
        profile: {
            name: '',
            about: '',
            city: '',
            language: [],
            contact: '',
            services: '',
            time_to_call: '',
            user_fales: '',
        },
        services: [
            {id: 1, value: 'Частный гид'},
            {id: 2, value: 'Туристическая компания'},
            {id: 3, value: 'Транфер'},
            {id: 4, value: 'Аренда авто/яхт'},
            {id: 5, value: 'Организация мероприятий'},
            {id: 6, value: 'Услуги перевода'},
            {id: 7, value: 'Шоппинг'},
        ],
        language: [
            {id: 1, value: 'Русский'},
            {id: 2, value: 'Английский'},
            {id: 3, value: 'Французский'}
        ]
    },

    actions: {
        async getProfile(store) {
            await axios.get('/profile/show').then(r => r.data)
                .then(response => {
                    store.commit('setProfile', response)
                })
        },
        saveProfile({commit, state}) {
            axios.put('/profile/update', state.profile).then(r => r.data)
        },
        onInput(store, payload) {
            store.commit('setValue', payload)
        }
    },

    getters: {
        profile(state) {
            return state.profile
        },
        services (state) {
            return state.services
        },
        language (state) {
            return state.language
        }
    },

    mutations: {
        setProfile (state, payload) {
            state.profile = payload
        },
        setValue (state, payload) {
            state.profile[payload.key] = payload.value
        },
        deleteLanguage (state, payload) {
            state.profile.language.splice(payload, 1)
        },
        changeLanguage (state, payload) {
            state.profile.language.push(payload)
        }
    }
}