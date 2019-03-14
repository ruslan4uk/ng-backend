<template>
    <div>
        <div class="card card-panel mb-5">
            <div class="card-body">
                <div class="title">Основная информация</div>
                <div class="form-row">
                    <div class="form-group col col-md-6">
                        <input type="text" :value="profile.name" @input="onInput({key: 'name', value: $event.target.value})" class="form-control" placeholder="Введите Ваше имя или название компании">
                    </div>
                    <div class="form-group col col-md-6">
                        <input type="text" :value="profile.secondname" @input="onInput({key: 'secondname', value: $event.target.value})" class="form-control" placeholder="Введите Вашу фамилию">
                    </div>
                </div>

                <!-- Language -->
                <div class="form-group">
                    <profile-language :placeholder="'Выберите язык'"></profile-language>
                </div>
                
                <!-- City select component -->
                <profile-city :current="profile.city"></profile-city>

                <div class="subtitle">Поставьте галочку напротив Ваших услуг</div>

                <div class="form-check form-check-inline" v-for="(service,index) in services" :key="index">
                    <input class="form-check-input" type="checkbox" :value="service.id" :id="service.id" @change="servicesChange(service.id)" :checked="servicesChecked(service.id)">
                    <label class="form-check-label" :for="service.id">{{service.value}}</label>
                </div>

            </div>
        </div>

        <div class="card card-panel">
            <div class="card-body">
                <div class="title mb-0">Расскажите туристам о себе</div>
                <div class="subtitle">Это позволит привлечь больше внимания к Вам</div>
                <div class="form-group">
                    <textarea cols="30" rows="10" class="form-control" :value="profile.about" @input="onInput({key: 'about', value: $event.target.value})"></textarea>
                </div>
            </div>
        </div>

        <div class="btn btn-blue" @click="saveProfile">Сохранить</div>
    </div>
</template>

<script>
import ProfileLanguage from '../Profile/ProfileLanguage'
import {mapActions, mapGetters, mapState} from 'vuex'
import ProfileCity from '../Profile/ProfileCity'
export default {
    props: ['data'],
    components: { ProfileCity, ProfileLanguage },

    data() {
        return {
            //comServices: [1,3,2]
        }
    },
    methods: {
        ...mapActions('profile', ['getProfile', 'onInput', 'saveProfile']),
        servicesChecked(id) {
            //return this.profile.services.indexOf(id) != -1
        },
        servicesChange(id) {

        },
        languageChange(val) {
            this.$store.commit('profile/setValue', {key: 'language', value: val})
            console.log(val);
            
        }
    },
    computed: {
        ...mapState('profile', ['profile','services', 'language']),
    },
    watch: {
        comServices: function(val) {
            this.onInput({key: 'services', value: val})
        },
    },
    mounted() {
        this.getProfile()
    }
}
</script>

<style scoped>

</style>