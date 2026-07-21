import {Job} from "@/types/job";
import JobRow from "./JobRow";

import {Table, TableBody, TableHead, TableHeader, TableRow} from "@/components/ui/table";

interface JobTableProps{
    jobs: Job[];
}

export default function JobTable({jobs}: JobTableProps) {
    if(jobs.length === 0) {
        return (
            <p className="text-muted-foreground">
                No jobs available.
            </p>
        )
    }
    return(
        <Table>
            <TableHeader className="font-bold text-primary">
                <TableRow>
                    <TableHead>Location</TableHead>
                    <TableHead>Position</TableHead>
                    <TableHead>Company</TableHead>
                </TableRow>
            </TableHeader>

            <TableBody>
                
                {jobs.map((job) => (
                    <JobRow key={job.id} job={job}/>
                ))}
            </TableBody>
        </Table>
    );
}