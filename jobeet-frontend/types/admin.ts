export interface AdminApi{
  id: string;
  name: string;
  email: string;
  password: string;
  is_active: string;
  reset_token: string;
  reset_token_expires_at: string;
  created_at: string;
  updated_at: string;
}

export interface Admin{
  id: number;
  name: string;
  email: string;
  password: string;
  is_active: boolean;
  reset_token: string;
  reset_token_expires_at: string;
  created_at: string;
  updated_at: string;
}