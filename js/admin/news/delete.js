$(".get_news").on("click", function (event) {
    let id = event.target.dataset.id;

    $("#modal_delete_news").modal("show");

    $("#delete_news_id").val(id);
});

$("#delete_news").on("click", function () {
  let id = $("#delete_news_id").val();

  if (!id) {
      return showMessage({
          title: "Ops!",
          message: "Dica não encontrada!",
          type: "error",
      });
  }

  $.ajax({
      url: "../process/admin/news/delete.php",
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

$("#delete_news_img").on("click", function () {
  let id = $("#news_id").val();

  if (!id) {
    return showMessage({
      title: "Ops!",
      message: "Dica não encontrada!",
      type: "error",
    });
  }

  $.ajax({
    url: "../process/admin/news/delete-img.php",
    method: "POST",

    dataType: "json",
    data: { id },
    success: function (response) {
      if (response.error) {
        showMessage({
          title: "Ops!",
          message: response.msg,
          type: "error",
        });
      } else {
        location.reload();
      }
    },
    error: function (response) {
      console.log(response);
    },
  });
});