import CategorySection from "@/components/categories/CategorySection";
import { getLatestJobs } from "@/services/jobs";

export default async function HomePage() {
  const categories = await getLatestJobs();
  return (
    <div>
      {categories.map((category) => (
        <CategorySection key={category.id} category={category} />
      ))}
    </div>
  );
}
