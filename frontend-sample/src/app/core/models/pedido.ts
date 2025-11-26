export interface PedidoItem {
  produtoId: string;
  quantidade: number;
}

export interface Pedido {
  id: string;
  usuarioId: string;
  itens: PedidoItem[];
  status?: string;
}
