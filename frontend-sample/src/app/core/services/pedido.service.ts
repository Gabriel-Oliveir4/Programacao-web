import { Injectable } from '@angular/core';
import { HttpClient, HttpParams } from '@angular/common/http';
import { Observable } from 'rxjs';
import { environment } from '../../../environments/environment';
import { Pedido, PedidoItem } from '../models/pedido';

@Injectable({ providedIn: 'root' })
export class PedidoService {
  constructor(private http: HttpClient) {}

  listarTodos(): Observable<Pedido[]> {
    return this.http.get<Pedido[]>(`${environment.apiUrl}/api/pedidos`);
  }

  listarDoUsuario(usuarioId: string, visiveis = true): Observable<Pedido[]> {
    const params = new HttpParams().set('visiveis', String(visiveis));
    return this.http.get<Pedido[]>(`${environment.apiUrl}/api/pedidos/usuario/${usuarioId}`, { params });
  }

  buscar(id: string): Observable<Pedido> {
    return this.http.get<Pedido>(`${environment.apiUrl}/api/pedidos/${id}`);
  }

  criar(usuarioId: string, itens: PedidoItem[]): Observable<Pedido> {
    return this.http.post<Pedido>(`${environment.apiUrl}/api/pedidos`, { usuarioId, itens });
  }

  pagar(id: string, payload: { metodo: string; referencia: string }): Observable<void> {
    return this.http.post<void>(`${environment.apiUrl}/api/pedidos/${id}/pagar`, payload);
  }

  cancelar(id: string): Observable<void> {
    return this.http.post<void>(`${environment.apiUrl}/api/pedidos/${id}/cancelar`, {});
  }
}
