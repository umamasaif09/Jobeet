import api from "@/lib/api";
import { Category, CategoryApi } from "@/types/category";

export async function getCategories(): Promise<Category[]> {
    const response = await api.get<CategoryApi[]>("/categories");
    return response.data.map((category) => ({
        ...category,
        id: Number(category.id),
    }));
}

