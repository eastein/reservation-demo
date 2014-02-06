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
				console.log($this);
				$this.find('.form-group').addClass("has-error has-feedback").append('<span class="glyphicon glyphicon-remove form-control-feedback"></span>');
			}
		},
		error: function (jqXHR, textStatus, errorThrown) {
			console.log(textStatus);
		}
	});
});
$("#signOut").on("click", function(event) {
	event.preventDefault();
	del_cookie("password");
	console.log('deleted cookie!');
	window.location = "/admin";
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
function del_cookie(name){
    document.cookie = name + '=; expires=Thu, 01 Jan 1970 00:00:01 GMT;';
}
$(".form_datetime").datetimepicker({
	format: "MM dd, yyyy - HH:ii P",
	autoclose: true,
	pickerPosition: "bottom-left",
	todayBtn: false,
	showMeridian: true
});