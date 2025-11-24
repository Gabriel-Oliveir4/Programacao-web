# Programação Web MVC

Esta aplicação PHP segue uma estrutura simples de MVC com autenticação de usuário e cadastro de filmes vinculados ao criador. Abaixo estão os principais arquivos organizados por diretório, com uma breve descrição das funções e de como elas se conectam.

## /src/connectBD.php
- **connect()**: abre a conexão `mysqli` com o banco `LOCADORA` e armazena o recurso globalmente.
- **query($sql)**: garante `utf8mb4`, executa a query recebida usando a conexão aberta e retorna o resultado.
- **closeConn()**: fecha a conexão aberta se existir.

Essas funções são utilizadas pelos arquivos de *model* para compartilhar a mesma lógica de conexão, evitando duplicação.

## /src/model
- **crud_usuario.php**
  - **cadastrarUsuario($nome, $senhaSha1)**: insere um novo usuário com senha já codificada.
  - **buscarUsuario($nome)**: recupera um único usuário (código, nome e hash da senha) pelo nome para autenticação.

- **crud_filme.php**
  - **cadastrarFilme($nome, $tipo, $duracao, $usuarioId)**: cria um filme já associado ao usuário logado (`COD_USER`).
  - **listarFilmes($usuarioId)**: retorna apenas os filmes do usuário que fez login.
  - **buscarFilmePorId($id, $usuarioId = null)**: busca um filme específico e pode restringir pelo proprietário.
  - **atualizarFilme($id, $nome, $tipo, $duracao, $usuarioId)**: atualiza um filme garantindo que pertence ao usuário.
  - **excluirFilme($id, $usuarioId)**: remove um filme se for do usuário autenticado.

Cada função de model abre a conexão via `connect()`, executa a operação com `query()` e encerra com `closeConn()`.

## /src/controller
- **controller_usuario.php**
  - Recebe ações via `$_POST['opcao']` para **cadastrar**, **entrar** ou **sair**.
  - Usa `crud_usuario.php` para persistir ou buscar usuários, grava `$_SESSION['id']` e `$_SESSION['nome']` no login e faz os redirecionamentos das views.

- **controller_filme.php**
  - Exige sessão ativa e lê a ação em `$_POST['opcao']` (ou `$_GET` para consultas).
  - Encaminha para as funções de `crud_filme.php` para criar, atualizar ou excluir filmes vinculando sempre o `COD_USER` ao usuário logado antes de redirecionar para as views.

## /src/view
Views que renderizam os formulários e listas de filmes (dashboard, login, cadastro e edição) incluem os componentes compartilhados e enviam as ações para os *controllers* correspondentes.

## /src/componentes
- **head.php**: inclui meta tags, Bootstrap, jQuery e o arquivo de máscaras (`masks.js`).
- **navbar.php**: monta a navegação, exibe o nome do usuário da sessão e traz o formulário de logout que envia para `controller_usuario.php`.

## Outros arquivos
- **/src/masks.js**: aplica máscara de entrada via jQuery (por exemplo, em campos de senha ou datas).
- **/src/session.php**: valida a sessão para páginas protegidas e redireciona para o login se `id` ou `nome` não estiverem definidos.

## Fluxo geral
1. **Login**: `view/login.php` envia para `controller_usuario.php` (`opcao=entrar`), que chama `buscarUsuario()` e grava `$_SESSION` ao autenticar.
2. **Sessão**: páginas protegidas incluem `session.php`, garantindo que `id` e `nome` existam antes de carregar.
3. **Filmes**: formulários em `view` enviam para `controller_filme.php`, que chama as funções de `crud_filme.php` passando o `usuarioId` da sessão para manter o relacionamento filmes ↔ usuário.
4. **Listagem**: `dashboard.php` chama `listarFilmes($_SESSION['id'])` para mostrar apenas os filmes do usuário autenticado.
