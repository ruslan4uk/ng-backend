<template>
    <div>
        <div class="form-group">
            <div class="select">
                <div class="select__current" @click="suggest = true">{{ comPlaceholder.value }}</div>
                <div class="select__suggest" v-if="suggest" v-click-outside="hide">
                    <a v-for="(option, index) in options" :key="index" @click="changeType(option)">{{option.value}}</a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import ClickOutside from 'vue-click-outside'

export default {
    props: ['current', 'placeholder', 'option'],
    data() {
        return {
            categoryId: this.current || '',
            comPlaceholder: {value: this.placeholder || 'Выберите'},
            suggest: false,
            options: this.option || ''
        }
    },
    methods: {
        changeType(option) {
            this.comPlaceholder = option.value 
            this.categoryId = option.id
            this.suggest = false
            this.$emit('change', this.categoryId)
        },
        hide() {
            this.suggest = false
        }
    },
    watch: {
        'categoryId': function() {
            this.comPlaceholder = this.options.find(x => x.id == this.categoryId)
            this.$emit('change', this.categoryId)
        }
    },
    mounted() {
        if(this.categoryId) {
            this.comPlaceholder = this.options.find(x => x.id == this.categoryId)
        }
    },
    directives: {
        ClickOutside
    }
}
</script>

<style scoped lang="sass">
.select
    position: relative
    min-width: 7.5rem
    &__current
        font-size: 0.75rem
        color: #405089
        font-size: 0.75rem
        font-weight: 500 
        padding: 0.5rem 2.5rem 0.5rem 0
        border-bottom: 1px solid #e7e7e8
        cursor: pointer
        position: relative
        &:after
            content: ' '
            position: absolute
            background-image: url(/images/triangle.svg)
            background-repeat: no-repeat
            background-size: contain
            right: 0
            top: 0.75rem
            width: 0.625rem
            height: 0.5rem
    &__suggest
        position: absolute 
        left: 0
        width: 100%
        box-shadow: 0 0 4px 2px rgba(0,0,0,.1)
        border-radius: 4px
        background-color: #fff
        z-index: 2
        & a 
            display: block
            font-size: 0.75rem
            padding: 0.5rem
            cursor: pointer 
            &:hover 
                background-color: #eeeeee
</style>