// category
$(document).ready(function() {
	$("#menu-toggle").click(function(e) {
		e.preventDefault();
		$("#wrapper").toggleClass("toggled");
		$('menu-toggle').classList.toggle("change");
	});


	
	
	if($('#snackbar').length){
		// snackbar
		var x = document.getElementById("snackbar");
		x.className = "show";
		setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
	}


	$('.name-category').keyup(function (e) { 
		var urledit = $('#url-edit').val()+'/1';
		
		console.log($(this).val());
		$.ajax({
			type: "put",
			url: urledit,
			data: {
				"_token": $("#csrftoken").val(),
				name: $(this).parent().find('name-category').val()
			},
			dataType: "json",
			success: function (response) {
				console.log('oke');
			}
		});
	});

	CKEDITOR.replace('description', {
		filebrowserBrowseUrl: 'ckeditor/ckfinder/ckfinder.html',
		filebrowserImageBrowseUrl: 'ckfinder/ckfinder.html?Type=Images'
	});

});
// icon menu
function handleIconMenu(x) {
	x.classList.toggle("change");
}



