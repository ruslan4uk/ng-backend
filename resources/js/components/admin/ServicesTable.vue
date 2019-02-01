<template>
    <div class="lk__card mb-3">
        <div class="lk__title">Управление услугами гидов</div>

        
            <div class="alert alert--success mb-3" role="alert">
                
            </div>

        <div class="table-flex-guide mb-2">
            <div class="table-flex-guide__header">
                <div class="table-flex-guide__row">
                    <div class="table-flex-guide__col table-flex-guide__col--name">Название</div>
                    <div class="table-flex-guide__col table-flex-guide__col--createdon">Описание</div>
                    <div class="table-flex-guide__col table-flex-guide__col--btns"></div>
                </div>
            </div>

                <div class="table-flex-guide__body">
                    <div class="table-flex-guide__row">
                        <div class="table-flex-guide__col table-flex-guide__col--name">
                            <div class="user-pic lk__userpic">
                                <div class="user-pic__name">  </div>
                            </div>
                        </div>
                        <div class="table-flex-guide__col table-flex-guide__col--createdon">  </div>
                        <div class="table-flex-guide__col table-flex-guide__col--btns admin__btns admin__btns--end">
                            <a href="" class="admin__btn admin__btn--edit">Редактировать</a>
                            <form action="" method="post">
                                <!-- @method('DELETE')
                                @csrf -->
                                <button type="submit" class="admin__btn admin__btn--delete">Удалить</button>
                            </form>
                        </div>
                    </div>  
                </div>

        </div>

        <a href="" class="btn btn--blue">Добавить</a>

    </div>
</template>

<script>
import axios from 'axios';
export default {
    data: () => ({
        postBody: '',
        elements: [],
        modal: false,
    }),
    created() {
        this.elementsGet()
    },
    methods: {
        elementsGet() {
            axios.get('/admin/api/services', {
                body: this.postBody
            }).then(responsive => {})
            .catch(e => {
                this.error.push(e)
            })
        }
    }
}
</script>

<style lang="sass">
    
</style>