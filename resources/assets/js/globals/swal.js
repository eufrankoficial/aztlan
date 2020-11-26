export const confirmation = ((params, callback) => {
    params.context.$swal.fire({
        title: params.question,
        showDenyButton: false,
        showCancelButton: true,
        confirmButtonText: params.confirmButtonText,
        cancelButtonText: params.cancelButtonText
    }).then(async (result)  => {
        if (result.isConfirmed) {
            await callback();
            if(params.reload) {
                location.reload();
            }
        }
    });
});
