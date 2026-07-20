import { getJobs } from "@/lib/api";

export default async function JobsPage() {
    const jobs= await getJobs();

    return(
        <div>
            {jobs.map((job:any) => (
                <div key={job.id}>
                    {job.position}
                </div>
            ))}
        </div>
    );
}