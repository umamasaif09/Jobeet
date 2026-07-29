import AdminJobsTable from "@/components/jobs/AdminJobsTable";
import { getJobs } from "@/services/jobs";


export default async function JobsPage() {
  const jobs= await getJobs();

  return(
      <AdminJobsTable jobs={jobs} />
  )
}