$(function () {
  const senhaRegex = /^(?=.*[A-Za-z])(?=.*[0-9])[A-Za-z0-9]{6,}$/;
  const duracaoRegex = /^[0-9]{2}h[0-5][0-9]min$/;

  function sanitizarSenha(input) {
    input.value = input.value.replace(/[^A-Za-z0-9]/g, "");
  }

  function validarSenha(input) {
    const valor = input.value.trim();

    if (!valor) {
      input.setCustomValidity("");
      return;
    }

    if (senhaRegex.test(valor)) {
      input.setCustomValidity("");
    } else {
      input.setCustomValidity(
        "Senha inválida. Use pelo menos 6 caracteres, com letras e números, sem caracteres especiais."
      );
    }
  }

  function validarDuracao(input) {
    const valor = input.value.trim();

    if (!valor) {
      input.setCustomValidity("");
      return;
    }

    if (duracaoRegex.test(valor)) {
      input.setCustomValidity("");
    } else {
      input.setCustomValidity(
        "Informe no formato 00h00min, por exemplo: 01h30min."
      );
    }
  }

  const $senha = $(".js-mask-senha");

  $senha.on("input", function () {
    sanitizarSenha(this);
    validarSenha(this);
    this.reportValidity();
  });

  $senha.on("blur", function () {
    validarSenha(this);
  });

  const $duracao = $(".js-mask-duracao");

  $duracao.on("input", function () {
    validarDuracao(this);
    this.reportValidity();
  });

  $duracao.on("blur", function () {
    validarDuracao(this);
  });
});
