import { getJob } from "@/services/jobs";
import { Separator } from "@/components/ui/separator";
import Container from "@/components/public/Container";
interface JobPageProps {
    params: Promise <{
        id:string;
    }>;
}

export default async function JobPage({params}: JobPageProps) {
    const {id} = await params;
    const job = await getJob(Number(id));
    return (
        <Container>
            <div>
            <h1>{job.company}</h1>
            <h2>{job.location}</h2>
            <Separator/>
            <h3>{job.position}</h3>
            <Separator/>
            <p>{job.description}</p>
            <p>{job.how_to_apply}</p>
        </div>
        </Container>
        
    );
}