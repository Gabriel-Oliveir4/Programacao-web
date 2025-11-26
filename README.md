# Guia de Setup do Frontend Angular

Este repositório fornece o backend para a aplicação. O guia abaixo descreve um modelo sugerido para levantar um frontend Angular que consome esta API.

## 1. Criação e estrutura inicial
- Gere o projeto com rotas e SCSS:
  ```bash
  ng new sua-app --routing --style=scss
  ```
- Instale dependências de UI:
  ```bash
  npm install bootstrap
  ng add @angular/material
  ```
- Referencie o Bootstrap em `angular.json`.
- Estrutura de pastas recomendada:
  ```
  src/app/core       # guards, interceptors, serviços de auth, models
  src/app/shared     # componentes, pipes e diretivas compartilhadas
  src/app/modules    # feature modules com lazy loading
  src/environments   # environment.ts e environment.prod.ts com apiUrl
  ```

## 2. Models e autenticação
- Crie os models:
  - `core/models/user.ts`: `id`, `nome`, `email`, `role`.
  - `core/models/login-request.ts` e `core/models/login-response.ts` (contém o `token`).
- Implemente `core/services/auth.service.ts` com `login(email, senha)` realizando `POST ${apiUrl}/api/auth/login` e armazenando o token no `localStorage`.
- Crie `core/interceptors/auth.interceptor.ts` para anexar `Authorization: Bearer <token>`.

## 3. Guards de autenticação e roles
- `core/guards/auth.guard.ts`: bloqueia acesso se não estiver logado.
- `core/guards/role.guard.ts`: valida a `role` (ex.: `admin` vs `user`).
- Ambos usam o `AuthService` para validar token e role (pode vir de um endpoint `/me` ou do próprio token).

## 4. Módulos e rotas (lazy loading)
- Defina `app.routes.ts` com `loadChildren` para os módulos:
  - `/auth` → `AuthModule` (público, login/recuperar senha).
  - `/dashboard` → `DashboardModule` (guard `AuthGuard`).
  - `/admin` → `AdminModule` (guards `AuthGuard` + `RoleGuard` com `roles: ['admin']`).
- `AppComponent` deve conter `<router-outlet>` principal.

## 5. Módulo Auth (login)
- `auth-routing.module.ts` com rota padrão para `LoginComponent`.
- `LoginComponent` usa `ReactiveFormsModule` com form de `email` (required+email) e `senha` (required).
- Exibir mensagens de validação com `<mat-error>`.
- Botão **Entrar** chama `AuthService.login`, mostra loading e trata erro.
- Layout sugerido: `MatCard`, `MatFormField`, `MatInput`, `MatButton` e grid do Bootstrap (`container`, `row`, `col`).

## 6. Interceptor e providers globais
- Registrar `AuthInterceptor` em `app.module.ts` (ou `core/core.module` com `providers`).
- Importar `HttpClientModule` no `AppModule`.

## 7. Layout base (toolbar + navegação)
- Criar componente Shell/Layout com `MatToolbar`, ícone/menu e container para `<router-outlet>`.
- Exibir navegação condicional por role (link **Admin** apenas para `admin`).
- Responsividade com grid/Bootstrap.

## 8. Módulos de features (exemplo: Alunos)
- Criar `AlunoModule` (lazy) com rotas internas.
- `AlunoService` para CRUD com `HttpClient` (`GET/POST/PUT/DELETE`).
- Componentes: listagem (`MatTable` + paginação/sort) e formulários de criação/edição (Reactive Forms + validações).

## 9. Configuração de ambientes
- Ajustar `src/environments/environment.ts` e `.prod.ts` com `apiUrl`.
- Utilizar `environment.apiUrl` em todos os serviços.

## 10. Teste rápido de autenticação
- Executar `ng serve`.
- Testar login em `POST /api/auth/login`, confirmar armazenamento do token e navegação para rota protegida.
- Verificar redirecionamento para login sem token e bloqueio de `/admin` para usuário comum pelo `RoleGuard`.

Seguindo este roteiro você cobre estrutura, lazy loading, integração com API, segurança (token + interceptor + guards), formulários com validação e UI usando Angular Material e Bootstrap.
