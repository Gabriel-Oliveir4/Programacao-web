import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { environment } from '../../../environments/environment';
import { User } from '../models/user';

@Injectable({ providedIn: 'root' })
export class UserService {
  constructor(private http: HttpClient) {}

  registerCliente(payload: { nome: string; email: string; senha: string }): Observable<User> {
    return this.http.post<User>(`${environment.apiUrl}/api/auth/register`, payload);
  }

  registerAdmin(payload: { nome: string; email: string; senha: string }): Observable<User> {
    return this.http.post<User>(`${environment.apiUrl}/api/usuarios/registrar-admin`, payload);
  }

  getPerfil(): Observable<User> {
    return this.http.get<User>(`${environment.apiUrl}/api/usuarios/me`);
  }
}
