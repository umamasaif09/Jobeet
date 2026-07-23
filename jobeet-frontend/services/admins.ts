import api from "@/lib/api";

export async function getDashboardStats() {
  const response = await api.get("/admins/dashboard");
  return response.data;
}