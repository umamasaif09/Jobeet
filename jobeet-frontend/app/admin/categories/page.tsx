
import CategoryTable from "@/components/categories/CategoryTable";
import Container from "@/components/ui/Container";
import { getCategories } from "@/services/categories";


export default async function CategoryPage() {
  const categories = await getCategories();
  return(
    <Container>
      <CategoryTable categories={categories} />

    </Container>
  );
}