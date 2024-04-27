$(".get_vice").on("click", function (event) {
    let id = event.target.dataset.id;

    $("#modal_delete_vice").modal("show");

    $("#delete_vice_id").val(id);
});

$("#delete_vice").on("click", function () {
    let id = $("#delete_vice_id").val();

    if (!id) {
        return showMessage({
            title: "Ops!",
            message: "Vício não encontrado!",
            type: "error",
        });
    }

    $.ajax({
        url: "../process/admin/vices/delete.php",
        method: "POST",
        dataType: "json",
        data: { id },
        success: function (response) {
            if (response.error) {
                showMessage({ title: "Ops!", message: response.msg, type: "error" });
            } else {
                location.reload();
            }
        },
        error: function (response) {
            console.log(response);
        },
    });
});
