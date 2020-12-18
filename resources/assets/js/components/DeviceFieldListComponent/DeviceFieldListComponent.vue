<template>
    <div class="DeviceFieldListComponent">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 mb-3">
                            <form>
                                <input type="text" name="term" class="form-control form-control-lg float-right" placeholder="ID DO DISPOSITIVO" v-model="device" @change="getDeviceFields($event)">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card" v-if="fields.length > 0">

                <div class="card-header">
                    <h3 class="card-title">Campos do dispositivo</h3>
                </div>

                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                        <tr>
                            <th>Campo</th>
                            <th>Tipo</th>
                            <th>Nome na listagem</th>
                            <th>Nome no detalhe</th>
                            <th>Nome no relatório</th>
                            <th>Exibir na listagem</th>
                            <th>Exibir no detalhe</th>
                            <th>Exibir no relatório</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(field, index) in fields">
                                <td>{{ field.field }}</td>
                                <td>{{ field.list_name }}</td>
                                <td>{{ field.form_name }}</td>
                                <td>{{ field.report_name }}</td>
                                <td>
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input custom-control-input-danger" type="checkbox" :checked="field.show_on_list === 1" :value="field.show_on_list">
                                    </div>
                                </td>
                                <td>
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input custom-control-input-danger" type="checkbox" :checked="field.show_on_form === 1" :value="field.show_on_form">
                                    </div>
                                <td>
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input custom-control-input-danger" type="checkbox" :checked="field.show_on_report === 1" :value="field.show_on_report">
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { request } from "../../request";

    export default {
        name: 'DeviceFieldListComponent',
        props: ['getfieldsaction'],
        data() {
            return {
                fields: [],
                device: null
            };
        },

        methods: {

            getDeviceFields: async function (event) {
                const code = this.device;
                const url = this.getfieldsaction;

                const response = await request.get(`${url}/${code}`);
                if(!response.data.status) {
                    this.$swal('Atenção!', 'Não localizamos o dispositivo informado', 'warning');
                    return false;
                }

                this.fields = response.data.device.fields;
            }
        }
    };
</script>
