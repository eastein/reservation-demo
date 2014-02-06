$("#signIn").on("submit", function(event) {
	event.preventDefault();
	var $this = $(this);
	var loginData = {
	    password: $this.find("#signInPass").val() //hunter2
	};
	console.log(loginData);
	$.ajax({
		url : "/api/login",
		type: "POST",
		data: loginData,
		success: function(data, textStatus, jqXHR){
			console.log(data);
			if(!data["error"]){
				window.location = "/admin";
			} else {
				console.log('error');
				$this.find('form-group').addClass("has-error has-feedback").append('<span class="glyphicon glyphicon-remove form-control-feedback"></span>');
			}
		},
		error: function (jqXHR, textStatus, errorThrown) {
			console.log(textStatus);
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