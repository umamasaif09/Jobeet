export interface JobApi {
  id: number;
  category_id: number;
  company: string;
  type: string;
  logo: string | null;
  url: string | null;
  position: string;
  location: string;
  created_at: string;
  is_active: string;
  description: string;
  how_to_apply: string;
  is_public: string;
  email: string;
  token: string;
  expires_at: string;
  updated_at: string | null;
}

export interface Job {
  id: number;
  category_id: number;
  company: string;
  type: string;
  logo: string | null;
  url: string | null;
  position: string;
  location: string;
  created_at: string;
  is_active: boolean;
  description: string;
  how_to_apply: string;
  is_public: boolean;
  email: string;
  token: string;
  expires_at: string;
  updated_at: string | null;
}
