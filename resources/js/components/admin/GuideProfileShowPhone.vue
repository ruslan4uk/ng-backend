<template>
    <div class="row">
        <div class="col-12 col-sm-8 col-lg-6">
            <div class="form-group mb-1">
                <div class="form-row">
                    <div class="form-group col multiselect__col">
                        <multiselect 
                            v-model="formData.phoneType" 
                            :options="phoneTypes"
                            :max-height="250" 
                            :show-labels="false" 
                            :searchable="true"
                            :internal-search="true"
                            :clear-on-select="false"
                            :allow-empty="false"
                            placeholder="Телефон"
                            class="form-control">
                                <span slot="noResult">Не найдено</span>
                        </multiselect>
                    </div>
                    <div class="form-group col">
                        <input type="text" v-model="formData.phoneNumber" class="form-control" id="" placeholder="+7">
                    </div>
                </div>
            </div>
            <div class="form-helper mb-2">Введите номер с кодом города, напр. +7&nbsp;495&nbsp;646-84-89&nbsp;или&nbsp;(495)&nbsp;6468489</div>
        </div>  
        <div class="col-12">
            <div class="form-group mb-1">
                <div class="form-check-inline form-check" v-for="(itemCheckbox,index) in phoneMessengerType" :key="index">
                    <input type="checkbox" class="form-check-input"
                        v-model="formData.phoneMessenger"
                        :value="itemCheckbox"
                        :id="'messenger_' + index + phonekey">
                    <label class="form-check-label" :for="'messenger_' + index + phonekey">{{itemCheckbox}}</label>
                </div>
            </div>
            <!-- {{formData.varMessenger}} -->
        </div>  
    </div>
</template>

<script>
import Multiselect from 'vue-multiselect'
export default {
    components: { Multiselect },
    props: ['type', 'number', 'messenger', 'phonekey'], 
    data () {
        return {
            phoneTypes: ['Домашний', 'Рабочий'],
            phoneMessengerType: ['Whatsapp','Viber','Telegram','Wechart'],
            
            formData: {
                phoneType: this.type,
                phoneNumber: this.number,
                phonePhonekey: this.phonekey,
                phoneMessenger: this.messenger || [],
            }
        }
    },
    watch: {
        'formData.phoneNumber': function(val) {
            this.$emit('change', this.formData)
        },
        'formData.phoneType': function() {
            this.$emit('change', this.formData)
        },
        'formData.phoneMessenger': function() {
            this.$emit('change', this.formData)
        }
    }
}
</script>

<style lang="sass">
    
</style>