<template>
    <div class="col-12 col-lg-6 form-group position-relative" >
        <i :class="'form-icon ' + input.icon"></i>
        <input type="text" class="form-control pl-4 pr-3" 
            v-model="valueInput.value"
            :placeholder="input.placeholder">
        <div class="form-star" data-toggle="tooltip" data-placement="top" title="В избранное"
            :class="{active: valueInput.favorite}" 
            @click="valueInput.favorite = !valueInput.favorite">
            <i class="fas fa-star"></i>
        </div>
        
    </div>
</template>

<script>
export default {
    props: ['input','contact'],
    data () {
        return {
            valueInput: _.find(this.contact, {'name': this.input.name}),
        }
    },
    created() {
        
    },
    computed: {
        'item': function() {
            return _.filter(this.contact, {'name': this.input.name})
        }
    }
    // watch: {
    //     'contact': function (val) {
    //         this.$emit('contact', val)
    //     }
    // }
}
</script>

<style lang="sass">
    
</style>