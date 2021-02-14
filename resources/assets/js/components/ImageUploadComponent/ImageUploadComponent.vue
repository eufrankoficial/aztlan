<template>
    <div class="ImageUploadComponent">
		<div class="row">
			<div class="form-group">
				<label for="exampleInputFile">Logo da empresa</label>
				<div class="input-group">
					<div class="custom-file">
						<input type="file" name="file" class="custom-file-input" id="exampleInputFile" ref="file">
						<label class="custom-file-label" for="exampleInputFile">Escolha um arquivo</label>
					</div>
					<div class="input-group-append">
						<span class="input-group-text cursor-pointer" @click="upload($event)">{{ textUpload }}</span>
					</div>
				</div>
			</div>
		</div>
    </div>
</template>

<script>
    import { request } from "../../request";

    export default {
        name: 'ImageUploadComponent',
		props: ['action', 'company'],

		mounted() {
			this.companymodel = JSON.parse(this.$props.company);
		},

		data() {
			return {
				image: null,
				companymodel: null,
				textUpload: 'Upload'
			};
		},

		methods: {
			upload: async function (event) {
				this.textUpload = 'Aguarde...';
				let formData = new FormData();
				for (let file of this.$refs.file.files) {
       				formData.append('file', file);
				}

				formData.append('company_id', this.companymodel.id);
				const component = this;
				const response = await request.post(this.action, formData).then(function(success) {
					component.$swal('Sucesso!', 'Imagem salva com sucesso', 'success');
				}).catch(function(err){
					component.$swal('Atenção!', 'Apenas imagem jpg, jpeg e png são permitidas', 'warning');
				});

				this.textUpload = 'Upload';


			}
		}
    };
</script>
