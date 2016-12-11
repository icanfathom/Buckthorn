$(document).ready(function(){
	$('.collapsible').collapsible();
	$('.modal').modal();

	$('.datepicker').pickadate();

	$('.edit-team').click(function() {
		var team_id = $(this).siblings('.hidden-team-id').val();
		var team_name = $(this).siblings('.hidden-team-name').val();
		$('input.team-name-textbox').val(team_name);
		$('input.editing-team-id').val(team_id);
		Materialize.updateTextFields();
	});
	$('.add-student').click(function() {
		$('input.stu-name.textbox').val('');
		$('input.editing-stu-id').val(-1);
		$('button.submit-action-add').show();
		$('button.submit-action-edit').hide();
		Materialize.updateTextFields();
	});
	$('.edit-student').click(function() {
		var stu_id = $(this).siblings('.hidden-stu-id').val();
		var stu_name = $(this).siblings('.hidden-stu-name').val();
		$('input.stu-name-textbox').val(stu_name);
		$('input.editing-stu-id').val(stu_id);
		$('button.submit-action-add').hide();
		$('button.submit-action-edit').show();
		Materialize.updateTextFields();
	});

	$('.show-obs-notes').click(function() {
		var notesID = $(this).attr('id');
		notesID = notesID.replace("btn", "card");
		$('#' + notesID).slideToggle(400);
	});
});