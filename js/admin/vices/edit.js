$(".btn_edit_vice").on("click", function (event) {
    let id = event.target.dataset.id;

    let name = event.target.dataset.name;

    let type_id = event.target.dataset.type_id;

    $("#edit_vice_id").val(id);

    $("#edit_vice_name").val(name);

    $("#edit_vice_type_id").val(type_id);

    $("#modal_edit_vice").modal("show");

});

$("#edit_vice").on("submit", function (event) {
    document.getElementById("button-save-vice").disabled = true;
    document.getElementById("icon-check-vice").style.display = "none";
    document.getElementById("spinner-vice").style.display = "inline-block";

    event.preventDefault();

    let form = $("#edit_vice")[0];

    $.ajax({
        url: "../process/admin/vices/update.php",
        processData: false,
        dataTypeIn: "plain",
        contentType: false,
        method: "POST",
        dataType: "json",
        data: new FormData(form),
        success: function (response) {
            if (response.error) {
                showMessage({ title: "Ops!", message: response.msg, type: "error" });
                document.getElementById("button-save-vice").disabled = false;
                document.getElementById("icon-check-vice").style.display =
                    "inline-block";
                document.getElementById("spinner-vice").style.display = "none";
            } else {
                showMessage({
                    title: "Sucesso!",
                    message: "",
                    type: "success",
                    showConfirmButton: false,
                });
                document.getElementById("button-save-vice").disabled = false;
                document.getElementById("icon-check-vice").style.display = "inline-block";
                document.getElementById("spinner-vice").style.display = "none";
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
                setTimeout(function() {
                    Swal.close();
                }, 1500);
            }
        },
        error: function (response) {
            console.log(response);
        },
    });
});