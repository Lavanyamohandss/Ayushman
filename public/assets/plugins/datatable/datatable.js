$(function (e) {
	$('#example').DataTable({
		"columnDefs": [{
			"targets": 'no-sort',
			"orderable": false,
		}]
	});
});