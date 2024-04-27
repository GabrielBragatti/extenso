$(".btn_edit_client").on("click", function (event) {
    let id = event.target.dataset.id;

    let name = event.target.dataset.name;

    let email = event.target.dataset.email;

    let clean = event.target.dataset.clean;

    let vice_id = event.target.dataset.vice_id;

    $("#edit_client_id").val(id);

    $("#edit_client_name").val(name);

    $("#edit_client_email").val(email);

    $("#edit_client_clean").val(clean);

    $("#edit_client_vice_id").val(vice_id);

    $("#modal_edit_client").modal("show");

});

$("#edit_client").on("submit", function (event) {
    document.getElementById("button-save-client").disabled = true;
    document.getElementById("icon-check-client").style.display = "none";
    document.getElementById("spinner-client").style.display = "inline-block";
    
    event.preventDefault();
    
    let form = $("#edit_client")[0];
    
    $.ajax({
        url: "../process/admin/client/update.php",
        processData: false,
        dataTypeIn: "plain",
        contentType: false,
        method: "POST",
        dataType: "json",
        data: new FormData(form),
        success: function (response) {
            if (response.error) {
                showMessage({ title: "Ops!", message: response.msg, type: "error" });
                document.getElementById("button-save-client").disabled = false;
                document.getElementById("icon-check-client").style.display =
                    "inline-block";
                document.getElementById("spinner-client").style.display = "none";
            } else {
                showMessage({
                    title: "Sucesso!",
                    message: "",
                    type: "success",
                    showConfirmButton: false,
                });
                document.getElementById("button-save-client").disabled = true;
                document.getElementById("icon-check-client").style.display = "none";
                document.getElementById("spinner-client").style.display = "inline-block";
                setTimeout(function () {
                    location.reload();
                }, 1500);
            }
        },
        error: function (response) {
            console.log(response);
        },
    });
});

$(".btn_edit_pass").on("click", function (event) {
    let id = event.target.dataset.id;

    $("#edit_pass_id").val(id);

    $("#modal_edit_pass").modal("show");
});

$("#edit_pass").on("submit", function (event) {
    event.preventDefault();
    
    document.getElementById("button-pass-edit").disabled = true;
    document.getElementById("check-pass-edit").style.display = "none";
    document.getElementById("spinner-pass").style.display = "inline-block";


    let form = $("#edit_pass")[0];

    $.ajax({
        url: "../process/admin/client/updatePass.php",
        processData: false,
        dataTypeIn: "plain",
        contentType: false,
        method: "POST",
        dataType: "json",
        data: new FormData(form),
        success: function (response) {
            if (response.error) {
                showMessage({ title: "Ops!", message: response.msg, type: "error" });
                document.getElementById("button-pass-edit").disabled = false;
                document.getElementById("check-pass-edit").style.display =
                    "inline-block";
                document.getElementById("spinner-pass").style.display = "none";
            } else {
                showMessage({
                    title: "Sucesso!",
                    message: "",
                    type: "success",
                    showConfirmButton: false,
                });
                setTimeout(function () {
                    location.reload();
                }, 1500);
            }
        },
        error: function (response) {
            console.log(response);
        },
    });
});