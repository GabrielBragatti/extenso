$("#update_client_account").on("submit", function (event) {
    event.preventDefault();

    document.getElementById("button-save").disabled = true;
    document.getElementById("icon-check").style.display = "none";
    document.getElementById("spinner").style.display = "inline-block";

    let form = $("#update_client_account")[0];

    $.ajax({
        url: "../process/client/account/update.php",
        processData: false,
        dataTypeIn: "plain",
        contentType: false,
        method: "POST",
        dataType: "json",
        data: new FormData(form),
        success: function (response) {
            if (response.error) {
                showMessage({ title: "Ops!", message: response.msg, type: "error" });
                document.getElementById("button-save").disabled = false;
                document.getElementById("icon-check").style.display = "inline-block";
                document.getElementById("spinner").style.display = "none";
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
        url: "../process/client/account/updatePass.php",
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