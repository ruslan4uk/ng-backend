export default {
    namespaced: true,

    state: {
        article: {
            id: Boolean,
            user_id: Boolean,
            slug: String,
            title: String,
            content: '',
            cover: '',
            cover_big: '',
            seo_keyword: '',
            seo_description: '',
            created_at: null,
            updated_at: null
        },
        articles: [],
    },

    actions: {
        getArticle({ commit }, payload) {
            axios.get('admin/api/v1/article/' + payload).then(r => r.data)
                .then(response => {
                    commit('SET_ARTICLE', response)
                }).catch(error => {console.log('State guide error', error)})
        },
        getArticles({ commit }, payload) {
            axios.get('admin/api/v1/article').then(r => r.data)
                .then(response => {
                    commit('SET_ARTICLES', response)
                }).catch(error => {console.log('State guide error', error)})
        }
    },

    getters: {
        articles() {
            return state.articles
        }
    },

    mutations: {
        SET_ARTICLES(state, articles) {
            state.articles = articles
        }
    }
}