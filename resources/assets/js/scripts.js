$(function () {
    $('.select2').select2();

    $("input[data-bootstrap-switch]").each(function(){
        $(this).bootstrapSwitch('state', $(this).prop('checked'));
    });

	$('#reservationtime').daterangepicker({
		timePicker: false,
		timePickerIncrement: 30,
		locale: {
			format: 'DD/MM/YYYY'
		}
	})
});
