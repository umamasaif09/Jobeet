import { getJobsByCategory } from "@/services/jobs";
import JobTable from "@/components/jobs/JobTable";
import BackButton from "@/components/ui/BackButton";
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
      <div className="space-y-6">
        <div className="flex gap-4 items-center">
          <BackButton/>
          <h1 className="font-heading text-xl font-semibold tracking-tight primary-text">
            {data.category.name}
          </h1>
        </div>
        
        <JobTable jobs={data.jobs}/>
      </div>
             
    );
}