<template>
    <div>
        <div class="form-group select" v-click-outside="">
            <input type="text" name="" id=""
                class="form-control"
                v-model="city"
                :placeholder="cPlaceholder" 
                @input="search($event.target.value)"
                @focus="suggest = true" 
                :disabled = "disabled">
            <div class="select__close" v-if="disabled" @click="close">
                <i class="fas fa-times"></i>
            </div>
            
            <ul class="select__list" v-if="suggest && cities">
                <li class="select__item" v-for="(city,index) in cities" :key="index" 
                @click="change(city)">
                    {{ city.city + ', ' + city.country_name}}
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
import ClickOutside from 'vue-click-outside'
import {mapActions, mapGetters} from 'vuex'
export default {
    props: ['current', 'index', 'placeholder'],
    data() {
        return {
            cPlaceholder: this.placeholder || 'Введите город проживания',
            cCity: {
                id: '',
                city: '',
                city_iso_code: '',
                region: '',
                country_name: '',
            },
            suggest: false,
            disabled: false,
            newCity: '',
            city: '',
        }
    },
    methods: {
        ...mapActions('city', ['searchCity','searchCityId']),
        search(value) {
            this.searchCity(value)
        },
        change(value) {
            this.cCity = value
            this.city = value.city + ', ' + value.country_name
            this.suggest = false 
            this.disabled = true
        },
        close() {
            this.disabled = false
            this.city = ''
        }
    },
    computed: {
        ...mapGetters('city', ['cities']),
    },
    directives: {
        ClickOutside
    },
}
</script>

<style scoped lang="sass">
.select
    position: relative
    &__list
        position: absolute
        left: 0
        width: 100%
        max-height: 10rem
        overflow: scroll
        background-color: #fff
        z-index: 3
        box-shadow: 0 3px 2px 2px rgba(0,0,0,.1)
    &__item
        font-size: 0.75rem
        padding: 0.25rem 0.5rem
        border-bottom: 1px solid #eee
        cursor: pointer
    &__close 
        position: absolute 
        right: 0.5rem
        top: 0.5rem
</style>