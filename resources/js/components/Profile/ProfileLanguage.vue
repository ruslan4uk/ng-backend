<template>
    <div class="tags">
        <div class="tags__active" v-for="(active,index) in profile.language" :key="index">
            {{active.value}}
            <div class="tags__delete" @click="deleteLanguage(index)"><i class="fas fa-times"></i></div>
        </div>

        <div class="select position-relative" v-if="selectArr.length > 0">
            <div class="select__name" @click="suggest = true">{{comPlaceholder}}</div>
            <div class="select__list" v-if="suggest" v-click-outside="hide">
                <div class="select__item" v-for="(item, index) in selectArr" :key="index" @click="changeLanguage(item.id)">{{item.value}}</div>
            </div>
        </div>
    </div>
</template>

<script>
import _ from 'lodash'
import { mapGetters, mapState, mapActions } from 'vuex'
import ClickOutside from 'vue-click-outside'
export default {
    name: 'Tags',

    props: ['placeholder', 'options', 'selected'],

    data() {
        return {
            comPlaceholder: this.placeholder || 'Выберите',
            suggest: false,
        }
    },
    methods: {
        hide() {
            this.suggest = false
        },
        changeLanguage(id) {
            this.$store.commit('profile/changeLanguage', this.language.find(x => x.id === id))
            this.suggest = false
        },
        deleteLanguage(index) {
            this.$store.commit('profile/deleteLanguage', index)
        }
    },
    computed: {
        ...mapState('profile', ['profile','language']),
        selectArr() {
            return _.differenceBy(this.language, this.profile.language, 'id') 
        },
    },
    directives: {
        ClickOutside
    }
}
</script>

<style scoped lang="sass">
.tags 
    display: flex
    flex-wrap: wrap
    &__active
        font-size: 0.75rem
        padding: 0.25rem 2.5rem 0.25rem 0.5rem
        border: 1px solid #ccc
        border-radius: 4px
        margin-right: 0.5rem
        margin-bottom: 0.5rem
        position: relative 
        font-weight: 500
        color: #75797e
    &__delete 
        position: absolute
        right: 0.375rem
        top: 0.25rem
        cursor: pointer
.select 
    &__name
        font-size: 0.75rem
        font-weight: 500 
        padding: 0.25rem 2.5rem 0.25rem 0
        border-bottom: 1px solid #e7e7e8
        cursor: pointer
        color: #405089
        &:after
            content: ' '
            position: absolute
            background-image: url(/images/triangle.svg)
            background-repeat: no-repeat
            background-size: contain
            right: 0
            top: 0.625rem
            width: 0.625rem
            height: 0.5rem
    &__list
        font-size: 0.75rem
        border: 1px solid #405089
        padding: 0.25rem 0
        position: absolute
        z-index: 2
        background-color: #ffffff
        border-radius: 4px
        width: 100%
    &__item
        padding: 0.5rem
        cursor: pointer 
        &:hover
            background-color: #eeeeee
</style>