$(".get_client").on("click", function (event) {
    let id = event.target.dataset.id;

    $("#modal_delete_client").modal("show");

    $("#delete_client_id").val(id);
});

$("#delete_client").on("submit", function (event) {
  
    event.preventDefault();
  
    let form = $("#delete_client")[0];
  
    $.ajax({ 
      url: "../process/admin/client/delete.php",
      processData: false,
      dataTypeIn: "plain",
      contentType: false,
      method: "POST",
      dataType: "json",
      data: new FormData(form),
      success: function (response) {
        if (response.error) { 
          showMessage({
            title: "Ops!",
            message: response.msg,
            type: "error",
          });
        } else {
          showMessage({
            title: "Sucesso!",
            message: "",
            type: "success",
            showConfirmButton: false,
          });
          setTimeout(function () {
            $("#modal_delete_client").modal("hide");
            location.reload();
          }, 1500);
        }
      },
      error: function (response) {
        console.log(response);
      },
    });
  });