import {Job} from "@/types/job";
import JobRow from "./JobRow";

import {Table, TableBody, TableHead, TableHeader, TableRow} from "@/components/ui/table";

interface JobTableProps{
    jobs: Job[];
}

export default function JobTable({jobs}: JobTableProps) {
    if(jobs.length === 0) {
        return (
            <p>
                No jobs available.
            </p>
        )
    }
    return(
      <div className="rounded-md border "> 
        <Table className="table-fixed w-full">
            <TableHeader>
                <TableRow>
                    <TableHead className="w-[150px]">Position</TableHead>
                    <TableHead className="w-[100px]">Location</TableHead>
                    <TableHead className="w-[100px]">Company</TableHead>
                </TableRow>
            </TableHeader>

            <TableBody>
                
                {jobs.map((job) => (
                    <JobRow key={job.id} job={job}/>
                ))}
            </TableBody>
        </Table>
      </div>
    );
}