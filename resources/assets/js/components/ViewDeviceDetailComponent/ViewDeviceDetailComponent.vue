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
                        <h3>{{ device.detail.stamp }}</h3>
                        <p>Ultima Atualização</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box" :class="'bg' + device.detail.status">
                    <div class="inner">
                        <h3>Online</h3>
                        <p>Status</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-primary">
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-sm-3 col-6">
                                <div class="description-block border-right">
                                    <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 17%</span>
                                    <h5 class="description-header">56%</h5>
                                    <span class="description-text">Bateria</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-3 col-6">
                                <div class="description-block border-right">
                                    <span class="description-percentage text-warning"><i class="fas fa-caret-left"></i> 0%</span>
                                    <h5 class="description-header">33%</h5>
                                    <span class="description-text">Umidade</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-3 col-6">
                                <div class="description-block border-right">
                                    <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 20%</span>
                                    <h5 class="description-header">t</h5>
                                    <span class="description-text">CO2</span>
                                </div>
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-3 col-6">
                                <div class="description-block">
                                    <span class="description-percentage text-danger"><i class="fas fa-caret-down"></i> 22º</span>
                                    <h5 class="description-header">t</h5>
                                    <span class="description-text">Temperatura DHT 1</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                        </div>
                        <!-- /.row -->
                    </div>
                </div>
            </div>


            <div class="col-lg-6">
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
