export type Role = 'ADMIN' | 'CLIENTE';

export interface User {
  id: string;
  nome: string;
  email: string;
  role: Role;
}
