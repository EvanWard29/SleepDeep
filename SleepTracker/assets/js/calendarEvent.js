$(document).ready(function() {

    $('li').click(function() {
        var id = $(this).attr('id');
        $("#date").val(id);

    });
});