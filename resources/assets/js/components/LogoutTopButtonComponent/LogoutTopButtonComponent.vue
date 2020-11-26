<template>
    <div class="LogoutTopButtonComponent">
        <li class="nav-item">
            <a class="nav-link" :href="url" role="button" @click="logout($event)">
                <i class="fas fa-sign-out-alt" alt="Sair do sistema"></i>
            </a>
        </li>
    </div>
</template>

<script>
    import { request } from "../../request";
    import { confirmation } from "../../globals/swal";

    export default {
        props: ['url'],
        name: 'LogoutTopButtonComponent',

        methods: {

            doLogout: async function () {
                await request.get(this.url);
            },

            logout: function (event) {
                event.preventDefault();

                const params = {
                    callback: 'doLogout',
                    question: 'Deseja sair do sistema',
                    confirmButtonText: 'Sim',
                    cancelButtonText: 'Cancelar',
                    reload: true,
                    context: this
                };

                confirmation(params, this.doLogout);
            },

        }
    };
</script>
