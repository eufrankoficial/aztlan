<template>
    <div class="ViewDeviceDetailComponent">
        <div class="row">
            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ device.code_device }}</h3>
                        <p>Dispositivo</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ device.updated_at }}</h3>
                        <p>Ultima Atualização</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>Online</h3>
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
                            <div class="col-sm-12 col-12" v-for="field in device.fields">
                                <div class="description-block" v-show="field.show_on_form === 1">
                                    <span class="description-percentage text-success"></span>
                                    <h5 class="description-header">{{ field.value.value }}</h5>
                                    <span class="description-text">{{ field.list_name }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>

<script>

    export default {
        name: 'ViewDeviceDetailComponent',
        props: ['devicejson'],

        mounted() {
            this.getFields();
        },

        data () {
            return {
                device: JSON.parse(this.devicejson)
            }
        },

        methods: {
            getFields: function () {
                this.device.fields.map((field) => {
                    console.log(field.value.value);
                });
            }
        }
    };
</script>
