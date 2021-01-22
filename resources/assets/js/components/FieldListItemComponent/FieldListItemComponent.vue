<template>
    <tr>
        <td>{{ field.field }}</td>
        <td @click="editField(field.field, 'type_id')">
			<select
				class="form-control form-control-sm"
				@change="saveFieldType($event)"
				v-model="type"
				v-if="showField && currentField == field.field && editingField == 'type_id'">
				<option value="">Selecione</option>
				<option
					v-for="(type, index) in typesmodel"
					:key="index"
					:value="type.id"
					:selected="type.id == field.type_id"
				>
					{{ type.type }}
				</option>
			</select>
			<span v-else>{{ field.type_id != null ?
				typeNames[field.type_id][0]
				: 'Sem tipagem' }}</span>
        </td>
        <td
            @click="editField(field.field, 'list_name')"
            @change="saveListName($event)"
        >
            <div
                class="col-md-12"
                v-if="
                    showField &&
                    currentField == field.field &&
                    editingField == 'list_name'
                "
            >
                <input
                    type="text"
                    class="form-control form-control-sm"
                    v-model="list_name"
                />
            </div>
            <span v-else>{{ field.list_name }}</span>
        </td>
        <td
            @click="editField(field.field, 'form_name')"
            @change="saveFormName($event)"
        >
            <div
                class="col-md-12"
                v-if="
                    showField &&
                    currentField == field.field &&
                    editingField == 'form_name'
                "
            >
                <input
                    type="text"
                    class="form-control form-control-sm"
                    v-model="form_name"
                />
            </div>
            <span v-else>{{ field.form_name }}</span>
        </td>
        <td
            @click="editField(field.field, 'report_name')"
            @change="saveReportName($event)"
        >
            <div
                class="col-md-12"
                v-if="
                    showField &&
                    currentField == field.field &&
                    editingField == 'report_name'
                "
            >
                <input
                    type="text"
                    class="form-control form-control-sm"
                    v-model="report_name"
                />
            </div>
            <span v-else>{{ field.report_name }}</span>
        </td>
        <td>
            <div class="custom-control custom-checkbox">
                <input
                    type="checkbox"
                    :checked="field.show_on_list == 1"
                    :value="field.show_on_list"
                    v-model="show_on_list"
                    @click="saveShowOnList($event)"
                />
            </div>
        </td>
        <td>
            <div class="custom-control custom-checkbox">
                <input
                    type="checkbox"
                    :checked="field.show_on_form == 1"
                    :value="field.show_on_form"
                    v-model="show_on_form"
                    @click="saveShowOnForm($event)"
                />
            </div>
        </td>

        <td>
            <div class="custom-control custom-checkbox">
                <input
                    type="checkbox"
                    :checked="field.show_on_report == 1"
                    :value="field.show_on_report"
                    v-model="show_on_report"
                    @click="saveShowOnReport($event)"
                />
            </div>
        </td>
        <td>
            <div class="custom-control custom-checkbox">
                <input
                    type="checkbox"
                    :checked="field.show_on_chart == 1"
                    :value="field.show_on_chart"
                    v-model="show_on_chart"
                    @click="saveShowOnChart($event)"
                />
            </div>
        </td>
        <td
            @click="editField(field.field, 'color_on_chart')"
            @change="saveColorOnChart($event)"
        >
            <div
                class="col-md-12"
                v-if="
                    showField &&
                    currentField == field.field &&
                    editingField == 'color_on_chart'
                "
            >
                <v-input-colorpicker v-model="color_on_chart" />
            </div>
            <span :style="{ background: field.color_on_chart }" v-else>{{
                field.color_on_chart
            }}</span>
        </td>
    </tr>
</template>

<script>
	import InputColorPicker from 'vue-native-color-picker';
    import { request } from "../../request";

    export default {
        name: 'FieldListItemComponent',
		props: ['field', 'url', 'types'],
		components: {
			"v-input-colorpicker": InputColorPicker
		},

		mounted() {
        	this.typesmodel = JSON.parse(this.types);
        	this.getTypesName();
		},

		data() {
            return {
                showField: false,
                currentField: false,
				type: this.field.type_id,
                list_name: this.field.list_name,
                form_name: this.field.form_name,
                report_name: this.field.report_name,
                editingField: null,
                show_on_list: this.field.show_on_list == 1 ? true : false,
                show_on_form: this.field.show_on_form == 1 ? true : false,
				show_on_report: this.field.show_on_report == 1 ? true : false,
				show_on_chart: this.field.show_on_chart == 1 ? true : false,
				color_on_chart: this.field.color_on_chart,
				typesmodel: null,
				typeNames: null
            }
        },

        methods: {
        	getTypesName: function() {
        		let typeNames = [];
        		this.typesmodel.map(function(type) {
					typeNames[type.id] = [];
					typeNames[type.id].push(type.type);
				})

				this.typeNames = typeNames;
			},

			saveFieldType: function(event) {
				this.saveAction({
					type_id: this.type
				});
				this.field.type_id = this.type;
				this.resetShowConfigVars();
			},

            saveListName: function(event) {
                this.saveAction({
                    list_name: this.list_name
                });

                this.field.list_name = this.list_name;
                this.resetShowConfigVars();
            },

            saveFormName: function(event) {
                this.saveAction({
                    form_name: this.form_name
                });

                this.field.form_name = this.form_name;
                this.resetShowConfigVars();
            },

            saveReportName: function(event) {
                this.saveAction({
                    report_name: this.report_name
                });

                this.field.report_name = this.report_name;
                this.resetShowConfigVars();
			},

			saveColorOnChart: function(event) {
				this.saveAction({
                    color_on_chart: this.color_on_chart
                });

                this.field.color_on_chart = this.color_on_chart;
                this.resetShowConfigVars();
			},

            editField: function (field, param) {
                this.currentField = field;
                this.showField = true;
                this.editingField = param;
            },

            resetShowConfigVars: function () {
                this.currentField = null;
                this.showField = false;
                this.editingField = null;
            },

            saveShowOnList: function (event) {
                if(this.show_on_list) {
                    this.show_on_list = false;
                } else {
                    this.show_on_list = true;
                }

                this.saveAction({
                    show_on_list: this.show_on_list ? 1 : 0
                })
            },

            saveShowOnForm: function (event) {
                if(this.show_on_form) {
                    this.show_on_form = false;
                } else {
                    this.show_on_form = true;
                }

                this.saveAction({
                    show_on_form: this.show_on_form ? 1 : 0
                })
            },

            saveShowOnReport: function (event) {
                if(this.show_on_report) {
                    this.show_on_report = false;
                } else {
                    this.show_on_report = true;
                }

                this.saveAction({
                    show_on_report: this.show_on_report ? 1 : 0
                })
			},

			saveShowOnChart: function (event) {
				if(this.show_on_chart) {
                    this.show_on_chart = false;
                } else {
                    this.show_on_chart = true;
				}

				this.saveAction({
					show_on_chart: this.show_on_chart ? 1 : 0
				});
			},

            saveAction: async function (data) {
                const postAction = this.url + '/' + this.field.id;
                await request.post(postAction, data);
            }


        }
    };
</script>
