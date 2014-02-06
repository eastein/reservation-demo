$("#signIn").on("submit", function(event) {
	event.preventDefault();
	var loginData = {
	    password: $(this).find("#signInPass").val() //hunter2
	};
	console.log(loginData);
	$.ajax({
		url : "/api/login",
		type: "POST",
		data: loginData,
		success: function(data, textStatus, jqXHR){
			console.log(data);
			window.location = "/login";
		},
		error: function (jqXHR, textStatus, errorThrown) {
			console.log(textStatus);
			$(this).find('form-group').addClass("has-error has-feedback").append('<span class="glyphicon glyphicon-remove form-control-feedback"></span>');
		}
	});
});
function confirmDelete() {
	var x;
	var r=confirm("Press a button!");
	if (r==true) {
		x="You pressed OK!";
	} else {
		x="You pressed Cancel!";
	}
	document.getElementById("demo").innerHTML=x;
}
$(".form_datetime").datetimepicker({
	format: "MM dd, yyyy - HH:ii P",
	autoclose: true,
	pickerPosition: "bottom-left",
	todayBtn: false,
	showMeridian: true
});