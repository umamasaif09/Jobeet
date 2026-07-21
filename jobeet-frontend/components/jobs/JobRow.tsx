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
        <TableRow className="hover:bg-muted/50">
            <TableCell>
                {job.location}
            </TableCell>

            <TableCell>
                <Link href={`/jobs/${job.id}`}
                className="font-semibold text-primary hover:underline">
                    {job.position}
                </Link>
            </TableCell>

            <TableCell>
                {job.company}
            </TableCell>
        </TableRow>
    )
 }