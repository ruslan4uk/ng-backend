<template>
    <div class="form-group">
        <div class="form-check-inline form-check" v-for="(service) in serviceList" :key="service.id">
            <input type="checkbox" class="form-check-input" 
                v-model="services"
                name="services"
                :value="service"
                :id="'service' + service.id">
            <label class="form-check-label" :for="'service' + service.id">{{service.title}}</label>
        </div>
    </div>
</template>

<script>
import {mapState, mapActions} from 'vuex'
import {mapFields} from 'vuex-map-fields'
import {store} from '../../store'

export default {
    name: 'GuideProfileServices',
    data() {
        return {
            serviceCheck: []
        }
    },
    computed: {
        ...mapFields(['guide.serviceList','guide.profile.data.services'])
    },
    created() {
        store.dispatch('guide/getServices')
    }
}
</script>

<style scoped>

</style>