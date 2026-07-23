import AdminJobsTable from "@/components/jobs/AdminJobsTable";
import Container from "@/components/ui/Container";
import { getJobs } from "@/services/jobs";


export default async function JobsPage() {
  const jobs= await getJobs();

  return(
    <Container>
      <AdminJobsTable jobs={jobs} />
    </Container>
  )
}