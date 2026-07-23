import api from "@/lib/api";
import { AffiliateFormData } from "@/types/affiliate-form-data";

export async function getAffiliates(){
    const response = await api.get("/affiliates");

    return response.data;
}

export async function applyAffiliate(affiliate: AffiliateFormData){
  const response = await api.post("/affiliates/apply", affiliate);
  return response.data;
}