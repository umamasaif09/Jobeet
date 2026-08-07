import { getJobsByCategory } from "@/services/jobs";
import JobTable from "@/components/jobs/JobTable";
import BackButton from "@/components/ui/BackButton";
import JobsPagination from "@/components/jobs/JobsPagination";
import pageStyles from "@/app/styles/jobeet.module.css";
import paginationStyles from "@/components/jobs/jobs.module.css";

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
      <div >
        <div className="flex gap-4 items-center my-[24px]">
          <BackButton/>
          <h1 className={pageStyles.pageTitle}>
            {data.category.name}
          </h1>
        </div>
        
        <JobTable jobs={data.jobs}/>
        <p className={paginationStyles.pageInfo}>{data.totalJobs} Jobs in this category</p>

        {data.totalPages > 1 && (
          <JobsPagination
          categoryId={categoryId}
          page={page}
          totalPages={data.totalPages}
        />
        )}
        
      </div>
             
    );
}