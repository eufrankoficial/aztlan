<template>
    <div class="ResetPasswordComponent">
        <div class="register-box">
            <div class="card card-outline card-primary">
                <div class="card-header text-center">
                    <a href="javascript:void(0);" class="h1"><b>AZ</b>TLAN</a>
                </div>
                <div class="card-body">
                    <p class="login-box-msg">Informe sua nova senha</p>
                    <form action="#" method="post">
                        <div class="input-group mb-3">
                            <input type="password" class="form-control" placeholder="Nova senha" v-model="password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-key"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control" placeholder="Repita a senha" v-model="password_repeat">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-key"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary btn-block">Definir</button>
                            </div>
                        </div>
                    </form>
                    <a :href="rootPath" class="text-center">Página de login</a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { baseURL } from "../../config/app";

    export default {
        name: 'ResetPasswordComponent',
        data () {
            return {
                password: null,
                password_repeat: null,
                rootPath: baseURL
            }
        }
    };
</script>
