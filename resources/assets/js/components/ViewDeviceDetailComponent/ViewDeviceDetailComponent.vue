<template>
    <div class="ViewDeviceDetailComponent">
        <div class="row">
            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ device.detail.temp }}º</h3>
                        <p>Temperatura</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ device.stamp_view }}</h3>
                        <p>Ultima Atualização</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box" :class="'bg-' + device.status">
                    <div class="inner" v-if="device.status == 'success'">
                        <h3>Online</h3>
                        <p>Status</p>
                    </div>
                    <div class="inner" v-if="device.status == 'warning'">
                        <h3>Aguardando...</h3>
                        <p>Atualizado a menos de um dia</p>
                    </div>
                    <div class="inner" v-if="device.status == 'danger'">
                        <h3>Offline</h3>
                        <p>Status</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box">
                    <div class="inner">
                        <h3>Relatório</h3>
                        <a href="#">
                            <p> <i class="fa fa-file-export"></i>Gerar</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-sm-12">
                <div class="card card-primary">
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-sm-12 col-12">
                                <div class="description-block">
                                    <span class="description-percentage text-success"></span>
                                    <h5 class="description-header">{{ device.detail.bat }} Volts</h5>
                                    <span class="description-text">Bateria</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-12 col-md-12">
                                <div class="description-block">
                                    <span class="description-percentage text-warning"></i></span>
                                    <h5 class="description-header">{{ device.detail.umi }} %</h5>
                                    <span class="description-text">Umidade</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <div class="col-sm-12 col-md-12">
                                <div class="description-block">
                                    <span class="description-percentage text-warning"></span>
                                    <h5 class="description-header">{{ device.detail.umi }} %</h5>
                                    <span class="description-text">Umidade</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-12 col-12">
                                <div class="description-block">
                                    <span class="description-percentage text-success"></span>
                                    <h5 class="description-header">{{ device.detail.co2 }} ppm</h5>
                                    <span class="description-text">CO2</span>
                                </div>
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-12 col-12">
                                <div class="description-block">
                                    <span class="description-percentage text-success"></span>
                                    <h5 class="description-header">{{ device.detail.tempdht1 }}º</h5>
                                    <span class="description-text">Temperatura DHT 1</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <div class="col-sm-12 col-12">
                                <div class="description-block">
                                    <span class="description-percentage text-success"></span>
                                    <h5 class="description-header">{{ device.detail.tempdht2 }}º</h5>
                                    <span class="description-text">Temperatura DHT 2</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                        </div>
                        <!-- /.row -->
                    </div>
                </div>
            </div>


            <div class="col-lg-6 col-sm-12">
                <map-component mapname="device-detail" :options="device.detail"></map-component>
            </div>
        </div>
    </div>
</template>

<script>

    export default {
        name: 'ViewDeviceDetailComponent',
        props: ['devicejson'],

        data () {
            return {
                device: JSON.parse(this.devicejson)
            }
        }
    };
</script>
