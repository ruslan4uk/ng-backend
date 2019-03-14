import { publicDecrypt } from "crypto";

export default {
    namespaced: true,

    state: {
        article: {
            id: Boolean,
            user_id: Boolean,
            slug: String,
            title: '',
            content: '',
            country: '',
            city: '',
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
        async getArticle(store, articleId) {
            if(articleId > 0) {
                await axios.get('admin/api/v1/article/' + articleId).then(r => r.data)
                    .then(response => {
                        store.commit('SET_ARTICLE', response)
                        store.dispatch('cityApi/cityGetJSON', response.city, {root: true})
                    }).catch(error => {console.log('State guide error', error)})
            }
        },
        
        async sendArticle(store, articleId) {
            let path = '';
            if(articleId > 0) {
                path = {
                    method: 'put',
                    url: 'admin/api/v1/article/' + articleId,
                    data: store.getters.article}
            } else {
                path = {
                    method: 'post',
                    url: 'admin/api/v1/article',
                    data: store.getters.article}
            }
            await axios(path).then(r => r.data)
                .then(response => {
                    store.dispatch('error/changeError', {
                        status: true,
                        text: response.message,
                        variant: 'success'
                    }, {root: true})
                }).catch(error => {
                    store.dispatch('error/changeError', {
                        status: true,
                        text: error.response.data.errors,
                        code: 400,
                        variant: 'danger'
                    },{root: true})
                })
        },

        async getArticles(store) {
            await axios.get('admin/api/v1/article').then(r => r.data)
                .then(response => {
                    store.commit('SET_ARTICLES', response)
                }).catch(error => {console.log('State guide error', error)})
        },

        clearForm (store) {
            store.commit('CLEAR_STORE')
            store.commit('cityApi/CLEAR', null, {root: true})
        }
    },

    getters: {
        articles(state) {
            return state.articles
        },
        article(state) {
            return state.article
        }
    },

    mutations: {
        SET_ARTICLES (state, articles) {
            state.articles = articles
        },
        SET_ARTICLE (state, article) {
            state.article = article
        },
        CHANGE_VALUE (store, payload) {
            store.article[payload.input] = payload.value
        },
        CLEAR_STORE (state, payload) {
            state.article = {
                id: Boolean,
                user_id: Boolean,
                slug: String,
                title: '',
                content: '',
                country: '',
                city: '',
                cover: '',
                cover_big: '',
                seo_keyword: '',
                seo_description: '',
                created_at: null,
                updated_at: null
            }
            state.articles = []
        }
    }
}