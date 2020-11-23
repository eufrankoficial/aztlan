<template>
    <div class="ForgotPasswordComponent">
        <div class="register-box">
            <div class="card card-outline card-primary">
                <div class="card-header text-center">
                    <a href="javascript:void(0);" class="h1"><b>AZ</b>TLAN</a>
                </div>
                <div class="card-body">
                    <p class="login-box-msg">Recuperar senha</p>

                    <form action="#" method="post">
                        <div class="input-group mb-3">
                            <input type="email" class="form-control" placeholder="Email" v-model="email">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary btn-block">Recuperar</button>
                            </div>
                        </div>
                    </form>
                    <a :href="rootPath" class="text-center">Lembrei minha senha</a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { baseURL } from "../../config/app";

    export default {
        name: 'ForgotPasswordComponent',
        data() {
            return {
                email: null,
                rootPath: baseURL
            }
        }
    };
</script>
