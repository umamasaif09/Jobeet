import { getJobs } from "@/services/jobs";

export async function JobsPage() {
  const jobs = await getJobs();

  return (
    <div>
      {jobs.map((job) => (
        <div key={job.id}>{job.position}</div>
      ))}
    </div>
  );
}
