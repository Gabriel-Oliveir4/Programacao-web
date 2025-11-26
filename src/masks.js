$(function() {
  // Força o formato de duração como 1h35min, permitindo 1 ou 2 dígitos para horas
  $('.js-mask-duracao').mask('0#h00min', {
    translation: {
      '#': { pattern: /[0-9]/, optional: true },
    },
  });

  // Mantém apenas letras e números nas senhas
  $('.js-mask-senha').on('input', function() {
    this.value = this.value.replace(/[^A-Za-z0-9]/g, '');
  });
});
