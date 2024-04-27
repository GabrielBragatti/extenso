$("#update_news_img").on("submit", function (event) {
    event.preventDefault();

    let form = $("#update_news_img")[0];

    $.ajax({
        url: "../process/admin/news/upload.php",
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
                $("#create").modal("hide");
                location.reload();
            }
        },
        error: function (response) {
            console.log(response);
        },
    });
});

$("#update_news").on("submit", function (event) {
    event.preventDefault();
  
    document.getElementById("button-save").disabled = true;
    document.getElementById("icon-check").style.display = "none";
    document.getElementById("spinner").style.display = "inline-block";
  
    let form = $("#update_news")[0];
  
    $.ajax({
      url: "../process/admin/news/update.php",
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