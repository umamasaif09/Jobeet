import Container from "@/components/ui/Container";
import CategorySection from "@/components/categories/CategorySection";
import { getLatestJobs } from "@/services/jobs";

export default async function HomePage() {
  const categories= await getLatestJobs();
  console.log(categories);
  return (
    <Container>
      <div className="space-y-10 py-10">
        <div>
          <h1 className="text-4xl font-bold tracking-tight">Latest Jobs</h1>
        </div>
        {categories.map((category) => (
          <CategorySection key={category.id}
          category={category}/>
        ))}
      </div>
    </Container>
  );
}
