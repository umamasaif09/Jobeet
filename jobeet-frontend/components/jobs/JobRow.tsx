import Link from "next/link";
import { Job } from "@/types/job";
import { TableCell
    , TableRow
 } from "../ui/table";

 interface JobRowProps{
    job: Job;
 }

 export default function JobRow({job}: JobRowProps) {
    return (
        <TableRow>
            <TableCell>
                {job.location}
            </TableCell>

            <TableCell>
                <Link href={`/jobs/${job.id}`}>
                    {job.position}
                </Link>
            </TableCell>

            <TableCell>
                {job.company}
            </TableCell>
        </TableRow>
    )
 }