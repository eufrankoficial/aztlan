<template>
    <div class="CreatedeviceFormcomponent">
        <form method="POST" :action="action">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="codeDevice">Código</label>
                            <input type="text" class="form-control" :class="{ 'is-invalid': $v.device.code_device.$error }" id="codeDevice" v-model="device.code_device" @input="setCodeDevice($event.target.value)">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Veículo</label>
                            <select class="form-control select2" v-model="device.vehicle_id" style="width: 100%;" :class="{ 'is-invalid': $v.device.vehicle_id.$error }" @select="setVehicleId($event.target.value)">
                                <option>Selecione</option>
                                <option v-for="(vehicle, index) in vehiclesList" :value="index">{{ vehicle }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="observacao">Observação</label>
                            <input type="text" class="form-control" id="observacao" v-model="device.description">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <p>Detalhes (<code>Não obrigatório</code>)</p>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="description">Descrição</label>
                            <input type="text" class="form-control" id="description" v-model="detail.description">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="lat">Latitude</label>
                            <input type="text" class="form-control" id="lat" v-model="detail.lat" :class="{ 'is-invalid': $v.detail.lat.$error }" @input="setLat($event.target.value)">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="long">Longitude</label>
                            <input type="text" class="form-control" id="long" v-model="detail.long" :class="{ 'is-invalid': $v.detail.long.$error }" @input="setLong($event.target.value)">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="bat">Bateria</label>
                            <input type="text" class="form-control" id="bat" v-model="detail.bat">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="temperatura">Temperatura</label>
                            <input type="text" class="form-control" id="temperatura" v-model="detail.temp">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="umi">Umidade</label>
                            <input type="text" class="form-control" id="umi" v-model="detail.umi">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="co2">CO2</label>
                            <input type="text" class="form-control" id="co2" v-model="detail.co2">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" @click="submit($event)" class="btn btn-primary">Salvar</button>
            </div>
        </form>
    </div>
</template>

<script>
    import { required, minLength } from 'vuelidate/lib/validators';
    import { request } from "../../request";

    export default {
        name: 'CreatedeviceFormcomponent',
        props: ['action', 'vehicles'],

        data() {
            return {
                device: {
                    code_device: null,
                    vehicle_id: null,
                    description: null
                },
                detail: {
                    description: null,
                    lat: null,
                    long: null,
                    bat: null,
                    temp: null,
                    umi: null,
                    co2: null
                },
                vehiclesList: JSON.parse(this.vehicles)
            };
        },
        validations: {
            device: {
                code_device: {
                    required,
                    minLength: minLength(4)
                },
                vehicle_id: {
                    required
                }
            },
            detail: {
                lat: {
                    required
                },
                long: {
                    required
                }
            }
        },
        methods: {

            submit : async function (event) {
                event.preventDefault();
                this.$v.$touch()
                if (this.$v.$invalid) {
                    this.$swal('Atenção!', 'Preencha os campos corretamente', 'warning');
                    return false;
                }

                const data = {
                    device: this.device,
                    detail: this.detail
                };

                const response = await request.post(this.action, data);
                if(!response.data.status) {
                    this.$swal('Atenção!', 'Não foi possível salvar dispositivo', 'warning');
                    return false;
                } else {
                    this.$swal('Sucesso!', 'Salvo com sucesso', 'success');
                    window.location.href = response.data.url;
                }
            },

            setCodeDevice(value) {
                this.device.code_device = value;
                this.$v.device.code_device.$touch();
            },

            setVehicleId(value) {
                this.device.vehicle_id = value;
                this.$v.device.vehicle_id.$touch();
            },

            setLat(value) {
                this.detail.lat = value;
                this.$v.detail.lat.$touch();
            },

            setLong(value) {
                this.detail.long = value;
                this.$v.detail.long.$touch();
            },
        }
    };
</script>
