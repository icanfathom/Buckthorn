$(document).ready(function(){
	$('.collapsible').collapsible();
	$('.modal').modal();

	// $('.student-list .delete').click(function() {
	// 	var linkedStudent = $('[name="' + $(this).attr('name').replace('delete', 'student') + '"]');
	// 	var linkedStudent = $('[name="' + $(this).attr('name').replace('delete', 'student') + '"]');
	// 	if (linkedStudent.prop('disabled'))
	// 	{
	// 		linkedStudent.prop('disabled', false);
	// 		$(this).text('delete');
	// 	}
	// 	else
	// 	{
	// 		linkedStudent.prop('disabled', true);
	// 		$(this).text('add_box');
	// 	}
	// });
});