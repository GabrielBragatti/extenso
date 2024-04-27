function showMessage({ title, message, type, showConfirmButton = true }) {
  return Swal.fire({
    title: title,
    text: message,
    icon: type,
    showConfirmButton
  });
}
