import api from "@/lib/api";
import { Category, CategoryApi } from "@/types/category";
import { CreateCategoryData } from "@/types/create-category-data";

export async function getCategories(): Promise<Category[]> {
    const response = await api.get<CategoryApi[]>("/categories");
    return response.data.map((category) => ({
        ...category,
        id: Number(category.id),
        name: category.name,
    }));
}

export async function createCategory(category: CreateCategoryData) {
    const response = await api.post("/categories/create", category);
    return response.data;
}

export async function updateCategory(id:number,  category: CreateCategoryData){
  const response = await api.put(`/categories/update/${id}/`, category);
  return response.data;
}

export async function deleteCategory(id: number) {
  const response= await api.delete(`/categories/delete/${id}`);
  return response.data;
}