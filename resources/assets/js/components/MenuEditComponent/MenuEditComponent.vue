<template>
    <div class="MenuEditComponent">
        <form method="POST" :action="action">
            <div class="card card-primary">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="inputMenu">Menu</label>
                                <input type="text" class="form-control" :class="{ 'is-invalid': $v.menu.$error }" id="inputMenu" v-model="menu">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="inputRoute">Route</label>
                                <input type="text" class="form-control" :class="{ 'is-invalid' : $v.route.$error }" id="inputRoute" v-model="route">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="inputIcon">Icon</label>
                                <input type="text" class="form-control" id="inputIcon" v-model="icon">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label>Filhos</label>
                                <div class="multiselect_div">
                                    <select name="parents[]" class="select2" multiple="multiple" v-model="parentsform">
                                        <option v-for="menu in menustoselect" :value="menu.slug" v-bind:selected="existsInParents(menu)">
                                            {{ menu.menu }}
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary" @click="save($event)">Salvar</button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
import { request } from "../../request";
import { minLength, required } from "vuelidate/lib/validators";

export default {
    name: 'MenuEditComponent',
    props: ['action', 'menuprop', 'menuselect', 'parents'],
    mounted() {
        this.populateFields();
    },

    data() {
        return {
            menu: null,
            route: null,
            parentsform: null,
            icon: null,
            menustoselect: JSON.parse(this.menuselect),
            parentstoselect: JSON.parse(this.parents)
        }
    },
    validations: {
        menu: {
            required,
            minLength: minLength(4)
        },
        route: {
            required
        }
    },

    methods: {

        existsInParents: function (menu) {
            const t = this.parentstoselect.indexOf(menu.id);
            if(t == -1)
                return false

            return true;
        },

        populateFields: function () {
            const menu = JSON.parse(this.menuprop);
            this.menu = menu.menu;
            this.route = menu.route;
            this.icon = menu.icon;
        },

        save: async function (event) {
            event.preventDefault();
            this.$v.$touch()
            if (this.$v.$invalid) {
                this.$swal('Atenção!', 'Preencha os campos corretamente', 'warning');
                return false;
            }

            const response = await request.post(this.action, {
                menu: this.menu,
                route: this.route,
                parents: this.parents,
                icon: this.icon
            });

            if(response.data.status) {
                this.$swal('Sucesso!', 'Menu salvo com sucesso!', 'success');
                window.location.href = response.data.url;
            }
        }
    }
};
</script>
