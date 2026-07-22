import { getJobsByCategory } from "@/services/jobs";
import Container from "@/components/ui/Container";
import JobTable from "@/components/jobs/JobTable";
interface JobsPageProps {
    searchParams: Promise<{
    category?: string;
    page?: string;
    }>;
}

export default async function CategoryPage({searchParams}: JobsPageProps) {
    const params = await searchParams;

    const categoryId= Number(params.category);
    const page= Number(params.page ?? "1");

    const data = await getJobsByCategory(categoryId, page);
    return(
       <Container>
             <h1>{data.category.name}</h1>
             <JobTable jobs={data.jobs}/>
           </Container>
    );
}