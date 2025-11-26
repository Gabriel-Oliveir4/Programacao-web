# Exemplo de integração Angular com a API La Couro

Use estes arquivos como referência para configurar seu projeto Angular já criado. A estrutura cobre autenticação JWT, guards por role e chamadas principais do backend descrito no README da raiz.

## Como usar
1. Copie a pasta `src` deste diretório para dentro do seu projeto Angular ou adapte os arquivos às pastas existentes.
2. Garanta que os seguintes módulos estejam importados no `AppModule` do seu projeto:
   - `HttpClientModule` (necessário para as chamadas HTTP).
   - `ReactiveFormsModule`.
   - Angular Material usado pelo login: `MatCardModule`, `MatFormFieldModule`, `MatInputModule`, `MatButtonModule`, `MatIconModule`, `MatProgressSpinnerModule`, `MatToolbarModule`.
3. Registre o interceptor no provider do módulo raiz:
   ```ts
   { provide: HTTP_INTERCEPTORS, useClass: AuthInterceptor, multi: true }
   ```
4. Inclua o array `routes` de `app.routes.ts` no `RouterModule.forRoot(routes)`.
5. Ajuste `environment.apiUrl` conforme a URL da API.
6. Certifique-se de que o `AppComponent` use `<app-shell></app-shell>` e que `ShellComponent`, `LoginComponent`, `DashboardComponent` e `AdminComponent` estejam declarados ou marcados como standalone conforme sua preferência.

## Fluxo de autenticação
- O `AuthService.login` chama `POST /api/auth/login` e persiste o token em `localStorage`. Ele também tenta extrair a role (`ADMIN` ou `CLIENTE`) do JWT.
- `AuthInterceptor` adiciona o header `Authorization: Bearer <token>` para todas as requisições autenticadas.
- `AuthGuard` redireciona para `/auth/login` se não houver token.
- `RoleGuard` bloqueia rotas que exigem roles específicas (ex.: admin).

## Serviços prontos
- `UserService` para registro de cliente (`/api/auth/register`), criação de admin (`/api/usuarios/registrar-admin`) e leitura do perfil.
- `ProdutoService` para CRUD de produtos e troca de visibilidade.
- `PedidoService` para criar, listar e pagar/cancelar pedidos.

## Tela de login
O componente `LoginComponent` contém:
- Formulário reativo com validações e mensagens de erro.
- Spinner de carregamento e exibição de erro de API.
- Integração direta com `AuthService` para guardar o token e navegar para `/dashboard` após sucesso.

Adapte as rotas, módulos e layout conforme a necessidade do seu projeto. Estes arquivos são um ponto de partida rápido para conectar seu frontend ao backend La Couro.
