<template>
    <div>
        <b-form>
            <b-row>
                <b-col cols="12" md="8" lg="7">
                    <b-form-group>
                        <b-form-input
                            type="text"
                            placeholder="Введите Ваше имя или название компании">
                        </b-form-input>
                        <small class="form-text text-danger"></small>
                    </b-form-group>
                </b-col>
            </b-row>
            <div class="row">
                <div class="col-12 col-md-6">
                    <b-form-group>
                        <b-form-input
                            type="text"
                            placeholder="Наименование">
                        </b-form-input>
                        <small class="form-text text-danger"></small>
                    </b-form-group>
                    <b-button type="submit" class="btn-blue">Отправить</b-button>
                </div>
            </div>
        </b-form>
        
    </div>
</template>

<script>
export default {
    
}
</script>

<style lang="sass">
    
</style>