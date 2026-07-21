import { getJobs } from "@/services/jobs";
import { getJobsByCategory } from "@/services/jobs";
import Container from "@/components/public/Container";
import JobTable from "@/components/jobs/JobTable";


export async function JobsPage() {
    const jobs= await getJobs();

    return(
        <div>
            {jobs.map((job) => (
                <div key={job.id}>
                    {job.position}
                </div>
            ))}
        </div>
    );
}

