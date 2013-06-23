$(function() {
  $("#file").on('change', function() {
    $("#form").submit();
	});
$("#fakefile").on('click', function(){
  $("#file").trigger("click")
    }
)

});

