<template>
    <div class="col-12 col-md-6">
        <div class="form-group other-contact">
            <input type="text" class="form-control pl-4 pr-4" :placeholder="placeholder" v-model="contact.value" @keyup="change">
            <div class="other-contact__icon">
                <i :class="icon"></i>
            </div>
            <div class="other-contact__favorite" :class="{ active: contact.favorite }" @click="changeFavorite">
                <i class="fas fa-star"></i>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['placeholder', 'icon', 'data', 'idnumber', 'index'],
        data() {
            return {
                contact: this.data || {
                    id: this.idnumber,
                    value: '',
                    favorite: false,
                },
            }
        },
        methods: {
            change() {
                this.$emit('change', this.contact, this.index, this.idnumber)
            },
            changeFavorite() {
                this.contact.favorite = !this.contact.favorite
                this.$emit('change', this.contact, this.index, this.idnumber)
            }
        }
    }
</script>

<style scoped lang="sass">
.other-contact 
    position: relative
    &__icon 
        position: absolute 
        top: 0.375rem 
        left: 0
        color: #405089
        width: 1.25rem
        height: 1.375rem
        text-align: center
    &__favorite
        color: #eee
        font-size: 0.625rem
        position: absolute 
        top: 0.5rem 
        right: 0
        cursor: pointer
        transition: all ease 0.2s
        &.active 
            color: #ff7555
</style>