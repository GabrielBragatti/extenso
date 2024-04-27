(() => {
  'use strict'

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  const forms = document.querySelectorAll('.needs-validation')

  // Loop over them and prevent submission
  Array.from(forms).forEach(form => {
    form.addEventListener('submit', event => {
      if (!form.checkValidity()) {  
        event.preventDefault()
        event.stopPropagation()
      }

      form.classList.add('was-validated')
    }, false)
  })
})()


$("#user-login").on("submit", function (event) {
  event.preventDefault();

  $(".error").hide(); 

  $("#button-login").attr({disabled: true });

  $("#button-login").text("Carregando...");

  let form = $("#user-login")[0];

  $.ajax({
    url: "../process/admin/login.php",
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
        $("#button-login").attr({ disabled: false });
        $("#button-login").text("ENTRAR");
      } else {
        location.reload();
      }
    },
    error: function (response) {
      console.log(response);
    },
  });
});

$("#user-logout").on("click", function () {
  $.ajax({
    url: "../process/admin/logout.php",
    success: () => location.reload(),
    error: function (response) {
      console.log(response);
    },
  });
});