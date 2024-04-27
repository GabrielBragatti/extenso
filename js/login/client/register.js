$("#user-register").on("submit", function (event) {
    event.preventDefault();

    $(".error").hide();

    $("#btn-register").attr({ disabled: true });

    $("#btn-register").text("Carregando...");

    let form = $("#user-register")[0];

    $.ajax({
        url: "../process/client/register.php",
        processData: false,
        dataTypeIn: "plain",
        contentType: false,
        method: "POST",
        dataType: "json",
        data: new FormData(form),
        success: function (response) {
            let { error, msg, field } = response;

            if (error) {
                $(`.error-${field}`).text(msg);
                $(`.error-${field}`).show();
                $("#btn-register").attr({ disabled: false });
                $("#btn-register").text("ENTRAR");
            } else {
                showMessage({
                    title: "Sucesso!",
                    message: "Cadastro realizado! Entrando no sistema!",
                    type: "success",
                    showConfirmButton: false,
                });
                setTimeout(function () {
                    location.reload();
                }, 2000);
            }
        },
        error: function (response) {
            console.log(response);
        },
    });
});