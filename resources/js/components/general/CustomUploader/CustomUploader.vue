<template>
    <div class="form-group custom-uploader">
        <input type="file" id="article_cover" ref="file" @change="change">
        <label for="article_cover" class="border25">
            <div class="custom-upload-title">Обложка</div>
        </label>
    </div>
</template>

<script>
    export default {
        name: 'CustomUploader',
        props: ['action'],

        data() {
            return {
                file: '',
                success: '',
                error: '',
            }
        },

        methods: {
            change(val) {
                console.log(this.$refs.file.files[0])
                axios.post(window.baseApiUrl + this.action, {image: this.$refs.file.files[0]}, {
                    headers: {'Content-Type': 'multipart/form-data'}
                }).then(r => r.data)
                    .then(response => {
                        this.success = response
                    }).catch(error => {
                        this.error = error
                    })
            }
        },
        
    }
</script>

<style lang="sass" scoped>
// custom-uploader
.custom-uploader
    & input 
        position: absolute
        left: -9999px
    & label
        width: 100%
        height: 10rem
        border: 1px solid #405089
        display: flex
        justify-content: center
        align-items: center
        & .custom-upload-title
            font-size: 0.875rem
            font-weight: 500
            color: #405089
</style>