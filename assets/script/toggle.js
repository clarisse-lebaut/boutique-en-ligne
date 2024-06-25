function togglePassword(fieldId, spanId) {
  let field = document.getElementById(fieldId);
  let span = document.getElementById(spanId);

  if (field.type === "password") {
    field.type = "text";
    span.textContent = "Caché";
  } else {
    field.type = "password";
    span.textContent = "Voir";
  }
}
