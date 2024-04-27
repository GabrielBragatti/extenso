$(function(){
    $(".btn-carregar").on("click", function(){
        $.ajax({
            url: "../process/admin/vices/load.php",
            dataType: "html",
            success: function(result){
                $(".table-vices").html(result);
            },
            error: function() {
                $(".table-vices").html("Erro");
            }
        });
    });
});