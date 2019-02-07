<template>
    <div>
        <!-- Start first card -->
        <div class="card card-panel mb-5">
            <div class="card-body">
                <div class="title">Основная информация</div>
                <div class="form-group">
                    <input type="text" class="form-control" v-model="guide.profile.name">
                </div>
                
                {{profile}}
                <div class="form-grop">
                    <button class="btn btn-blue" @click.prevent="sendData">Отправить</button>
                </div>
            </div>
        </div>
        <!-- End first card -->
    </div>
</template>

<script>
import {mapState, mapActions} from 'vuex'
import {mapFields} from 'vuex-map-fields'
import {store} from '../../store'
export default {
    data() {
        return {
            count: []
        }
    },

    computed: {
        ...mapFields([
            'guide.profile.name',
        ]),
        // ...mapState({
        //     profile: state => state.guide.profile
        // }),
    },
    watch: {

    },
    methods: {
        sendData() {
            store.dispatch('guide/setProfile', this.profile)
        }
    },
    created () {
        store.dispatch('guide/getProfile')
    }
}
</script>

<style lang="sass">
    
</style>