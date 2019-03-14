<template>
    <div class="form-group custom-uploader">
        <input type="file" id="article_cover" ref="file" @change="filesChange($event.target.files)">
        <label for="article_cover" class="border25" :style="{ backgroundImage: 'url(' + comImage + ')' }">
            <div class="custom-upload-title" v-if="!comImage">{{title}}</div>
            <div class="custom-upload-loader" v-if="loading"><div><i class="fas fa-spinner"></i></div></div>
            <div class="custom-upload-error" v-if="error">{{error}}</div>
            <div class="custom-upload-delete" v-if="comImage" @click.prevent="deleteFile">
                <div><i class="far fa-trash-alt"></i></div>
            </div>
        </label>
    </div>
</template>

<script>
    /**
     * @props path, image, title, action
     * @emit upload (return url)
     */
    export default {
        name: 'CustomUploader',
        props: {
            image: {
                type: String,
            },
            title: {
                type: String,
                required: true
            },
            action: {
                type: String,
                required: true
            }
        },

        data() {
            return {
                comAction: this.action ? this.action : '',
                comImage: this.image,
                loading: false,
                error: '',
            }
        },

        watch: {
            image() {
                this.comImage = this.image
            }
        },

        methods: {
            filesChange(fileList) {
                this.loading = true;
                var formData = new FormData();
                formData.append('action', this.action);
                formData.append('file', fileList[0]);

                axios.post(window.baseApiUrl + "upload", formData).then(r => r.data)
                    .then(response => {
                        console.log(response.url);
                        this.loading = false
                        response.url ? this.comImage = response.url : this.comImage = ''
                        response.error ? this.error = response.error : this.error = ''
                        this.$emit('upload', this.comImage)
                        }).catch();
                
            },

            deleteFile() {
                this.comImage = ''
                this.$emit('upload', '')
                console.log(this.comImage);
                
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
        height: 15rem
        border: 1px solid #405089
        display: flex
        flex-wrap: wrap
        justify-content: center
        align-items: center
        background-size: cover
        transition: opacity ease 0.3s
        &:hover
            opacity: 0.85
        & .custom-upload-title
            font-size: 0.875rem
            font-weight: 500
            color: #405089
        & .custom-upload-delete
            font-size: 2rem
            color: #405089
            padding: 0.5rem 1rem 
            border-radius: 15px
            background: rgba(255,255,255,0.7)
            opacity: 0
            cursor: pointer
            transition: all ease 0.3s
            &:hover
                background: rgba(255,255,255,0.9)
        & .custom-upload-loader
            animation: spin 2s linear infinite
            font-size: 2rem
            color: #405089
            margin-left: 1rem
        & .custom-upload-error
            width: 100%
            font-size: 0.875rem 
            color: red
            font-weight: 500
            text-align: center

    &:hover .custom-upload-delete
        opacity: 1

@keyframes spin 
    100% 
        -webkit-transform: rotate(360deg)
        transform: rotate(360deg)

</style>