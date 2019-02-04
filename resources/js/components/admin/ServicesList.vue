<template>
    <div>
        <b-card class="card-panel">
            <div class="title">Управление услугами гидов</div>

            <!-- table -->
            <b-table hover :fields="fields" :items="services">
                <template slot="btn" slot-scope="row">
                    <!-- {{row.item.id}} sendItem(row.index,row.item.id) -->
                    <b-button @click="details(row.item,row.index,$event.target), errors='', update=''" size="sm" variant="outline-success" v-b-modal.modalDetail>
                        <i class="fas fa-pencil-alt"></i>
                    </b-button>
                    <b-button @click="deleteId = row.item.id,deleteIndex = row.index" size="sm" variant="outline-danger" v-b-modal.modalConfirm >
                        <i class="far fa-trash-alt"></i>
                    </b-button>
                </template>
            </b-table>
            <b-button v-b-modal.modalCreate @click="form = clearForm, errors='', update=''" class="btn-blue btn-w9">Добавить</b-button>
        </b-card>

        <b-modal id="modalConfirm" size="sm" centered hide-footer title="Удалить?">
            <div class="d-flex justify-content-center">
                <b-btn class="btn-blue" @click="deleteService(deleteIndex,deleteId), $root.$emit('bv::hide::modal','modalConfirm')">Удалить</b-btn>
                <b-btn class="btn-white ml-2" @click="$root.$emit('bv::hide::modal','modalConfirm')">Отменить</b-btn>
            </div>
        </b-modal>

        <!-- modal update -->
        <b-modal id="modalDetail" centered hide-footer title="Редактировать">
            <b-alert variant="success" dismissible show v-if="success">{{ success }}</b-alert>
            <b-form @submit.prevent="updateService" class="mb-3">
                <b-form-group>
                    <b-form-input
                        type="text"
                        v-model="form.title"
                        placeholder="Наименование">
                    </b-form-input>
                    <small v-if="errors.title" class="form-text text-danger">{{errors.title[0]}}</small>
                </b-form-group>
                <b-button type="submit" class="btn-blue">Отправить</b-button>
            </b-form>
        </b-modal>

        <!-- modal create -->
        <b-modal id="modalCreate" centered hide-footer title="Добавить">
            <b-alert variant="success" dismissible show v-if="success">{{ success }}</b-alert>
            <b-form @submit.prevent="createService" class="mb-3">
                <b-form-group>
                    <b-form-input
                        type="text"
                        v-model="form.title"
                        placeholder="Наименование">
                    </b-form-input>
                    <small v-if="errors.title" class="form-text text-danger">{{errors.title[0]}}</small>
                </b-form-group>
                <b-button type="submit" class="btn-blue">Отправить</b-button>
            </b-form>
        </b-modal>
    </div>
</template>

<script>
export default {
    data: () => ({
        fields: [{
          key: 'title',
          label: 'Наименование',
          formatter: 'fullName'
        },{
            key: 'btn',
            label: 'Управление',
            class: 'text-right'
        }],
        services: [],
        clearForm: {
            id: '',
            title: ''
        },
        form: {
            id: '',
            title: '',
            error: '',
            success: ''
        },
        deleteId: '',
        deleteIndex: '',


        errors: '',
        success: '',
        update: '',
    }),
    created() {
        this.elementsGet();
    },
    methods: {
        details(item,index,event){
            this.form.id = item.id;
            this.form.title = item.title;
        },

        hideModal () {
            this.$root.$emit('bv::hide::modal','modalConfirm')
        },
        
        sendItem(index,id) {
            console.log(index);
            window.axios.get('admin/api/v1/services/' + id)
            .then(response => {
                this.form = response.data;
            })
            .catch(error => {
                this.errors = error.response.data.errors || error.message;
            });
        },

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

        // new create service
        createService(event) {
            window.axios.post('admin/api/v1/services', this.form)
            .then(response => {
                this.elementsGet();
                this.$root.$emit('bv::hide::modal','modalCreate')
            })
            .catch(error => {
                this.errors = error.response.data.errors || error.message;
            });
        },

        updateService() {
            window.axios.put('admin/api/v1/services/' + this.form.id, this.form)
            .then(response => {
                this.success = response.data.success;
                this.elementsGet();
                this.$root.$emit('bv::hide::modal','modalDetail')
            })
            .catch(error => {
                this.errors = error.response.data.errors || error.message;
            });
        },

        // delete
        deleteService(index,id) {
            console.log(id);
            let uri = `admin/api/v1/services/${id}`;
            window.axios.delete(uri).then(response => {
                this.services.splice(this.services.indexOf(index), 1);
                //this.elementsGet();
                //this.hideModal();
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
    .alert--update
        margin-top: 1.25rem
</style>