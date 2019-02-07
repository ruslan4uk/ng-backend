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
                                type="text"
                                placeholder="Введите Ваше имя или название компании">
                            </b-form-input>
                            <small class="form-text text-danger"></small>
                        </b-form-group>
                    </b-col>

                    <b-col cols="12" md="6">
                        <b-form-group>
                            <multiselect
                                v-model="form.country"
                                :options="countries"
                                :custom-label="searchCountry"
                                :max-height="250" 
                                :show-labels="false"
                                :clear-on-select="false"
                                :allow-empty="false"
                                placeholder="Страна"
                                label="title"
                                key="id"
                                track-by="id"
                                @select="getCityVk">
                                <span slot="noResult">Не найдено</span>
                            </multiselect>
                            
                            <small class="form-text text-danger"></small>
                        </b-form-group>
                    </b-col>
                    <b-col cols="12" md="6">
                        <b-form-group>
                            <multiselect 
                                v-model="form.city" 
                                :options="cities"
                                :max-height="250" 
                                :show-labels="false" 
                                :searchable="true"
                                :internal-search="true"
                                :clear-on-select="false"
                                :loading="isLoadingCity" 
                                :disabled="citiesDisable"
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
                </b-row>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <b-form-group>
                            <multiselect 
                                v-model="value" 
                                :options="options" 
                                placeholder="Язык"></multiselect>
                            <small class="form-text text-danger"></small>
                        </b-form-group>
                        
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 mb-1"><div class="subtitle">Поставьте галочку напротив Ваших услуг</div></div>
                    <div class="col-12 mb-1">
                        <div class="form-group">
                            <div class="form-check-inline form-check" v-for="(service) in services" :key="service.id">
                                <input type="checkbox" class="form-check-input" 
                                    name="services"
                                    v-model="servicesCheck"
                                    :value="service"
                                    :id="'service' + service.id">
                                <label class="form-check-label" :for="'service' + service.id">{{service.title}}</label>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-12 mb-1"><div class="subtitle">Контакты</div></div>
                    <div class="col-12 mb-3">
                        <guide-profile-show-phone 
                            v-for="(phone,index) in form.contact"
                            :key="index"
                            :phonekey="index"
                            :type="phone.phoneType"
                            :number="phone.phoneNumber"
                            :messenger="phone.phoneMessenger"
                            @change="contactChange">
                        </guide-profile-show-phone>
                        <a href="" class="add-contact" @click.prevent="addNewContact">+ Добавить номер</a>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 mb-1"><div class="subtitle">Удобное время для связи</div></div>
                
                    <div class="form-group col-4 col-md-3">
                        <multiselect 
                            v-model="form.time_to_call.dayWeek" 
                            :options="timeToCall"
                            :max-height="150" 
                            :show-labels="false" 
                            :searchable="true"
                            :internal-search="true"
                            :clear-on-select="false"
                            :allow-empty="false"
                            placeholder="День недели"
                            class="form-control">
                                <span slot="noResult">Не найдено</span>
                        </multiselect>
                    </div>
                    <div class="form-group col-4 col-md-3">
                        <input type="text" class="form-control" v-model="form.time_to_call.startTime" placeholder="С">
                    </div>
                    <div class="form-group col-4 col-md-3">
                        <input type="text" class="form-control" v-model="form.time_to_call.endTime" placeholder="По">
                    </div>
                </div>
            </div>
        </div>
        <!-- End first card -->

        <!-- Start two card -->
        <div class="card card-panel  mb-5">
            <div class="card-body">
                <div class="title">В интернете</div>
                <div class="row">
                    
                    <guide-profile-other
                        v-for="(webContact,index) in webContacts"
                        :key="index"
                        :input="webContact"
                        :contact="form.other_contact"
                        @webContact="addWebContact"
                        ></guide-profile-other>
                    
                </div>
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
                            <textarea class="form-control" rows="10" ></textarea>
                        </div>
                    </div>
                </div>
                <div class="form-helper">* минимум 200 символов</div>
            </div>
        </div>

        <!-- 4 card -->
        <div class="card card-panel mb-5">
            <div class="card-body">
                <div class="title mb-0">Лицензия гида</div>
                <div class="form-helper mb-3">Если у Вас есть лицензия, обязательно покажите ее, это повысит уровень доверия к Вам</div>
                <div class="row">
                    <div class="col-12">
                        <file-upload :multiple="true"></file-upload>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</template>

