<template>
    <div class="LoginComponent">
        <div class="login-box">
            <!-- /.login-logo -->
            <div class="card card-outline card-primary">
                <div class="card-header text-center">
                    <a href="javascript:void(0);" class="h1"><b>Globo</b>Biotech</a>
                </div>
                <div class="card-body">
                    <p class="login-box-msg">Iniciar sessão</p>
                    <form method="post">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Nome de usuário" v-model="username">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control" placeholder="Senha" v-model="password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-8">
                                <div class="icheck-primary">
                                    <input type="checkbox" id="remember" v-model="remember" @click="toggleRememberToken">
                                    <label for="remember">
                                        Lembrar minha senha
                                    </label>
                                </div>
                            </div>
                            <!-- /.col -->
                            <div class="col-4">
                                <button class="btn btn-primary btn-block" @click="submitLogin($event)">Entrar</button>
                            </div>
                        </div>
                    </form>

                    <p class="mb-1">
                        <a href="revover-password">Esqueci a senha</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { request } from "../../request";

    export default {
        name: 'LoginComponent',
        data () {
            return {
                username: null,
                password: null,
                remember: false
            }
        },

        methods: {
            toggleRememberToken: function () {
                this.remember = !this.remember ? true : false;
            },

            submitLogin: async function (event) {
                event.preventDefault();
                const credentials = {
                    username: this.username,
                    password: this.password
                };

                const response = await request.post('authenticate', credentials);

                if(response.data.status === true) {
                    location.reload();
                    return true;
                }

                this.$swal('Atenção!', 'Crendenciais inválidas', 'error');
                return false;
            }
        }
    };
</script>
