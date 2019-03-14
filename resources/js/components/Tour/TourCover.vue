<template>
    <div class="tour-cover">
        <div class="d-flex align-items-center tour-cover">
            <div class="tour-cover__image d-flex align-items-center">
                <img :src="comAvatar + timestamp" alt="">
            </div>
        </div>
        <label for="tour-cover" class="tour-cover__add mt-2">Добавить фото</label>
        <input type="file" name="avatar" ref="avatar" id="tour-cover" class="tour-cover__uploader" @change="changeAvatar">
    </div>
</template>

<script>

export default {
    props: ['name', 'cover','pageid'],

    data() {
        return {
            comAvatar: this.cover || 'images/empty-avatar.png',
            image: '',
            timestamp: '',
        }
    },

    methods: {
        changeAvatar() {
            this.image = this.$refs.avatar.files[0];   
            let formData = new FormData
            formData.append('file', this.image)
            formData.append('pageid', this.pageid)

            axios.post('/profile/tour/upload/cover', formData, {headers: {'Content-Type': 'multipart/form-data'}})
                .then(response => {
                    this.comAvatar = response.data
                    this.timestamp = '?' + Math.floor(Date.now() / 1000)
                })
                .catch(err => {
                    console.log('error');
                })
        }
    }
}
</script>

<style scoped lang="sass">
.tour-cover
    text-align: center
    &__image
        width: 100%
        & img 
            width: 100%
            border-radius: 25px
    &__name 
        font-size: 1.5rem
        font-weight: 500
        line-height: 1.2
    &__add 
        font-size: 0.75rem
        color: #405089
        font-weight: 400
        cursor: pointer
        margin: 0 auto
    &__uploader
        position: absolute
        left: -9999px
</style>