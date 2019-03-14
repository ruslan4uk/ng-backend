<template>
    <div class="card card-panel">
        <div class="card-body">
            <div class="title position-relative">Статьи</div>
            <div class="row">
                <div class="col-12 mb-4">
                    <router-link :to="{ name: 'article-create' }" class="btn btn-sm btn-blue">
                        <i class="fas fa-plus"></i> Добавить статью
                    </router-link>
                </div>
                <div class="col-12">
                    <table class="table b-table table-hover" v-if="articles">
                        <thead>
                            <tr>
                                <th class="align-middle">Заголовок</th>
                                <th class="align-middle text-right">Управление</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(article,index) in articles" :key="index">
                                <td>{{ article.title }}</td>
                                <td class="admin-btn align-middle">
                                    <div class="d-flex justify-content-end">
                                        <router-link :to="{name: 'article-show', params: { id: article.id }}" class="btn btn-sm btn-outline-success ml-1" data-toggle="tooltip" data-placement="top" title="Удалить гида"><i class="fas fa-pencil-alt"></i></router-link>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
import {mapState, mapActions, mapGetters} from 'vuex'
import {store} from '../../../store'
import Multiselect from 'vue-multiselect'

export default {
    components: { Multiselect },

    data() {
        return {
            city: '',
            getStatusCity: false,
            cityList: []
        }
    },

    computed: {
        ...mapGetters('article', {articles: 'articles'}),
    },
    methods: {
        ...mapActions('article', ['getArticles']),

        cityName({name, countryName, countryCode}) {
            return `${name}, ${countryName}`
        },

        isCyrillic(text) {
            return /[а-я]/i.test(text);
        }
    },
    created() {
        this.getArticles();
    }
}
</script>

<style scoped>

</style>