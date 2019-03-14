<template>
    <div>
        <div class="d-flex align-items-center profile-avatar">
            <div class="profile-avatar__userpic mr-3 d-flex align-items-center">
                <img :src="comAvatar + timestamp" alt="">
            </div>
            <div class="profile-avatar__name">{{name}}</div>
        </div>
        <label for="profile-avatar" class="profile-avatar__add mt-2">Добавить фото</label>
        <input type="file" name="avatar" ref="avatar" id="profile-avatar" class="profile-avatar__uploader" @change="changeAvatar">
    </div>
</template>

<script>

export default {
    props: ['name', 'avatar'],

    data() {
        return {
            comAvatar: this.avatar || 'images/empty-avatar.png',
            image: '',
            timestamp: '',
        }
    },

    methods: {
        changeAvatar() {
            this.image = this.$refs.avatar.files[0];   
            let formData = new FormData
            formData.append('file', this.image)

            axios.post('/profile/upload/avatar', formData, {headers: {'Content-Type': 'multipart/form-data'}})
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
// .profile-avatar
//     &__userpic
//         width: 6rem
//         flex: 0 0 6rem
//         & img 
//             width: 100%
//             border-radius: 50%
//     &__name 
//         font-size: 1.5rem
//         font-weight: 500
//         line-height: 1.2
//     &__add 
//         font-size: 0.75rem
//         color: #405089
//         font-weight: 400
//         cursor: pointer
//     &__uploader
//         position: absolute
//         left: -9999px
</style>