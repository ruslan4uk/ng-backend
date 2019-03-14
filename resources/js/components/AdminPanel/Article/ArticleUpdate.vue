<template>
    <div class="card card-panel">
        <div class="card-body">
            <div class="title">{{pageTitle}}</div>
            <div class="row">
                <form action="" class="col-12">

                    <custom-uploader 
                        action="article" 
                        title="Загрузите обложку"
                        :image="article.cover_big"
                        @upload="changeCoverBig">
                    </custom-uploader>

                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Заголовок" 
                            :value="article.title" name="title" @input="onInput">
                    </div>

                    <div class="form-group">
                        <multiselect 
                            :value="getCity"
                            :options="getCityList"
                            :max-height="250" 
                            :show-labels="false" 
                            :searchable="true"
                            :internal-search="true"
                            :clear-on-select="false"
                            :loading="getLoading" 
                            :allow-empty="false"
                            track-by="geonameId"
                            key="idd"
                            label="name"
                            @search-change="cityGeo"
                            @select="onCitySelect"
                            :custom-label="cityName"
                            placeholder="Город"
                            required>
                            <span slot="noResult">Не найдено</span>
                        </multiselect>
                    </div>

                    <div class="form-group">
                        
                    </div>

                    <div class="form-group mb-4">
                        <div class="subtitle">Текст (область контент)</div>
                        <ckeditor type="classic" 
                            :value="article.content" 
                            :upload-adapter="UploadAdapter"
                            @input="onEditor"></ckeditor>
                    </div>

                    <alert></alert>

                    <div class="form-group">
                        <button type="submit" class="btn btn-blue" @click.prevent="sendForm">Сохранить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>

import Multiselect from 'vue-multiselect'
import CustomUploader from '../../general/CustomUploader/CustomUploader'
import { mapGetters, mapActions, mapMutations } from 'vuex';
import Alert from '../../general/Alert'
export default {
    name: 'ArticleShow',
    components: { Multiselect, CustomUploader, Alert},
    data() {
        return {
            UploadAdapter: function (loader) {
                this.loader = loader
                this.upload = () => {
                    const body = new FormData();
                    body.append('file', this.loader.file);
                    body.append('action', 'article');
                    return axios.post(window.baseApiUrl + "upload", body).then(r => r.data)
                    .then(downloadUrl => {
                        return {default: downloadUrl.url}
                    })
                    .catch(error => {
                        console.log(error);
                    });
                }
                this.abort = () => {
                    console.log('Abort upload.')
                }
            }
        }
    },
    computed: {
        ...mapGetters('cityApi', ['getCity', 'getCityList', 'getLoading']),
        ...mapGetters('article', ['article']),

        pageTitle() {
            return this.$route.meta.title;
                      
        }
    },
    methods: {
        ...mapMutations('article', ['CHANGE_VALUE']),
        ...mapActions('article', ['getArticle', 'sendArticle', 'clearForm']),
        ...mapMutations('cityApi', ['SET_CITYONE', 'CLEAR']),
        ...mapActions('cityApi', ['cityGeo', 'cityGeoSearch', 'setCity', 'cityGetJSON']),

        onCitySelect(value) {
            this.SET_CITYONE(value)
            this.CHANGE_VALUE({input: 'country', value: value.countryId})
            this.CHANGE_VALUE({input: 'city', value: value.geonameId})            
        },

        onInput (e) {
            this.CHANGE_VALUE({input: e.target.name, value: e.target.value})            
        },

        onEditor (value) {
            this.CHANGE_VALUE({input: 'content', value: value})   
        },

        sendForm() {
            this.sendArticle(this.article.id);
        },

        cityName({name, countryName, countryCode}) {
            return `${name}, ${countryName}`
        },

        changeCoverBig(value) {
            this.CHANGE_VALUE({input: 'cover_big', value: value})
        }

    },
    created() {
        this.clearForm({})
        this.getArticle(this.$route.params.id)
        this.cityGeo('')
    },
}
</script>

<style scoped>

</style>