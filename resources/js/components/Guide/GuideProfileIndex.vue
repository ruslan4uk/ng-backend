<template>
    <div>
        <!-- Start first card -->
        <div class="card card-panel mb-5">
            <div class="card-body">
                <div class="title">Основная информация</div>
                <b-row>
                    <b-col cols="12" md="8" lg="7">
                        <b-form-group>
                            <b-form-input
                                v-model="name"
                                type="text"
                                placeholder="Введите Ваше имя или название компании">
                            </b-form-input>
                            <small class="form-text text-danger"></small>
                        </b-form-group>
                    </b-col>

                    <!-- Select country -->
                    <b-col cols="12" md="6">
                        <b-form-group>
                            <multiselect
                                v-model="country"
                                :options="countries"
                                :custom-label="searchCountry"
                                :max-height="250" 
                                :show-labels="false"
                                :clear-on-select="false"
                                :allow-empty="false"
                                placeholder="Страна"
                                label="title"
                                key="id"
                                track-by="id">
                                <span slot="noResult">Не найдено</span>
                            </multiselect>
                            <small class="form-text text-danger"></small>
                        </b-form-group>
                    </b-col>
                    <!-- Select city -->
                    <b-col cols="12" md="6">
                        <b-form-group>
                            <multiselect 
                                v-model="city" 
                                :options="cities"
                                :max-height="250" 
                                :show-labels="false" 
                                :searchable="true"
                                :internal-search="true"
                                :clear-on-select="false"
                                :loading="isLoadingCity" 
                                :disabled="isDisabledCity"
                                :allow-empty="false"
                                track-by="id"
                                key="idd"
                                label="title"
                                :custom-label="searchCountry"
                                @search-change="searchCityVk"
                                placeholder="Город">
                                <span slot="noResult">Не найдено</span>
                            </multiselect>
                            <small class="form-text text-danger"></small>
                        </b-form-group>
                    </b-col>
                    <b-col cols="12" md="6">
                        <b-form-group>
                            <multiselect  
                                v-model="language"
                                tag-placeholder="Add this as new tag"
                                label="name"
                                track-by="code"
                                :options="lang"
                                :multiple="true"
                                :taggable="true"
                                @tag="addTag"
                                placeholder="Язык"></multiselect>
                            <small class="form-text text-danger"></small>
                        </b-form-group>
                    </b-col>

                    <b-col cols="12" class="mt-1"><div class="subtitle">Поставьте галочку напротив Ваших услуг</div></b-col>
                    <b-col cols="12" class="mt-2">
                        <guide-profile-services></guide-profile-services>
                    </b-col>

                    <b-col cols="12"><div class="subtitle">Контакты</div></b-col>
                    <b-col cols="12">
                        <guide-profile-contact 
                            v-for="(item,index) in contact" 
                            :key="index" :track="index"
                            :item="item"
                            @change="changeContact"></guide-profile-contact>
                        <a href="" class="add-contact" @click.prevent="addContact">+ Добавить номер</a>
                    </b-col>

                    {{contact}}
                        
                </b-row>
            </div>
        </div>
        <!-- End first card -->

        <div class="card card-panel mb-5">
            <div class="card-body">
                <div class="title mb-3">В интернете</div>
                <b-row>
                    <div class="col-12 col-lg-6 form-group position-relative" v-for="(input,index) in webcontacts" :key="index">
                        <i :class="'form-icon ' + input.icon"></i>
                        <input type="text" class="form-control pl-4 pr-3" 
                            v-model="other_contact"
                            :placeholder="input.placeholder"
                            >
                        <div class="form-star" data-toggle="tooltip" data-placement="top" title="В избранное">
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                </b-row>
            </div>
        </div>


        <!-- 3 card -->
        <div class="card card-panel mb-5">
            <div class="card-body">
                <div class="title mb-0">Расскажите туристам о себе</div>
                <div class="form-helper mb-3">Это позволит привлечь больше внимания к Вам</div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group mb-1">
                            <textarea class="form-control" rows="10" v-model="about"></textarea>
                        </div>
                    </div>
                </div>
                <div class="form-helper">* минимум 200 символов</div>
            </div>
        </div>

        <b-alert :show="active" dismissible @dismissed="active=false">{{value}}</b-alert>

        <b-form-group>
            <b-btn class="btn-blue" @click="sendData">Сохранить</b-btn>
        </b-form-group>
    </div>
</template>

<script>
import {mapState, mapActions, mapGetters} from 'vuex'
import {mapFields, mapMultiRowFields} from 'vuex-map-fields'
import {store} from '../../store'
import Multiselect from 'vue-multiselect'
import GuideProfileServices from './GuideProfileServices'
import GuideProfileContact from './GuideProfileContact'
import _ from 'lodash'

export default {
    components: { Multiselect, GuideProfileServices, GuideProfileContact },
    props: ['user'],
    data() {
        return {
            countries: [],
            cities: [],
            isLoadingCountry: false,
            isLoadingCity: false,
            isDisabledCity: this.city ? true : false,
            lang: [
                {name: 'Русский', code: 'ru'},
                {name: 'Английский', code: 'en'}
            ],
            servicesCheck: [],
            
        }
    },

    computed: {
        ...mapFields([
            'guide.profile.name', 'guide.profile.data.about', 'guide.success.value', 'guide.success.active', 
            'guide.profile.data.country', 'guide.profile.data.city', 'guide.profile.data.language',
            'guide.profile.data.contact', 'guide.profile.data.other_contact', 
            'guide.serviceList', 'guide.webcontacts', 'guide.profile.data.services'
        ]),
        ...mapState(
            {profile: state => state.guide.profile},
        ),
    },
    methods: {
        // get country from Vk api 
        getCountryVk () {
            this.isLoadingCountry = true;
            window.jsonp('https://api.vk.com/method/database.getCountries?v=5.92&need_all=1&lang=ru&count=1000&access_token=' + window.vk_access_token, null, (err, data) => {
                if (err) {console.error('Error get country ', err.message)} else {
                    this.countries = data.response.items;
                    this.isLoadingCountry = false;}
            });
            console.log('response',this.countries)
        },
        searchCityVk (query) {
            this.isLoadingCity = true;
            window.jsonp('https://api.vk.com/method/database.getCities?v=5.92&lang=ru&country_id=' + this.country.id + '&q=' + query + '&access_token=' + window.vk_access_token, null, (err, data) => {
                if (err) {console.error('Error search city ',err.message);} else {
                    this.cities = data.response.items;
                    this.isLoadingCity = false;}
            });
        },
        getCityVk (option) {
            this.isLoadingCity = true;
            window.jsonp('https://api.vk.com/method/database.getCities?v=5.92&lang=ru&country_id=' + option.id + '&access_token=' + window.vk_access_token, null, (err, data) => {
                if (err) {console.error('Error get city ',err.message);} else {
                    this.cities = data.response.items;
                    this.isLoadingCity = false;}
            });
        },
        // country
        searchCountry ({ key, title }) {
            return `${title}`
        },

        sendData() {
            store.dispatch('guide/setProfile', this.profile)
        },
        addTag (newTag) {
            const tag = {name: newTag, code: newTag.substring(0, 2) + Math.floor((Math.random() * 10000000))}
            this.lang.push(tag)
            this.language.push(tag)
        },
    },
    created () {
        store.dispatch('guide/getProfile', this.user)
        this.getCountryVk();
    }
}
</script>

<style lang="sass">
    
</style>


