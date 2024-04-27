$("#content-new-img").on("click", function() {
    $(".big-img").css('display', 'flex').hide().fadeIn(500);
        
});

$("#content-new-img").on("click", function() {
    $(".big-img").css('display', 'flex').fadeIn(500);
});

$(".icon-close").on("click", function() {
    $(".big-img").fadeOut(500);
});

$(".get_client_clean").on("click", function (event) {
    let id = event.target.dataset.id;

    $("#modal_delete_count").modal("show");

    $("#delete_count_id").val(id);
});

$("#delete_count").on("submit", function (event) {
  
    event.preventDefault();
  
    let form = $("#delete_count")[0];
  
    $.ajax({ 
      url: "../process/client/deleteClean.php",
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
            $("#modal_delete_count").modal("hide");
            location.reload();
          }, 1500);
        }
      },
      error: function (response) {
        console.log(response);
      },
    });
  });
