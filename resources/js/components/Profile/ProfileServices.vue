<template>
    <div class="form-group">
        <div class="form-check form-check-inline mb-1" v-for="(item,index) in lang" :key="index">
            <input class="form-check-input" type="checkbox" :id="'service' + item.id" :value="item.id" v-model="services" @change="change">
            <label class="form-check-label" :for="'service' + item.id">{{item.value}}</label>
        </div>
        <div class="form-helper mt-2">* Поставьте галочку напротив ваших услуг</div>
    </div>
</template>

<script>
    export default {
        props: ['data'],
        data() {
            return {
                services: this.data || [],
                lang: [
                    {id: 1, value: 'Частный гид'},
                    {id: 2, value: 'Туристическая компания'},
                    {id: 3, value: 'Трансфер'},
                    {id: 4, value: 'Аренда авто/яхт'},
                    {id: 5, value: 'Организация мероприятий'},
                    {id: 6, value: 'Услуги перевода'},
                    {id: 7, value: 'Шоппинг'},
                ]
            }
        },
        methods: {
            change() {
                this.$emit('change', this.services)
            }
        }
    }
</script>

<style scoped>

</style>