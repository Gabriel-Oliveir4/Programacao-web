$(function() {
  const duracaoRegex = /^[0-9]{1,2}h[0-5][0-9]min$/;
  const senhaRegex = /^(?=.*[A-Za-z])(?=.*[0-9])[A-Za-z0-9]+$/;

  function validarDuracao(input) {
    const valor = input.value.trim();

    if (!valor || duracaoRegex.test(valor)) {
      input.setCustomValidity('');
    } else {
      input.setCustomValidity('Informe no formato 1h35min (apenas números, "h" e "min").');
    }
  }

  function sanitizarSenha(input) {
    const limpo = input.value.replace(/[^A-Za-z0-9]/g, '');

    if (limpo !== input.value) {
      input.value = limpo;
    }
  }

  function validarSenha(input) {
    const valor = input.value.trim();

    if (!valor || senhaRegex.test(valor)) {
      input.setCustomValidity('');
    } else {
      input.setCustomValidity('Use letras e números, pelo menos um de cada, sem caracteres especiais.');
    }
  }

  // Máscara e validação da duração
  $('.js-mask-duracao')
    .mask('0#h00min', {
      translation: {
        '#': { pattern: /[0-9]/, optional: true },
      },
    })
    .on('input blur', function() {
      validarDuracao(this);
    });

  // Sanitização e validação das senhas
  $('.js-mask-senha')
    .on('input', function() {
      sanitizarSenha(this);
      validarSenha(this);
    })
    .on('blur', function() {
      validarSenha(this);
    });
});
