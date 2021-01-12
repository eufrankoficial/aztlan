<template>
    <div class="UserEditComponent">
        <form method="POST" :action="action">
            <div class="card card-primary">
                <div class="card-body">
                    <div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="group">Grupo do usuário</label>
								<select class="form-control" id="group" v-model="groupmodel">
									<option>Selecione</option>
									<option
										v-for="(group, index) in groupsmodel"
										:key="index"
										:value="group.slug"
										>{{ group.name }}</option>
								</select>
							</div>
						</div>
						<div class="col-md-6" v-if="issuperadmin == '1'">
							<div class="form-group">
								<label for="company">Empresas</label>
								<select class="form-control" id="company" v-model="companymodel">
									<option>Selecione</option>
									<option
										v-for="(company, index) in companies"
										:key="index"
										:value="company.id">
										{{ company.company_name }}
										</option>
								</select>
							</div>
						</div>
					</div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="inputName">Nome</label>
                                <input type="text" :class="!errorName ? 'form-control' : 'form-control is-invalid'" id="inputName" v-model="name">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" :class="!errorEmail ? 'form-control' : 'form-control is-invalid'" id="email" v-model="email" @change="isValidEmail($event)">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="username">Nome de usuário</label>
                                <input type="text" :class="!errorUsername ? 'form-control' : 'form-control is-invalid'" id="username" v-model="username" @change="validateUserName($event)">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h5 class="mb-2">Criar senha</h5>
                        </div>

                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="password">Senha</label>
                                <input type="password" class="form-control" id="password" v-model="password">
                            </div>
                        </div>

                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="repeatPassword">Senha</label>
                                <input type="password" :class="errorPassword ? 'form-control is-invalid' : 'form-control'" id="repeatPassword" v-model="repeat_password" @change="validatePassword($event)">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <button :disabled="disabledButton" type="submit" class="btn btn-primary" @click="save($event)">Salvar</button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
import { request } from "../../request";
import { validateEmail, validateFieldString } from "../../validator";

export default {
    name: 'UserEditComponent',
    props: ['action', 'user', 'groupsprop', 'issuperadmin', 'companiesprop'],
    mounted() {
		this.companies = JSON.parse(this.companiesprop);
		this.groupsmodel = JSON.parse(this.groupsprop);
		console.log(JSON.parse(this.user));
        this.populateFields();
    },

    data() {
        return {
            name: null,
            email: null,
            username: null,
            password: null,
            repeat_password: null,
            disabledButton: false,
            errorPassword: false,
            errorEmail: false,
            errorUsername: false,
			errorName: false,
			groupsmodel: null,
			companies: [],
			groupmodel: null,
			companymodel: null
        }
    },

    methods: {

        populateFields: function () {
            const user = JSON.parse(this.user);
            this.name = user.name;
            this.email = user.email;
			this.username = user.username;
			this.companymodel = user.company_id;
			if(user.roles.length > 0) {
				this.groupmodel = user.roles[0].slug;
			}
        },

        save: async function (event) {
            event.preventDefault();
            const valid = this.validateForm();
            if(valid) {
                const response = await request.post(this.action, {
                    name: this.name,
                    email: this.email,
                    username: this.username,
					password: this.password,
					company_id: this.companymodel,
					role_id: this.groupmodel
                });

                if(response.data.status) {
                    this.$swal('Sucesso!', 'Usuário salvo com sucesso!', 'success');
                    window.location.href = response.data.url;
                }
            }
        },

        isValidEmail: async function (event) {
            const valid = validateEmail(this.email);
            if(!valid) {
                this.errorEmail = true;
                this.$swal('Atenção!', 'Digite um email válido', 'warning');
                this.email = '';
                return false;
            }

            const response = await request.post('exist', {
                email: this.email
            });

            if(response.data.exist) {
                this.$swal('Atenção!', 'Email já está em uso', 'warning');
                this.email = '';
                this.errorEmail = true;
                return false;
            }

            this.errorEmail = false;
            return true;
        },

        validatePassword: function (event) {
            const password = this.password;
            const repeatPassword = this.repeat_password;
            if(validateFieldString(password).hasError || validateFieldString(repeatPassword).hasError) {
                this.$swal('Atenção!', 'Informe sua senha corretamente', 'warning');
                return false;
            }

            if( repeatPassword.trim() !== password.trim() ) {
                this.errorPassword = true;
                this.$swal('Atenção!', 'Senha não correspondem', 'warning');
                return false;
            }

            this.errorPassword = false;
            this.disabledButton = false;
            return true;
        },

        validateUserName: async function (event) {
            const response = await request.post('/users/exist', {
                username: this.username
            });

            if(response.data.exist) {
                this.$swal('Atenção!', 'Nome de usuário já está em uso', 'warning');
                this.disabledButton = true;
                this.errorUsername = true;
                this.username = '';
                return false;
            } else {
                this.errorUsername = false;
                this.disabledButton = false;
            }

            return true;
        },

        validateForm: function (validatePass) {
            this.errorName = validateFieldString(this.name).hasError;
			let validPass = true;
			const group = this.groupmodel;
			const company = this.companymodel;
			if(this.$props.issuperadmin === "1") {
				if(company == null) {
					this.$swal('Atenção!', 'Informe a empresa', 'warning');
					return false;
				}
			}

            if(validatePass) {
                validPass = this.validatePassword();
            }

            const validUsername = this.validateUserName();

            if(!validPass || !validUsername || this.errorName || group == null) {
                this.$swal('Atenção!', 'Preencha o formulário corretamente', 'warning');
                return false;
            }

            return true;
        }
    }
};
</script>