<script>
import Multiselect from 'vue-multiselect'
import VueUploadComponent from 'vue-upload-component'
import { async } from 'q';
import _ from 'lodash';
export default {
    components: { Multiselect, VueUploadComponent },
    data () {
      return {
        value: null,
        options: ['Select option', 'options', 'selected', 'mulitple', 'label', 'searchable', 'clearOnSelect', 'hideSelected', 'maxHeight', 'allowEmpty', 'showLabels', 'onChange', 'touched'],

        // general
        files: [],

        // services
        services: [],
        servicesCheck: [],

        // country
        countries: [],
        isLoadingCountry: false,

        // city
        cities: [],
        isLoadingCity: false,
        citiesDisable: true,
        cityFake: '',

        // time to call variable
        timeToCall: ['Понедельник','Вторник','Среда','Четверг','Пятница','Суббота','Воскресенье'],

        // other_contact
        webContacts: [
            {name: 'mail', placeholder: 'Эл. почта', icon: 'far fa-envelope'},
            {name: 'vk', placeholder: 'Вконтакте', icon: 'fab fa-vk'},
            {name: 'skype', placeholder: 'Скайп', icon: 'fab fa-skype'},
            {name: 'ok', placeholder: 'Одноклассники', icon: 'fab fa-odnoklassniki'},
            {name: 'site', placeholder: 'Сайт', icon: 'fas fa-tv'},
            {name: 'instagramm', placeholder: 'Инстаграм', icon: 'fab fa-instagram'},
            {name: 'facebook', placeholder: 'Facebook', icon: 'fab fa-facebook-square'},
            {name: 'twitter', placeholder: 'Twitter', icon: 'fab fa-twitter'},
            {name: 'viber', placeholder: 'Viber', icon: 'fab fa-viber'},
            {name: 'whatsup', placeholder: 'Whatsup', icon: 'fab fa-whatsapp'},
            {name: 'telegram', placeholder: 'Telegram', icon: 'fab fa-telegram-plane'}
        ],

        // form
        form: {
            city: [],
            country: [],
            services: [],
            contact: [{
                phoneType: "Рабочий",
                phoneNumber: "89501731050",
                phoneMessenger: [ "Whatsapp", "Telegram" ],
            }],
            time_to_call: {
                dayWeek: [],
                startTime: '',
                endTime: ''
            },
            other_contact: [
                {name: 'skype', value: 'skype login', favorite: true},
                {name: 'vk', value: '', favorite: false },
            ],
        },

      }
    },
    created() {
        this.getServices();

        // get country
        this.getCountryVk();
        
    },
    watch: {
        // watch countries to disable city input
        'form.country.id'(val) {
            if(val) {
                this.citiesDisable = false
            } else {
                 this.citiesDisable = true
            }
        },
        servicesCheck: function(val) {
            this.form.services = val
        }
    },
    methods: {
        // change contact component
        contactChange(val) {
            // delete 
            //this.form.contact.splice(this.form.contact.indexOf(val.phonePhonekey), 1);
            //this.form.contact.push(val);
            Vue.set(this.form.contact, val.phonePhonekey, val)
        },
        addWebContact(val) {
            let index = this.form.other_contact.indexOf(val)
            index > 0 ? Vue.set(this.form.other_contact, index, val) : this.form.other_contact.push(val)
        },
        // get services
        getServices() {
            window.axios.get('admin/api/v1/services')
                .then(response => {
                    this.services = response.data;
                });
        },
        // country
        getCountryVk () {
            this.isLoadingCountry = true;
            window.jsonp('https://api.vk.com/method/database.getCountries?v=5.92&need_all=1&lang=ru&count=1000&access_token=8edd56e88edd56e88edd56e8958eb535d488edd8edd56e8d28f98681c168aaf8c0b8785', null, (err, data) => {
                if (err) {
                    console.error(err.message);
                } else {
                    this.countries = data.response.items;
                    this.isLoadingCountry = false;
                }
            });
        },
        // country search
        searchCountry ({ key, title }) {
            return `${title}`
        },
        // city
        searchCityVk (query) {
            //console.log(this.cities)
            this.isLoadingCity = true;
            window.jsonp('https://api.vk.com/method/database.getCities?v=5.92&lang=ru&country_id=' + this.form.country.id + '&q=' + query + '&access_token=8edd56e88edd56e88edd56e8958eb535d488edd8edd56e8d28f98681c168aaf8c0b8785', null, (err, data) => {
                if (err) {
                    console.error(err.message);
                } else {
                    this.cities = data.response.items;
                    this.isLoadingCity = false;
                }
            });
        },
        getCityVk (option) {
            //console.log(value)
            this.isLoadingCity = true;
            //this.form.city = '';
            window.jsonp('https://api.vk.com/method/database.getCities?v=5.92&lang=ru&country_id=' + option.id + '&access_token=8edd56e88edd56e88edd56e8958eb535d488edd8edd56e8d28f98681c168aaf8c0b8785', null, (err, data) => {
                if (err) {
                    console.error(err.message);
                } else {
                    this.cities = data.response.items;
                    this.isLoadingCity = false;
                }
            });
        },
        clearCity () {
            this.form.city = []
        },
        addNewContact () {
            this.form.contact.push({})
            console.log(this.form)
        },



        /**
         * Has changed
         * @param  Object|undefined   newFile   Read only
         * @param  Object|undefined   oldFile   Read only
         * @return undefined
         */
        inputFile: function (newFile, oldFile) {
        if (newFile && oldFile && !newFile.active && oldFile.active) {
            // Get response data
            console.log('response', newFile.response)
            if (newFile.xhr) {
            //  Get the response status code
            console.log('status', newFile.xhr.status)
            }
        }
        },
        /**
         * Pretreatment
         * @param  Object|undefined   newFile   Read and write
         * @param  Object|undefined   oldFile   Read only
         * @param  Function           prevent   Prevent changing
         * @return undefined
         */
        inputFilter: function (newFile, oldFile, prevent) {
        if (newFile && !oldFile) {
            // Filter non-image file
            if (!/\.(jpeg|jpe|jpg|gif|png|webp)$/i.test(newFile.name)) {
            return prevent()
            }
        }
        // Create a blob field
        newFile.blob = ''
        let URL = window.URL || window.webkitURL
        if (URL && URL.createObjectURL) {
            newFile.blob = URL.createObjectURL(newFile.file)
        }
        }
    }

}
</script>

<style lang="sass">
    .vbt-autcomplete-list
        box-shadow: none !important
</style>