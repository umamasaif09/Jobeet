import JobEditor from "@/components/jobs/JobEditor";
import { getCategories } from "@/services/categories";
import { getJob } from "@/services/jobs";
import { transformToJobForm } from "@/lib/transformers";

type Props = {
  params: Promise <{
    id: string;
    token: string;
  }>;
};

export default async function EditJobPage({params}: Props) {
  const {id, token} = await params;

  const job= await getJob(Number(id));

  const categories = await getCategories();

  return(
      <JobEditor
      mode="edit"
      userType="public"
      initialJob={transformToJobForm(job)}
      categories={categories}
      jobId={job.id}
      token={token}
    />
    
  );
}