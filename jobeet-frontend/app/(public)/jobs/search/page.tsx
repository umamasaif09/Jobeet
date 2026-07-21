import JobTable from "@/components/jobs/JobTable";
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
        <>
        <JobTable jobs = {jobs}/>
        </>
    );
}