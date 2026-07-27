import api from "@/lib/api";
import { AffiliateFormData } from "@/types/affiliate-form-data";

export async function getAffiliates(cookie: string){


    const response = await api.get("/affiliates", {
      headers : {
        Cookie: cookie,
      }
    });

    return response.data;
}

export async function getAffiliate(id: string, cookie: string){
  const response = await api.get(`/affiliates/detail/${id}`, {
    headers: {
      Cookie: cookie,
    }
  });
  return response.data;
}

export async function applyAffiliate(affiliate: AffiliateFormData){
  const response = await api.post("/affiliates/apply", affiliate);
  return response.data;
}

export async function createAffiliate(affiliate: AffiliateFormData){
  const response = await api.post("/affiliates/create", affiliate);
  return response.data;
}

export async function updateAffiliate(id:number, affiliate: AffiliateFormData){
  const response = await api.put(`/affiliates/update/${id}`, affiliate);
  return response.data;
}

export async function activateAffiliate(id: number) {
  const response = await api.post(`/affiliates/activate/${id}`);
  return response.data;
}

export async function disableAffiliate(id: number) {
  const response = await api.post(`/affiliates/disable/${id}`);
  return response.data;
}

export async function deleteAffiliate(id: number) {
  const response= await api.delete(`/affiliates/delete/${id}`);
  return response.data;
}