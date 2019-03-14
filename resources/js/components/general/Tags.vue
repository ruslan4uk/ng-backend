<template>
    <div class="tags">
        <div class="tags__active" v-for="(active,index) in activeTag" :key="index">
            {{active.value}}
            <div class="tags__delete" @click="deleteServices(index)"><i class="fas fa-times"></i></div>
        </div>

        <div class="select position-relative" v-if="selectArr.length > 0">
            <div class="select__name" @click="suggest = true">{{comPlaceholder}}</div>
            <div class="select__list" v-if="suggest" v-click-outside="hide">
                <div class="select__item" v-for="(item, index) in selectArr" :key="index" @click="changeServices(item.id)">{{item.value}}</div>
            </div>
        </div>
    </div>
</template>

<script>
import _ from 'lodash'
import ClickOutside from 'vue-click-outside'
export default {
    name: 'Tags',

    props: ['placeholder', 'options', 'selected'],

    data() {
        return {
            comPlaceholder: this.placeholder || 'Выберите',
            suggest: false,
            activeTag: Object.assign(this.selected) || [],
        }
    },
    methods: {
        hide() {
            this.suggest = false
        },
        changeServices(id) {
            this.activeTag.push(this.options.find(x => x.id === id))
            this.suggest = false
            this.$emit('change', this.activeTag)
        },
        deleteServices(index) {
            this.activeTag.splice(index, 1)
            this.$emit('change', this.activeTag)
        }
    },
    computed: {
        selectArr() {
            return _.differenceBy(this.options, this.activeTag, 'id') 
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
        position: absolute
        z-index: 2
        background-color: #ffffff
        border-radius: 4px
        width: 100%
        box-shadow: 0 0 4px 2px rgba(0,0,0,.1)
    &__item
        padding: 0.5rem
        cursor: pointer 
        &:hover
            background-color: #eeeeee
</style>