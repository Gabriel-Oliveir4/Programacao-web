import { Component } from '@angular/core';

@Component({
  selector: 'app-admin',
  template: `
    <h2 class="mb-3">Área Administrativa</h2>
    <p class="text-muted">Somente usuários com role ADMIN acessam este módulo.</p>
  `
})
export class AdminComponent {}
