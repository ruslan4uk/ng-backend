<template>
    <div class="lk__card mb-3">
        <div class="lk__title mb-2">Управление гидами</div>

        <div class="alert alert--success mb-1" v-if="success">
            <ul>
                <li>{{ success }}</li>
            </ul>
        </div>

        <!-- new table  -->
        <div class="table-responsive mb-3">
            <div class="table-header">
                <div class="table-row">
                    <div class="table-col">Имя</div>
                    <div class="table-col">Дата регистрации</div>
                </div>
            </div>
            <div class="table-body" v-if="services">
                <div class="table-row align-center" v-for="service of services" :key="service.id">
                    <div class="table-col">{{ service.title }}</div>
                    <div class="table-col end">
                        <button class="admin-btn edit" @click.prevent="modalTitle = 'Редактировать услугу', updateServices(service.id)">
                            <i class="fas fa-pencil-alt"></i>
                        </button>
                        <button class="admin-btn delete" @click.prevent="elementsDelete(service.id)">
                            <i class="far fa-trash-alt"></i>
                        </button>
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
                            <!-- <div class="form__group">
                                <input type="text" class="form__input" name="" value="" v-model="formData.description" placeholder="Описание">
                                <span class="invalid-feedback" v-if="errors.description"> <strong>{{errors.description[0]}}</strong> </span>
                            </div> -->
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
                this.services = response.data
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
                this.formData = response.data;
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

</style>