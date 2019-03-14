<template>
    <div>
        <div class="position-relative">
            <input type="text" class="form-control" :placeholder="comPlaceholder" ref="inputCity" v-model="target" @input="search($event.target.value)" :disabled="disabled" @blur="blurCity()">
            <div class="close" @click="deleteCity()" v-if="disabled"><i class="fas fa-times"></i></div>
            <div class="suggest" v-if="suggest.length > 0 && suggestVisible">
                <a v-for="(item,index) in suggest" :key="index" @click="changeCity(item,index)">{{item.city}}, {{item.country_name}}</a>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['currentId','i','placeholder'],

    data() {
        return {
            //city: [{}],
            comPlaceholder: this.placeholder || 'Город проживания',
            suggest: '',
            disabled: Number.isInteger(this.currentId) ? true : false,
            target: '',
            suggestVisible: false
        }
    },
    methods: {
        search(query) {
            axios.get('/geo?q=' + query).then(r => r.data) 
                .then(response => {
                    this.suggest = response
                    this.suggestVisible = true
                })
        },
        changeCity(item) {
            this.target = item.city + ', ' + item.country_name
            this.suggestVisible = false,
            this.disabled = true
            this.$emit('change', item.id, this.i)
        },
        deleteCity() {
            this.$emit('delete', this.i)
        },
        blurCity() {
            setTimeout(() => {
                this.suggestVisible = false
                !this.disabled ? this.target = '' : this.target = this.target
            }, 200);
        },
        getCityFromId() {
            if(Number.isInteger(this.currentId)) {
                axios.get('/geo?id=' + this.currentId).then(r => r.data) 
                    .then(response => {
                        this.target = response.city + ', ' + response.country_name
                    })
            }
        }
    },
    mounted() {
        this.getCityFromId()
    },
    watch: {
        currentId: function(val) {
            this.getCityFromId()
            this.disabled = Number.isInteger(this.currentId) ? true : false
            this.target = !Number.isInteger(this.currentId) ? '' : this.target = this.target
        },
    }
}
</script>

<style scoped lang="sass">
.fix 
    margin-bottom: 1rem
.suggest
    position: absolute
    width: 100%
    background: #ffffff
    border-bottom: 1px solid #ccc
    border-right: 1px solid #ccc
    border-left: 1px solid #ccc
    z-index: 2
    max-height: 10rem
    overflow-y: scroll
    box-shadow: 0 0 7px 2px rgba(0,0,0,.1)
    & a 
        display: block
        width: 100%
        font-size: 0.75rem
        font-weight: 500
        padding: 0.25rem
        color: #666
        border-top: 1px solid #ccc
        cursor: pointer
.close 
    position: absolute 
    top: 0.25rem
    right: 0.25rem
    width: 1rem
    height: 1rem
    & svg 
        max-width: 100%
        max-height: 100% 
</style>