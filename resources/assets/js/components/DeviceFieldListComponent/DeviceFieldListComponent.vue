<template>
    <div class="DeviceFieldListComponent">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 mb-3">
                            <form>
                                <input
                                    type="text"
                                    name="term"
                                    class="form-control form-control-lg float-right"
                                    placeholder="ID DO DISPOSITIVO"
                                    v-model="device"
                                />
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
                                <th>Exibir no gráfico</th>
                                <th>Cor no gráfico</th>
                            </tr>
                        </thead>
                        <tbody>
                            <field-list-item-component
                                v-for="(field, index) in fields"
                                :key="index"
                                :field="field"
                                :url="currentUrl"
								:types="typesprop"
                            ></field-list-item-component>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { request } from "../../request";
    import FieldListItemComponent from "../FieldListItemComponent/FieldListItemComponent";
    import { lastArgumentUrl, addCodeDeviceToUrl, changeLastUrlStringDeviceCode } from "../../helpers";

    export default {
        name: 'DeviceFieldListComponent',
        props: ['getfieldsaction', 'typesprop'],
        components: {
            FieldListItemComponent
        },

        mounted() {
            if(lastArgumentUrl !== 'fields') {
                this.device = lastArgumentUrl;
                this.getDeviceFields(null, 'url');
            }
        },

        data() {
            return {
                fields: [],
                device: null,
                currentUrl: null,
            };
        },

        methods: {
            getDeviceFields: async function (event, type = 'change') {
                if(lastArgumentUrl == 'fields') {
                    this.currentUrl = addCodeDeviceToUrl(this.device);
                } else {
                    this.currentUrl = changeLastUrlStringDeviceCode(lastArgumentUrl, this.device);
                }

                const code = this.device;
                const url = this.getfieldsaction;

                const response = await request.get(`${url}/${code}`);
                if(!response.data.status) {
                    this.$swal('Atenção!', 'Não localizamos o dispositivo informado', 'warning');
                    return false;
                }

                this.fields = response.data.device.fields;
            },

            changeUrl: function () {

            }
        }
    };
</script>
