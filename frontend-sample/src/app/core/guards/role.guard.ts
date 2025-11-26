import { Injectable } from '@angular/core';
import { ActivatedRouteSnapshot, CanActivate, Router, UrlTree } from '@angular/router';
import { AuthService } from '../services/auth.service';

@Injectable({ providedIn: 'root' })
export class RoleGuard implements CanActivate {
  constructor(private authService: AuthService, private router: Router) {}

  canActivate(route: ActivatedRouteSnapshot): boolean | UrlTree {
    const allowedRoles = route.data['roles'] as string[] | undefined;
    const userRole = this.authService.role;

    if (!allowedRoles || !allowedRoles.length) {
      return true;
    }

    if (userRole && allowedRoles.includes(userRole)) {
      return true;
    }

    return this.router.parseUrl('/dashboard');
  }
}
