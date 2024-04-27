$("#create_vice").on("submit", function (event) {
  
    event.preventDefault();
  
    let form = $("#create_vice")[0];
  
    $.ajax({ 
      url: "../process/admin/vices/create.php",
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
            $("#modal_create_vice").modal("hide");
            location.reload();
          }, 1500);
        }
      },
      error: function (response) {
        console.log(response);
      },
    });
  });