export default {

    namespaced: true,
    
    state: {
        countryList: [],
        cityList: [],
        status: {
            loadingCountry: false,
            loadingCity: false
        }
    },

    actions: {
        async getCountryVk (store) {
            store.commit('SET_LOAD_COUNTRY', true)
            await axios({
                url: 'https://api.vk.com/method/database.getCountries?v=5.92&need_all=1&lang=ru&count=1000&access_token=' + window.vk_access_token,
                adapter: window.jsonpAdapter}).then(r => r.data)
                .then(response => {
                    store.commit('SET_COUNTRY', response.response.items)
                    store.commit('SET_LOAD_COUNTRY', false)
                }).catch(error => {console.log('Error get country list', error)})
        },

        async getCityVk (store, counryId) {
            store.commit('SET_LOAD_CITY', true)
            await axios({
                url: 'https://api.vk.com/method/database.getCities?v=5.92&lang=ru&country_id=' + counryId + '&access_token=' + window.vk_access_token,
                adapter: window.jsonpAdapter}).then(r => r.data)
                .then(response => {
                    store.commit('SET_CITY', response.response.items)
                    store.commit('SET_LOAD_CITY', false)
                }).catch(error => {console.log('Error get city list', error)})
        },

        async searchCityVk (store, payload) {
            store.commit('SET_LOAD_CITY', true)
            await axios({
                url: 'https://api.vk.com/method/database.getCities?v=5.92&lang=ru&country_id=' + payload.id + '&q=' + payload.query + '&access_token=' + window.vk_access_token,
                adapter: window.jsonpAdapter}).then(r => r.data)
                .then(response => {
                    store.commit('SET_CITY', response.response.items)              
                    store.commit('SET_LOAD_CITY', false)      
                }).catch(error => {console.log('Error get country list', error)})
        }
    },

    mutations: {
        SET_COUNTRY (state, country) {
            state.countryList = country
        },
        SET_CITY (state, city) {
            state.cityList = city
        },
        SET_LOAD_COUNTRY (state, status) {
            state.status.loadingCountry = status
        },
        SET_LOAD_CITY (state, status) {
            state.status.loadingCity = status
        }
    },

    getters: {
        countryList (state) {
            return state.countryList
        },
        cityList (state) {
            return state.cityList
        },
        getStatusCountry (state) {
            return state.status.loadingCountry
        },
        getStatusCity (state) {
            return state.status.loadingCity
        }
    }
}