
import CategorySection from "@/components/categories/CategorySection";
import { getLatestJobs } from "@/services/jobs";

export default async function HomePage() {
  const categories= await getLatestJobs();
  return (
      <div className="space-y-6">
        {categories.map((category) => (
          <CategorySection key={category.id}
          category={category}/>
        ))}
      </div>
  );
}
