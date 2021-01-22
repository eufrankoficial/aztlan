<template>
    <div class="ViewDeviceDetailComponent">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h4 class="font-weight-bold">{{ device.code_device }}</h4>
                        <p>Dispositivo</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6">
                <!-- small box -->
                <div class="small-box" :class="'bg-' + statusmodel.class">
                    <div class="inner">
                        <h4 class="font-weight-bold">{{ device.updated_at }}</h4>
                        <p>{{ statusmodel.name }}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6">
                <!-- small box -->
                <div class="small-box">
                    <div class="inner">
                        <h4 class="font-weight-bold">Relatório</h4>
                        <a href="#">
                            <p><i class="fa fa-file-export"></i>Gerar</p>
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
                            <div
                                class="col-sm-12 col-12"
                                v-for="field in device.fields"
                            >
                                <div
                                    class="description-block"
                                    v-show="field.show_on_form === 1"
                                >
                                    <span
                                        class="description-percentage text-success"
                                    ></span>
                                    <h5 class="description-header">
                                        {{ field.formatted_value }}
                                    </h5>
                                    <span class="description-text">{{
                                        field.list_name
                                    }}</span>
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
        props: ['devicejson', 'status'],

        mounted() {
            this.getFields();
        },

        data () {
            return {
				device: JSON.parse(this.devicejson),
				statusmodel: JSON.parse(this.status)
            }
        },

        methods: {
            getFields: function () {
                this.device.fields.map((field) => {

                });
            }
        }
    };
</script>
