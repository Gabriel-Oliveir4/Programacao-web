import { Component } from '@angular/core';
import { Router } from '@angular/router';
import { AuthService } from '../core/services/auth.service';
import { Role } from '../core/models/user';

@Component({
  selector: 'app-shell',
  templateUrl: './shell.component.html',
  styleUrls: ['./shell.component.scss']
})
export class ShellComponent {
  constructor(private authService: AuthService, private router: Router) {}

  get role(): Role | null {
    return this.authService.role;
  }

  logout(): void {
    this.authService.logout();
  }

  goTo(path: string): void {
    this.router.navigate([path]);
  }
}
