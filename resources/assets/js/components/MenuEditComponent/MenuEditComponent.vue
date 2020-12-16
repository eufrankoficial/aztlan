<template>
    <div class="MenuEditComponentupdate">

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
            parentsform: [],
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

        addOnParents: function () {
            const el = document.getElementById('parents');
            this.parentsform = this.getSelectValues(el);
        },

        getSelectValues: function (select) {
            const result = [];
            const options = select && select.options;
            let opt;

            for (var i=0, iLen=options.length; i<iLen; i++) {
                opt = options[i];
                if (opt.selected) {
                    result.push(opt.value || opt.text);
                }
            }

            return result;
        },

        existsInParents: function (menu) {

            if(this.parentstoselect.indexOf(menu.slug) == -1) {
                return false;
            }

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
            this.addOnParents();

            this.$v.$touch()
            if (this.$v.$invalid) {
                this.$swal('Atenção!', 'Preencha os campos corretamente', 'warning');
                return false;
            }

            const response = await request.post(this.action, {
                menu: this.menu,
                route: this.route,
                parents: this.parentsform,
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
