import api from "@/lib/api";

export async function getAffiliates(){
    const response = await api.get("/affiliates");

    return response.data;
}