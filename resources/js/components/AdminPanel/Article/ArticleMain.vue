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
                    <table class="table b-table table-hover">
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
//import {mapFields} from 'vuex-map-fields'
import {store} from '../../../store'

export default {
    data() {
        return {
            
        }
    },
    computed: {
        ...mapGetters(['articles/articles'])
    },
    created() {
        store.dispatch('article/getArticles')
    }
}
</script>

<style scoped>

</style>