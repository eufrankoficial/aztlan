<template>
    <a href="javascript:void(0)" class="btn btn-danger" data-type="confirm" @click="deleteRecord($event)">
        <i class="fa fa-trash text-white"></i>
        Excluir
    </a>
</template>

<script>

import { request } from '../../request';

export default {
    name: 'DeleteButtonComponent',
    props: ['url'],

    data() {
        return {};
    },


    methods: {

        deleteAction: async function() {
            await request.get(this.url);
        },


        deleteRecord: function (event) {
            this.$swal.fire({
                title: 'Tem certeza?',
                text: 'Essa ação não poderá ser desfeita.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Excluir!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.value) {
                    this.deleteAction();
                    this.$swal.fire(
                        'Excluído!',
                        'Excluído com sucesso',
                        'success'
                    );
                    event.target.parentElement.parentElement.remove();
                    return true;

                } else {
                    this.$swal.fire(
                        'Cancelado',
                        'Seu registro está a salvo',
                        'error'
                    );
                    return false;
                }
            })
        }
    }
};
</script>

