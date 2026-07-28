import api from "@/lib/api";
import { AdminEditData } from "@/types/edit-admin-data";
import { AdminRegisterData } from "@/types/register-admin-data";

export async function getDashboardStats() {
  const response = await api.get("/admins/dashboard");
  return response.data;
}

export async function getAdmins(cookie: string) {
  const response = await api.get("/admins", {
    headers: {
      Cookie: cookie,
    }
  });
  return response.data;
}

export async function getAdmin(id: string, cookie: string){
  const response = await api.get(`/admins/detail/${id}`, {
    headers: {
      Cookie: cookie,
    }
  });
  return response.data;
}

export async function createAdmin(admin: AdminRegisterData) {
  const response = await api.post(`/admins/create`, admin);
  return response.data;
}

export async function updateAdmin(id: string, admin: AdminEditData) {
  const response = await api.put(`/admins/update/${id}`, admin);
  return response.data;
}

export async function deleteAdmin(id: string) {
  const response = await api.post(`/admins/delete/${id}`);
  return response.data;
}

export async function activateAdmin(id: string) {
  const response = await api.post(`/admins/activate/${id}`);
  return response.data;
}

export async function disableAdmin(id: string) {
  const response = await api.post(`/admins/disable/${id}`);
  return response.data;
}