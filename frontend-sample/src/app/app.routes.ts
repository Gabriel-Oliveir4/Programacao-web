import { Routes } from '@angular/router';
import { AuthGuard } from './core/guards/auth.guard';
import { RoleGuard } from './core/guards/role.guard';
import { LoginComponent } from './auth/login/login.component';
import { DashboardComponent } from './modules/dashboard/dashboard.component';
import { AdminComponent } from './modules/admin/admin.component';

export const routes: Routes = [
  {
    path: 'auth',
    children: [{ path: 'login', component: LoginComponent }]
  },
  {
    path: 'dashboard',
    component: DashboardComponent,
    canActivate: [AuthGuard]
  },
  {
    path: 'admin',
    component: AdminComponent,
    canActivate: [AuthGuard, RoleGuard],
    data: { roles: ['ADMIN'] }
  },
  { path: '', pathMatch: 'full', redirectTo: 'dashboard' },
  { path: '**', redirectTo: 'dashboard' }
];
