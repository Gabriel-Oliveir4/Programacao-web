import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Router } from '@angular/router';
import { BehaviorSubject, Observable, tap } from 'rxjs';
import { environment } from '../../../environments/environment';
import { LoginRequest } from '../models/login-request';
import { LoginResponse } from '../models/login-response';
import { Role, User } from '../models/user';

const TOKEN_KEY = 'lacouro_token';
const ROLE_KEY = 'lacouro_role';

@Injectable({ providedIn: 'root' })
export class AuthService {
  private currentUserSubject = new BehaviorSubject<User | null>(null);
  currentUser$ = this.currentUserSubject.asObservable();

  constructor(private http: HttpClient, private router: Router) {
    const storedRole = localStorage.getItem(ROLE_KEY) as Role | null;
    if (storedRole) {
      // Basic restoration when only role is persisted. Ideally, decode JWT for full user info.
      this.currentUserSubject.next({ id: '', nome: '', email: '', role: storedRole });
    }
  }

  login(payload: LoginRequest): Observable<LoginResponse> {
    return this.http
      .post<LoginResponse>(`${environment.apiUrl}/api/auth/login`, payload)
      .pipe(tap((response) => this.setSession(response)));
  }

  logout(): void {
    localStorage.removeItem(TOKEN_KEY);
    localStorage.removeItem(ROLE_KEY);
    this.currentUserSubject.next(null);
    this.router.navigate(['/auth/login']);
  }

  isLoggedIn(): boolean {
    return !!localStorage.getItem(TOKEN_KEY);
  }

  get token(): string | null {
    return localStorage.getItem(TOKEN_KEY);
  }

  get role(): Role | null {
    return (localStorage.getItem(ROLE_KEY) as Role | null) ?? null;
  }

  private setSession(response: LoginResponse): void {
    localStorage.setItem(TOKEN_KEY, response.token);
    // Decode JWT or call /api/usuarios/me to fetch role; using simplified placeholder:
    const role = this.extractRoleFromToken(response.token);
    if (role) {
      localStorage.setItem(ROLE_KEY, role);
      this.currentUserSubject.next({ id: '', nome: '', email: '', role });
    }
  }

  private extractRoleFromToken(token: string): Role | null {
    try {
      const payload = JSON.parse(atob(token.split('.')[1]));
      return payload.role as Role;
    } catch {
      return null;
    }
  }
}
