<template>
    <div>
        <!-- Основные контакты -->
        <div class="guide-contact__general">
            <div class="guide-contact__list d-flex flex-wrap">
                <!-- city -->
                <div v-if="city" class="d-flex flex-wrap">
                    <div class="guide-contact__item mr-5 mb-3" v-for="(item, index) in comCity" :key="index">
                        <i class="fas fa-map-marker-alt"></i>
                        <div class="guide-contact__name">{{ item }}</div>
                    </div>
                </div>
                
                 <!-- other contact -->
                <div v-if="comPhone" class="d-flex flex-wrap">
                    <div class="guide-contact__item mr-5 mb-3" v-for="(phone, i) in comPhone" :key="i">
                        <i class="fas fa-phone"></i>
                        <div class="guide-contact__name">{{ phone.value }}</div>
                    </div>
                </div>

                <div v-if="comGeneralOther" class="d-flex flex-wrap">
                    <div class="guide-contact__item mr-5 mb-3" v-for="(item,index) in comGeneralOther" :key="index">
                        <i :class="setting.find(x => x.id === item.id).icon"></i>
                        <div class="guide-contact__name">{{ item.value }}</div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Дополнительные контакты -->
        <div class="guide-contact__other" v-if="openOtherContact">
            <div class="subtitle mt-1 mb-2">Дополнительные</div>
            <div class="guide-contact__list d-flex flex-wrap">
                <div v-if="comOtherContact" class="d-flex flex-wrap">
                    <div class="guide-contact__item mr-5 mb-3" v-for="(item,index) in comOtherContact" :key="index">
                        <i :class="setting.find(x => x.id === item.id).icon"></i>
                        <div class="guide-contact__name">{{ item.value }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="guide-contact__more" @click="openOtherContact = true" v-if="!openOtherContact">
            <span>Показать</span>  
            <div class="guide-contact__more-arr"><i class="fas fa-angle-down"></i></div>
        </div>
        <div class="guide-contact__more" @click="openOtherContact = false" v-if="openOtherContact">
            <span>Скрыть</span> 
            <div class="guide-contact__more-arr"><i class="fas fa-angle-up"></i></div>
        </div>

    </div>
</template>

<script>
import setting from '../../../setting/SettingLang.js'
export default {
    props: ['contact', 'other_contact', 'city', 'email'],
    data() {
        return {
            comCity: [],
            comPhone: this.contact || '',
            comGeneralOther: this.other_contact.filter(x => x.favorite === true) || '',
            comOtherContact: this.other_contact.filter(x => x.favorite !== true) || '',
            setting: setting.languageOtherContact,
            openOtherContact: false,
        }
    },
    computed: {
        
    },
    methods: {
        
    },
    mounted() {
        console.log(setting);
        this.city.forEach(cityId => {
            axios.get('/geo?id=' + cityId).then(r => r.data) 
                .then(response => {
                    this.comCity.push(response.city)
                })
        });
    }
}
</script>

<style scoped lang="sass">
.guide-contact 
    &__item
        color: #75797e
    &__name
        font-size: 0.9363rem
        color: #75797e
    &__more
        cursor: pointer
        display: flex
        align-items: center 
        justify-content: flex-end
        & span
            font-size: 0.75rem
            font-weight: 500
            text-transform: uppercase
            margin-right: 0.5rem
        &-arr
            font-size: 1.25rem
            color: #60c1fd

</style>