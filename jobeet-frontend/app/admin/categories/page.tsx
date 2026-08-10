import CategoryTable from "@/components/categories/CategoryTable";
import { getCategories } from "@/services/categories";

export default async function CategoryPage() {
  const categories = await getCategories();
  return <CategoryTable categories={categories} />;
}
