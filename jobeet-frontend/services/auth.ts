import api from "@/lib/api";
import { LoginData } from "@/types/login_data";
import { ResetPasswordData } from "@/types/reset-password";

export async function login(data: LoginData) {
  const response = await api.post("/auth/login", data);

  return response.data;
}

export async function forgotPassword(email: string) {
  const response = await api.post("/auth/forgotPassword", {email});

  return response.data;
}

export async function resetPassword(data: ResetPasswordData) {
  const response = await api.post(`/auth/resetPassword/${data.token}`, data);

  return response.data;

}