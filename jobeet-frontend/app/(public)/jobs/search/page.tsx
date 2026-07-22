import JobTable from "@/components/jobs/JobTable";
import { getJobsByKeyword } from "@/services/jobs";
import Container from "@/components/ui/Container";

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
        <Container>
            <JobTable jobs = {jobs}/>
        </Container>
        
        </>
    );
}