<template>
    <div class="d-flex align-items-center navigation-toogle ml-auto position-relative">

        <div class="d-flex align-items-center navigation-toogle__click" v-click-outside="hide" @click="active = !active">
            <div class="navigation-toogle__avatar mr-3">
                <img :src="comAvatar" alt="" class="border25">
            </div>
            <div class="navigation-toogle__name d-none d-md-block">{{name}}</div>
        </div>

        <div class="navigation-toogle__nav" v-if="active">
            <div class="navigation-toogle__item">
                <a href="/profile">Настройки профиля</a>
                <a href="/profile/tour">Мои туры</a>
                <a href="/profile/tour/edit">Добавить тур</a>
                <a href="/logout">Выход</a>
            </div>
        </div>

    </div>
</template>

<script>
import ClickOutside from 'vue-click-outside'

export default {
    props: ['name', 'avatar'],
    data() {
        return {
            active: false,
            comAvatar: this.avatar || 'images/empty-avatar.png',
        }
    },
    methods: {
        hide() {
            this.active = false
        }
    },
    directives: {
        ClickOutside
    }
}
</script>

<style scoped lang="sass">


</style>