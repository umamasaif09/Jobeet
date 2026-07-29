import JobTable from "@/components/jobs/JobTable";
import BackButton from "@/components/ui/BackButton";
import { getJobsByKeyword } from "@/services/jobs";

type Props = {
    searchParams: Promise <{
        keyword? :string;
    }>;
};

export default async function SearchPage({searchParams}: Props) {
    const params = await searchParams;

    const keyword = params.keyword ?? "";

    const jobs = await getJobsByKeyword(keyword);

    return(
        <div className="space-y-6">
          <div className="flex gap-4 items-center">
            <BackButton/>
            <h1 className="font-heading text-xl font-semibold tracking-tight primary-text">
              Search Results
            </h1>
          </div>
          <JobTable jobs = {jobs}/>
        </div>
    );
}