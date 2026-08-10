import api from "@/lib/api";

export async function uploadLogo(file: File) {
  const formData = new FormData();

  formData.append("logo", file);

  const response = await api.post("/files/upload", formData);

  return response.data;
}
