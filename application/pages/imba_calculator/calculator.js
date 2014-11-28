$(document).ready(function() {
	console.log("ative");
	$("input[type='button']").click(function() {
		var value = $(this).val();
		if(value != "=") {
			var new_value = $("input[type='text']").val() + value;
			$("input[type='text']").val(new_value);
		} else {			
			var answer = eval($("input[type='text']").val());
			$("input[type='text']").val(answer);
			console.log("Answer is "+ answer + ".");
		}
	});
	$("#calculator_form").submit(function() {
		var answer = eval($("input[type='text']").val());
		$("input[type='text']").val(answer);
		
		return false;
	});
});