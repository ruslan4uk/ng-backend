<template>
    <div class="lk__card mb-3">
        <div class="lk__title mb-2">Управление услугами гидов</div>

        <div class="alert alert--success mb-1" role="alert" v-if="success">
            <ul>
                <li>{{ success }}</li>
            </ul>
        </div>

        <div class="table-flex-guide mb-2">
            <div class="table-flex-guide__header">
                <div class="table-flex-guide__row">
                    <div class="table-flex-guide__col table-flex-guide__col--name">Название</div>
                    <div class="table-flex-guide__col table-flex-guide__col--createdon">Описание</div>
                    <div class="table-flex-guide__col table-flex-guide__col--btns"></div>
                </div>
            </div>

                <div class="table-flex-guide__body" v-if="services">
                    <div class="table-flex-guide__row" v-for="service of services" :key="service.id">
                        <div class="table-flex-guide__col table-flex-guide__col--name">
                            <div class="user-pic lk__userpic">
                                <div class="user-pic__name"> {{ service.title }} </div>
                            </div>
                        </div>
                        <div class="table-flex-guide__col table-flex-guide__col--createdon">  </div>
                        <div class="table-flex-guide__col table-flex-guide__col--btns admin__btns admin__btns--end">
                            <a href="" class="admin__btn admin__btn--edit" @click.prevent="modalTitle = 'Редактировать услугу', updateServices(service.id)">Редактировать</a>
                            <button type="submit" class="admin__btn admin__btn--delete" @click.prevent="elementsDelete(service.id)">Удалить</button>
                        </div>
                    </div>  
                </div>

        </div>

        <a href="" class="btn btn--blue" 
            @click.prevent="
                modal = !modal, 
                modalTitle = 'Добавить услугу',
                formData.id = '',
                formData.title = '',
                formData.description = '',
                update = false
            ">Добавить</a>

        <!-- Modal window -->
        <div class="modal" v-if="modal">
            <div class="modal__dialog modal__dialog--medium">
                <div class="modal__content">
                    <div class="modal__header">
                        <div class="modal__htitle">{{ modalTitle }}</div>
                        <div class="modal__close" @click.prevent="modal = false"></div>
                    </div>
                    <div class="modal__body form">
                        <form @submit.prevent="elementsCreate">
                            <input type="hidden" name="" v-model="formData.id">
                            <div class="form__group">
                                <input type="text" class="form__input" name="" value="" v-model="formData.title" placeholder="Наименование">
                                <span class="invalid-feedback" v-if="errors.title"> <strong>{{errors.title[0]}}</strong> </span>
                            </div>
                            <div class="form__group">
                                <input type="text" class="form__input" name="" value="" v-model="formData.description" placeholder="Описание">
                                <span class="invalid-feedback" v-if="errors.description"> <strong>{{errors.description[0]}}</strong> </span>
                            </div>
                            <input type="submit" class="btn btn--blue" value="Сохранить"> 
                        </form>
                        
                        <div v-if="update" class="alert alert--success alert--update">
                            <ul>
                                <li>{{ update }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>

export default {
    data: () => ({
        services: [],
        errors: '',
        success: '',
        update: '',
        modal: false,
        formData: {
            id: '',
            title: '',
            description: ''
        },
    }),
    created() {
        this.elementsGet();
        let self = this;

        window.addEventListener('click', function(e){
            // close dropdown when clicked outside
            if (!self.$el.contains(e.target)){
                self.modal = false
            } 
        })
    },
    methods: {
        // Services get list
        elementsGet() {
            window.axios.get('admin/api/v1/services')
            .then(response => {
                this.services = response.data.data
            })
            .catch(error => {
                this.errors = error.response.data.errors || error.message;
            });
        },
        // Services create
        elementsCreate() {
            if(this.formData.id) {
                window.axios.put('admin/api/v1/services/' + this.formData.id, this.formData)
                .then(response => {
                    this.update = response.data.success;
                    this.elementsGet();
                })
                .catch(error => {
                    this.errors = error.response.data.errors || error.message;
                });
            } else {
                window.axios.post('admin/api/v1/services', this.formData)
                .then(response => {
                    this.notify('success', response.data.success);
                    this.elementsGet();
                    this.modal = false;
                })
                .catch(error => {
                    this.errors = error.response.data.errors || error.message;
                });
            }
            
        },

        // Service delete
        elementsDelete(id) {
            let uri = `admin/api/v1/services/${id}`;
            window.axios.delete(uri).then(response => {
                this.elementsGet();
            });
        },

        // Services update 
        updateServices(id) {
            this.update = false
            window.axios.get('admin/api/v1/services/' + id)
            .then(response => {
                this.formData = response.data.data;
                this.modal = true;
            })
            .catch(error => {
                this.errors = error.response.data.errors || error.message;
            });
        },

        notify(status,msg) {
            if(status == 'success') {
                this.success = msg;
                setTimeout(() => {
                    this.success = ''
                },4000)
            }
            if(status == 'error') {
                this.errors = msg;
                setTimeout(() => {
                    this.errors = ''
                },4000)
            }
        }
    }
}
</script>

<style lang="sass">
    .alert--update
        margin-top: 1.25rem
</style>