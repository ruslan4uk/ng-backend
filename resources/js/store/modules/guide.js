export default {
    namespaced: true,

    state: {
        profile: {
            id: String,
            name: null,
            active: Boolean,
            data: {
                about: null,
                language: null,
                contact: null,
                other_contact: null,
                avatar: null,
                services: [],
                country: null,
                city: null,
                time_to_call: null,
                user_files: null,
                properties: null
            },
        },
        serviceList: [],
        error: {},
        success: {
            active: false,
            value: '',
        },
        webcontacts: [
            {name: 'mail', placeholder: 'Эл. почта', icon: 'far fa-envelope'},
            {name: 'vk', placeholder: 'Вконтакте', icon: 'fab fa-vk'},
            {name: 'skype', placeholder: 'Скайп', icon: 'fab fa-skype'},
            {name: 'ok', placeholder: 'Одноклассники', icon: 'fab fa-odnoklassniki'},
            {name: 'site', placeholder: 'Сайт', icon: 'fas fa-tv'},
            {name: 'instagramm', placeholder: 'Инстаграм', icon: 'fab fa-instagram'},
            {name: 'facebook', placeholder: 'Facebook', icon: 'fab fa-facebook-square'},
            {name: 'twitter', placeholder: 'Twitter', icon: 'fab fa-twitter'},
            {name: 'viber', placeholder: 'Viber', icon: 'fab fa-viber'},
            {name: 'whatsup', placeholder: 'Whatsup', icon: 'fab fa-whatsapp'},
            {name: 'telegram', placeholder: 'Telegram', icon: 'fab fa-telegram-plane'}
        ],
    },

    // action
    actions: {
        getProfile ({ commit }, payload) {
            axios.get('admin/api/v1/guide/' + payload).then(r => r.data)
                .then(response => {
                    commit('SET_PROFILE', response)
                }).catch(error => {console.log('State guide error', error)})
        },
        setProfile({ commit }, payload) {
            axios.put('admin/api/v1/guide/' + payload.id, payload ).then(r => r.data)
                .then(response => {
                    commit('SET_SUCCESS', response)
                }).catch(error => {console.log('State guide error', error)})
        },
        async getServices({ commit }, payload) {
            axios.get('admin/api/v1/services').then(r => r.data)
                .then(response => {commit('SET_SERVICES', response)})
        },

        contactNew ({ commit }, payload) {
            commit('ADD_NEW_CONTACT', payload)
        },
    },  

    getters: {
        getAllContact: state => {
            return state.profile.data.contact
        }
    },

    mutations: {
        SET_PROFILE(state, profile) {
            state.profile = profile
        },
        SET_SUCCESS(state, success) {
            state.success.active = true,
            state.success.value = success.success
        },
        SET_SERVICES(state, servicesList) {
            state.serviceList = servicesList
        },
        ADD_NEW_CONTACT(state, contact) {
            state.profile.data.contact.push(contact)
        },
        SET_NUMBER(state, payload) {
            state.profile.data.contact[payload.index].number = payload.obj
        },
        SET_TYPE(state, payload) {
            state.profile.data.contact[payload.index].type = payload.obj
        },
        SET_MESSENGER(state, payload) {
            state.profile.data.contact[payload.index].messenger = payload.obj
            //Vue.set(state.profile.data.contact, payload.index, payload.obj)
        }
    },
}
