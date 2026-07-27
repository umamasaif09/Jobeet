import Container from "@/components/ui/Container";
import CategorySection from "@/components/categories/CategorySection";
import { getLatestJobs } from "@/services/jobs";

export default async function HomePage() {
  const categories= await getLatestJobs();
  console.log(categories);
  return (
    <Container>
      <div>
        <div>
          <h1>Latest Jobs</h1>
        </div>
        {categories.map((category) => (
          <CategorySection key={category.id}
          category={category}/>
        ))}
      </div>
    </Container>
  );
}
