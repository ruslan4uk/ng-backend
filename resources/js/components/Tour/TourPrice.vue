<template>
    <div>
        <div class="profile-price">
            <div class="form-group">
                <input type="number" v-model.number="comData.price" class="form-control" placeholder="Стоимость">
            </div>
            <vue-select :current="comData.currency" :option="currencyArray" class="profile-price__currency" @change="changeCurrency"></vue-select>
        </div>

        <div class="form-radio form-check-inline">
            <input type="radio" v-model="comData.option" id="price_1" value="1">
            <label for="price_1">С человека</label>
        </div>
        <div class="form-radio form-check-inline">
            <input type="radio" v-model="comData.option" id="price_2" value="2" >
            <label for="price_2">С Группы</label>
        </div>
    </div>
</template>

<script>
import VueSelect from '../general/VueSelect'
export default {
    props: ['data'],
    components: { VueSelect },
    data() {
        return {
            comData: {
                price: this.data.price || '',
                currency: this.data.currency,
                option: this.data.option || []
            },
            currencyArray: [
                {id: 1, value: 'RUB'},
                {id: 2, value: 'USD'}
            ]
        }
    },
    methods: {
        changeCurrency(data) {
            this.comData.currency = data
        }
    },
    watch: {
        'comData.price': function(val) {
            this.$emit('change', this.comData)
        },
        'comData.currency': function(val) {
            this.$emit('change', this.comData)
        },
        'comData.option': function(val) {
            this.$emit('change', this.comData)
        }
    }
}
</script>

<style scoped lang="sass">
.profile-price 
    display: flex
    &__currency 
        max-width: 5rem
</style>