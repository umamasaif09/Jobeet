export interface AffiliateApi{
    id:string;
    name: string;
    email: string;
    site_url: string | null;
    token: string;
    is_active: string
    created_at: string;
    categories: [];
}

export interface Affiliate{
    id:number;
    name: string;
    email: string;
    site_url: string | null;
    token: string;
    is_active: boolean;
    created_at: string;
}