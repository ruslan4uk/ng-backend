<template>
<div class="row">
    <div class="col-12 col-sm-8 col-lg-6">
        <div class="form-group mb-1">
            <div class="form-row">
                <div class="form-group col multiselect__col mb-0">
                    <multiselect 
                        v-model="type" 
                        :options="phoneTypes"
                        :max-height="250" 
                        :show-labels="false" 
                        :searchable="true"
                        :internal-search="true"
                        :clear-on-select="false"
                        :allow-empty="false"
                        label="value"
                        placeholder="Телефон"
                        class="form-control">
                            <span slot="noResult">Не найдено</span>
                    </multiselect>
                </div>
                <div class="form-group col mb-0">
                    <input type="text" v-model="number" class="form-control" id="" placeholder="+7">
                </div>
            </div>
        </div>
        <div class="form-helper mb-2">Введите номер с кодом города, напр. +7&nbsp;495&nbsp;646-84-89&nbsp;или&nbsp;(495)&nbsp;6468489</div>
    </div>  
    <div class="col-12">
        <div class="form-group mb-1">
            <div class="form-check-inline form-check" v-for="(messengerType,index) in messengerTypes" :key="index">
                <input type="checkbox" class="form-check-input" 
                    v-model="messenger" 
                    :id="'messenger_' + track + '_' + index"
                    name="messenger"
                    :value="messengerType">
                <label class="form-check-label" :for="'messenger_' + track + '_' + index">{{messengerType}}</label>
            </div>
        </div>
    </div>  
</div>
</template>

<script>
import {mapGetters} from 'vuex'
import {mapFields} from 'vuex-map-fields'
import Multiselect from 'vue-multiselect'
import { store } from '../../store'
export default {
    name: 'GuideProfileContact',
    components: { Multiselect },
    props: ['track', 'item'],
    data() {
        return {
            contactNew: {
                number: this.item.number || '',
                type: this.item.type || [],
                messenger: this.item.messenger || []
            },

            phoneTypes: [
                {id: 1, value: 'Домашний'},
                {id: 2, value: 'Рабочий'}
            ],

            messengerTypes: ['Whatsup','Viber','Telegram','Wechart']
        }
    },
    created(){
        this.console()
    },
    computed: {
        type: {
            get () {
                return this.$store.state.guide.profile.data.contact[this.track].type
            },
            set (value) {
                this.$store.commit('guide/SET_TYPE', {index: this.track, obj: value})
            }
        },
        number: {
            get () {
                return this.$store.state.guide.profile.data.contact[this.track].number
            },
            set (value) {
                this.$store.commit('guide/SET_NUMBER', {index: this.track, obj: value})
            }
        },
        messenger: {
            get () {
                return this.$store.state.guide.profile.data.contact[this.track].messenger
            },
            set (value) {
                this.$store.commit('guide/SET_MESSENGER', {index: this.track, obj: value})
            }
        }
    },
    methods: {
        console() {
            console.log(store.state.guide.profile.data.contact)
        }
    },
    // watch: {
    //     'contactNew.number': function (newVal) {
    //         this.$emit('change', {index: this.track, obj: this.contactNew})
    //     },
    //     'contactNew.type': function (newVal) {
    //         this.$emit('change', {index: this.track, obj: this.contactNew})
    //     },
    //     'contactNew.messenger': function (newVal) {
    //         this.$emit('change', {index: this.track, obj: this.contactNew})
    //     }
    // }
    
}
</script>

<style scoped>

</style>