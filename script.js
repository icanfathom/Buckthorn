$(document).ready(function(){
	$('.collapsible').collapsible();
	$('.modal').modal();

	$('.add-student').click(function() {
		$('input.stu-name-textbox').val('');
		$('input.editing-stu').val(-1);
		$('button.submit-action-add').show();
		$('button.submit-action-edit').hide();
		Materialize.updateTextFields();
	});
	$('.edit-student').click(function() {
		var stu_id = $(this).siblings('.hidden-stu-id').val();
		var stu_name = $('#stu_name_' + stu_id).text();
		$('input.stu-name-textbox').val(stu_name);
		$('input.editing-stu').val(stu_id);
		$('button.submit-action-add').hide();
		$('button.submit-action-edit').show();
		Materialize.updateTextFields();
	});
});