import Link from "next/link";
import { Job } from "@/types/job";

import {
    Card,
    CardContent,
    CardHeader,
    CardTitle
} from "@/components/ui/card";

interface JobCardProps{
    job: Job;
}

export default function JobCard({job}: JobCardProps) {
    return (
        <Card>
            <CardHeader>
                <CardTitle>
                    {job.position}
                </CardTitle>
            </CardHeader>

            <CardContent>
                <p>{job.company}</p>
                <p>{job.location}</p>

                <Link href={`/jobs${job.id}`}>View Job</Link>
            </CardContent>
        </Card>
    )
}