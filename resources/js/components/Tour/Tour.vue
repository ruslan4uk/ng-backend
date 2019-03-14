<template>
    <div class="row">
        <div class="col-12 col-md-3 mb-5">
            <tour-cover :cover="tour.cover" :pageid="tour.id"></tour-cover>
        </div>
        <div class="col-12 col-md-9">
            <div class="card card-panel mb-5">
                <div class="card-body">
                    <div class="title">Основная информация</div>
                    <div class="row">
                        <!-- Name -->
                        <div class="form-group col-12 col-md-8">
                           <input type="text" class="form-control" v-model="tour.name" placeholder="Введите название экскурсии">
                        </div>

                        <!-- City -->
                        <div class="form-group col-12 col-md-8">
                            <profile-geolocation :currentId="tour.city" @change="changeCity" @delete="deleteCity" placeholder="Отправная точка эскурсии"></profile-geolocation>
                            <div class="form-helper">Введите название города и место начала экскурсии</div>
                        </div>

                        <!-- Route -->
                        <div class="form-group col-12 col-md-6">
                            <input type="text" v-model="tour.route" class="form-control" placeholder="Маршрут экскурсии">
                            <div class="form-helper mt-2">
                                Введите краткое описание маршрута, напр. Колизей — Ватикан — Вилла Д’Эсте
                            </div>
                        </div>

                        <!-- Language -->
                        <div class="form-group col-12">
                            <tags @change="changeLanguage" :placeholder="'Выберите языки'" :options="languageArray" :selected="tour.language"></tags>
                        </div>

                        <!-- Category -->
                        <div class="col-12 col-md-8">
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <vue-select :current="tour.category" 
                                                :option="categoryArray" 
                                                :placeholder="'Выберите категорию'"
                                                @change="changeCategory"></vue-select>
                                </div>
                                <div class="col-12 col-md-6">
                                    <vue-select :current="tour.active_for"
                                                :placeholder="'Экскурсия доступна для...'"
                                                :option="activeForArray"
                                                @change="changeActiveFor"></vue-select>
                                </div>

                                <!-- Member Count -->
                                <div class="form-group col-12 col-md-6">
                                    <input type="number" v-model.number="tour.member_count" class="form-control" placeholder="Колличество участников">
                                </div>
                            </div>
                        </div>

                        <!-- Рассписание -->
                        <div class="col-12 mb-2">
                            <div class="subtitle">Рассписание</div>
                            <time-to-call :data="tour.timing" @change="changeTiming"></time-to-call>
                        </div>
                        
                        <!-- PRICE -->
                        <div class="col-12 mb-4">
                            <tour-price :data="{price: tour.price, currency: tour.currency}" @change="changePrice"></tour-price>
                        </div>

                        <!-- Услуги -->
                        <div class="form-group col-12 col-md-6">
                            <input type="text" v-model="tour.service" class="form-control" placeholder="Услуги">
                            <div class="form-helper">Введите через запятую услуги, которые входят в экскурсию</div>
                        </div>

                        <!-- Дополнительные расходы -->
                        <div class="form-group col-12 col-md-6">
                            <input type="text" v-model="tour.other" class="form-control" placeholder="Дополнительные расходы">
                            <div class="form-helper">Например, питание, или проезд на транспорте</div>
                        </div>

                        <!-- Что с собой взять -->
                        <div class="form-group col-12 col-md-6 mb-4">
                            <input type="text" v-model="tour.what_to_take" class="form-control" placeholder="Что с собой взять">
                        </div>

                        <!-- Фотографии -->
                        <div class="col-12">
                            <div class="subtitle">Фото экскурсии</div>
                            <photo-uploader :data="tour.photo" :pageid="tour.id"></photo-uploader>
                        </div>

                    </div>
                </div>
            </div>

             <!-- Расскажите о себе -->
            <div class="card card-panel mb-5">
                <div class="card-body">
                    <div class="title mb-0">Расскажите туристам об экскурсии</div>
                    <div class="subtitle">не использовать тексты с других сайтов. Проверить уникальность текста text.ru</div>
                    <div class="form-group">
                        <textarea cols="30" rows="10" class="form-control" v-model="tour.about"></textarea>
                    </div>
                </div>
            </div>
            
            <div class="btn btn-sm btn-blue" @click="saveTour()">Сохранить</div>
        </div>
    </div>
</template>

<script>
import ProfileGeolocation from '../Profile/ProfileGeolocation'
import Tags from '../general/Tags'

import VueSelect from '../general/VueSelect'
import TimeToCall from '../general/TimeToCall'
import PhotoUploader from './PhotoUploader'
import TourPrice from './TourPrice'
import TourCover from './TourCover'
export default {
    props: ['data'],
    components: { ProfileGeolocation, Tags, VueSelect, TimeToCall, PhotoUploader, TourPrice, TourCover },
    data() {
        return {
            tour: {
                id: this.data.id,
                name: this.data.name || '',
                cover: this.data.cover || '',
                city: parseInt(this.data.city) || '',
                route: this.data.route || '',
                language: this.data.language || [],
                category: this.data.category || '',
                active_for: this.data.active_for || '',
                member_count: this.data.member_count || '',
                timing: this.data.timing || {},
                price: this.data.price || '',
                currency: this.data.currency || '',
                service: this.data.service || '',
                other: this.data.other || '',
                what_to_take: this.data.what_to_take || '',
                photo: this.data.photo || [],

                about: this.data.about || '',

            },
            languageArray: [
                {id: 1, value: 'Русский'},
                {id: 2, value: 'Английский'},
                {id: 3, value: 'Французский'},
                {id: 4, value: 'Немецкий'}
            ],
            categoryArray: [
                {id: 1, value: 'Категория 1'},
                {id: 2, value: 'Категория 2'},
                {id: 3, value: 'Категория 3'}
            ],
            activeForArray: [
                {id: 1, value: 'Доступна 1'},
                {id: 2, value: 'Доступна 2'}
            ]
        }
    },
    methods: {
        changeCity(id) {
            this.tour.city = id;
        },
        deleteCity() {
            this.tour.city = ''
        },

        // Выбор языка
        changeLanguage (val) {
            this.tour.language = val
        },

        // Выбор категории
        changeCategory (val) {
            this.tour.category = val
        },

        // Доступна для
        changeActiveFor (val) {
            this.tour.active_for = val
        },

        // Удобное время для связи
        changeTiming(data) {
            this.tour.timing = data
        },

        // Прайс
        changePrice(data) {
            this.tour.price = data.price
            this.tour.currency = data.currency
        },

        saveTour() {
            axios.put('/profile/tour/update', this.tour)
                .then(response => {
                    console.log(response);
                })
        }
    }
}
</script>

<style scoped>

</style>