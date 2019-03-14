<template>
    <div>
        <div class="card card-panel mb-5">
            <div class="card-body">
                <div class="title">Основная информация</div>
                <div class="form-row mb-2">
                    <div class="form-group col col-md-6">
                        <input type="text" v-model="profile.name" class="form-control" placeholder="Введите Ваше имя или название компании">
                    </div>
                    <div class="form-group col col-md-6">
                        <input type="text" v-model="profile.secondname" class="form-control" placeholder="Введите Вашу фамилию">
                    </div>
                </div>

                <!-- Выбор языка -->
                <tags @change="changeLanguage" :placeholder="'Выберите языки'" :options="languageArray" :selected="profile.language"></tags>

                <!-- Выбор города - страны -->
                <div class="subtitle mt-3">Ваше местоположение</div>
                <div class="row">
                    <div class="col">
                        <profile-geolocation v-for="(item,index) in profile.city" :key="index" :currentId="item" :i="index" @change="changeCity" @delete="deleteCity"></profile-geolocation>
                    </div>
                    <div class="col-auto"><div class="btn btn-sm btn-blue" @click="addNewCity">Добавить</div></div>
                </div>

                <!-- Блок с контактами -->
                <div class="subtitle mt-3">Контакты</div>
                <div class="row mb-3">
                    <div class="col-7 col-md-6">
                        <multi-phone @change="changeContact" v-for="(contact,index) in profile.contact" :key="index" :data="contact"></multi-phone>
                        <p class="form-helper">Введите номер с кодом города, напр. +7 495 646-84-89 или (495) 6468489</p>
                    </div>
                    <div class="col-5 col-md-6">
                        <div class="btn btn-sm btn-blue" @click="addNewContact">Добавить</div>
                    </div>
                </div>

                <!-- Время для связи -->
                <div class="subtitle">Удобное время для связи</div>
                <time-to-call :data="profile.time_to_call" @change="changeTimeToCall"></time-to-call>

            </div>
        </div>

        <!-- Услуги -->
        <div class="card card-panel mb-5">
            <div class="card-body">
                <div class="title">Услуги</div>
                <profile-services :data="profile.services" @change="changeServices"></profile-services>
            </div>
        </div>


        <!-- В интернете -->
        <div class="card card-panel mb-5">
            <div class="card-body">
                <div class="title">В интернете</div>
                <div class="row">
                    <profile-other-contact 
                        v-for="(item,index) in languageOtherContact" :key="index"
                        :placeholder="item.placeholder" :icon="item.icon" :data="otherContact(item)"
                        :idnumber="item.id" :index="index" @change="changeOtherContact"></profile-other-contact>
                    <div class="col-12 col-md-6"></div>
                    <div class="col-12 col-md-6">
                        <div class="form-helper">* Чтобы добавить избранный вид связи нажмите на звездочку</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Расскажите о себе -->
        <div class="card card-panel mb-5">
            <div class="card-body">
                <div class="title mb-0">Расскажите туристам о себе</div>
                <div class="subtitle">Это позволит привлечь больше внимания к Вам</div>
                <div class="form-group">
                    <textarea cols="30" rows="10" class="form-control" v-model="profile.about"></textarea>
                </div>
            </div>
        </div>

        <!-- В интернете -->
        <div class="card card-panel mb-5">
            <div class="card-body">
                <div class="title mb-0">Лицензия гида</div>
                <div class="subtitle mb-4">Если у Вас есть лицензия, обязательно покажите ее, это повысит уровень доверия к Вам</div>
                <license-uploader :data="profile.user_files"></license-uploader>
            </div>
        </div>

        <div class="btn btn-blue" @click="saveProfile()">Сохранить</div>
    </div>
</template>

<script>
import ProfileGeolocation from './ProfileGeolocation'
import Tags from '../general/Tags'
import {mapActions, mapGetters, mapState} from 'vuex'
import ProfileCity from '../Profile/ProfileCity'
import MultiPhone from '../general/MultiPhone'
import TimeToCall from '../general/TimeToCall'
import ProfileServices from '../Profile/ProfileServices'
import ProfileOtherContact from '../Profile/ProfileOtherContact'
import LicenseUploader from '../general/LicenseUploader'
export default {
    props: ['data'],
    components: { ProfileCity, Tags, ProfileGeolocation, MultiPhone, 
                    TimeToCall, ProfileServices, ProfileOtherContact,
                    LicenseUploader, },

    data() {
        return {
            profile: {
                name: this.data.name || '',
                secondname: this.data.secondname || '',
                language: this.data.language || [],
                city: this.data.city || [{}],
                contact: this.data.contact || [{type: 1}],
                time_to_call: this.data.time_to_call || {},
                services: this.data.services || [],
                other_contact: this.data.other_contact || [],
                user_files: this.data.user_files || [],

                about: this.data.about || ''
            },

            languageArray: [
                {id: 1, value: 'Русский'},
                {id: 2, value: 'Английский'},
                {id: 3, value: 'Французский'},
                {id: 4, value: 'Немецкий'}
            ],
            languageOtherContact: [
                {id: 1, icon:'far fa-envelope', placeholder: 'Эл.почта'},
                {id: 2, icon:'fab fa-vk', placeholder: 'Вконтакте'},
                {id: 3, icon:'fab fa-skype', placeholder: 'Скайп'},
                {id: 4, icon:'fab fa-odnoklassniki', placeholder: 'Одноклассники'},
                {id: 5, icon:'fas fa-desktop', placeholder: 'Сайт'},
                {id: 6, icon:'fab fa-instagram', placeholder: 'Инстаграмм'},
                {id: 7, icon:'fab fa-facebook-f', placeholder: 'Facebook'},
                {id: 8, icon:'fab fa-twitter', placeholder: 'Twitter'},
                {id: 9, icon:'fab fa-whatsapp', placeholder: 'Whatsup'},
                {id: 10, icon:'fab fa-viber', placeholder: 'Viber'},
                {id: 11, icon:'fab fa-telegram-plane', placeholder: 'Telegram'},
            ],
        }
    },
    methods: {
        // Выбор языка
        changeLanguage (val) {
            this.profile.language = val
        },

        // Города страны
        changeCity (id,index) {
            Vue.set(this.profile.city, index, id)
        },
        addNewCity() {
            if(this.profile.city.length < 5) {
                this.profile.city.push({})
            }
        },
        deleteCity(index) {
            this.profile.city.splice(index,1)
        },

        // Контакты
        changeContact(data, index) {
            Vue.set(this.profile.contact, index, data)
        },
        addNewContact() {
            this.profile.contact.length < 5 ? this.profile.contact.push({type: 1, value: ''}) : false
        },

        // Удобное время для связи
        changeTimeToCall(data) {
            this.profile.time_to_call = data
        },

        // Услуги 
        changeServices(data) {
            this.profile.services = data
        },

        // Дополнительные поля контактов
        otherContact(item) {
            if(this.profile.other_contact) {
                return this.profile.other_contact.find(x => x.id === item.id)
            }
        },
        changeOtherContact(data, index, id) {
            var arrIndex = this.profile.other_contact.findIndex(x => x.id === id)
            console.log(arrIndex);
            
            if(arrIndex > -1) {
                Vue.set(this.profile.other_contact, arrIndex, data)
            } else {
                this.profile.other_contact.push(data)
            }
            
        },



        // Сохранение профиля
        saveProfile () {
            axios.put('/profile/update', this.profile).then(r => r.data)
        }
    }
}
</script>

<style scoped>

</style>