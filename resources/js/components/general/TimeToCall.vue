<template>
    <div class="row">
        <div class="col-12 col-md-6 mb-3" v-for="(item, index) in time" :key="index">
            <div class="contact-row">
                <div class="contact-row__name mr-3">{{ day(item.id) }}</div>
                <input type="text" placeholder="С" class="mr-3" v-model="item.from" @keyup="changeContact">
                <input type="text" placeholder="По" class="mr-3" v-model="item.to" @keyup="changeContact">
                <div class="contact-row__delete" @click="deleteTime(item,index)">
                    <i class="fas fa-times"></i>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['data'],
        data() {
            return {
                time: this.data.length ? this.data : [
                    {id: 1, from: '', to: ''},
                    {id: 2, from: '', to: ''},
                    {id: 3, from: '', to: ''},
                    {id: 4, from: '', to: ''},
                    {id: 5, from: '', to: ''},
                    {id: 6, from: '', to: ''},
                    {id: 7, from: '', to: ''},
                ],
                lang: [
                    {id: 1, value: 'Пн:'},
                    {id: 2, value: 'Вт:'},
                    {id: 3, value: 'Ср:'},
                    {id: 4, value: 'Чт:'},
                    {id: 5, value: 'Пт:'},
                    {id: 6, value: 'Сб:'},
                    {id: 7, value: 'Вс:'},
                ]
            }
        },
        methods: {
            day(id) {
                return this.lang.find(x => x.id === id).value
            },
            changeContact() {
                this.$emit('change', this.time)
            },
            deleteTime(item,index) {
                this.time[index].from = ''
                this.time[index].to = ''
            }
        },
    }
</script>

<style scoped lang="sass">
.contact-row 
    display: flex
    align-items: center
    &__name 
        font-weight: 500
        font-size: 0.85rem
        margin-bottom: 0.25rem
        width: 1.5rem
    &__delete
        padding: 0.25rem
        font-size: 8px
        color: #fff
        border-radius: 50%
        width: 14px
        height: 14px
        background-color: #ff7555
        display: flex 
        justify-content: center 
        align-items: center
        text-align: center
        cursor: pointer
    & input 
        max-width: 4rem
</style>