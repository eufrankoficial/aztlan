<template>
        <tr>
            <td>{{ field.field }}</td>
            <td>{{ field.type_id }}</td>
            <td>{{ field.list_name }}</td>
            <td>{{ field.form_name }}</td>
            <td>{{ field.report_name }}</td>
            <td>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" :checked="field.show_on_list == 1" :value="field.show_on_list" v-model="show_on_list" @click="saveShowOnList($event)">
                </div>
            </td>
            <td>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" :checked="field.show_on_form == 1" :value="field.show_on_form" v-model="show_on_form" @click="saveShowOnForm($event)">
                </div>
            <td>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" :checked="field.show_on_report == 1" :value="field.show_on_report" v-model="show_on_report" @click="saveShowOnReport($event)">
                </div>
            </td>
        </tr>
</template>

<script>
    import { request } from "../../request";

    export default {
        name: 'FieldListItemComponent',
        props: ['field', 'url'],

        data() {
            return {
                show_on_list: this.field.show_on_list == 1 ? true : false,
                show_on_form: this.field.show_on_form == 1 ? true : false,
                show_on_report: this.field.show_on_report == 1 ? true : false
            }
        },

        methods: {
            saveShowOnList: function (event) {
                if(this.show_on_list) {
                    this.show_on_list = false;
                } else {
                    this.show_on_list = true;
                }

                const data = {
                    show_on_list: this.show_on_list ? 1 : 0
                };

                this.saveAction(data)
            },

            saveShowOnForm: function (event) {
                if(this.show_on_form) {
                    this.show_on_form = false;
                } else {
                    this.show_on_form = true;
                }

                const data = {
                    show_on_form: this.show_on_form ? 1 : 0
                };

                this.saveAction(data)
            },

            saveShowOnReport: function (event) {
                if(this.show_on_report) {
                    this.show_on_report = false;
                } else {
                    this.show_on_report = true;
                }
                const data = {
                    show_on_report: this.show_on_report ? 1 : 0
                };

                this.saveAction(data)
            },

            saveAction: async function (data) {
                const postAction = this.url + '/' + this.field.id;
                await request.post(postAction, data);
            }


        }
    };
</script>
