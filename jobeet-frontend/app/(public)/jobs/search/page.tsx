
import BackButton from "@/components/ui/BackButton";
import { getJobsByKeyword } from "@/services/jobs";
import { toast } from "sonner";
import pageStyles from "@/app/styles/jobeet.module.css";
import SearchResultsTable from "@/components/jobs/SearchResultsTable";


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
          <div className="flex gap-4 items-center my-[24px]">
            <BackButton/>
            <h1 className={pageStyles.pageTitle}>
              Search Results
            </h1>
          </div>
          {jobs ? (
            <SearchResultsTable jobs = {jobs}/>
          ) : toast.error("No results available")
          }
          
        </div>
    );
}