<template>
    <div :class="'alert alert-dismissible fade show alert-' + getError.variant" role="alert" v-if="getError.status">
        <div v-for="(textError, index) in getError.text" :key="index">
            {{textError[0]}}
        </div>
        <button type="button" class="close" @click.prevent="clearError">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</template>

<script>
import { mapGetters, mapActions, mapMutations } from 'vuex';
export default {
    name: 'Alert',
    computed: {
        ...mapGetters('error', ['getError'])
    },
    methods: {
        ...mapActions('error', ['clearError'])
    }
}
</script>

<style scoped>

</style>