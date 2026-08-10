import { getJob } from "@/services/jobs";
import JobCard from "@/components/jobs/JobCard";
interface JobPageProps {
  params: Promise<{
    id: string;
  }>;
}

export default async function JobPage({ params }: JobPageProps) {
  const { id } = await params;
  const job = await getJob(Number(id));
  return <JobCard job={job} />;
}
