import Link from "next/link";
import { Job } from "@/types/job";
import { TableCell
    , TableRow
 } from "../ui/table";
import JobAction from "./JobAction";
import { Badge } from "../ui/badge";

type JobRowProps = {
    job: Job;
    onDelete: (job: Job) =>void;
 }

 export default function JobRow({job, onDelete}: JobRowProps) {
    return (
        <TableRow>
            <TableCell>
                {job.id}
            </TableCell>

            <TableCell>
                    {job.position}
            </TableCell>

            <TableCell>
                {job.company}
            </TableCell>

            <TableCell>
                {job.type}
            </TableCell>

            <TableCell>
                {job.location}
            </TableCell>

            <TableCell>
              <Badge
                variant={job.is_active ? "default": "secondary"}
              >
                {job.is_active ? "Active" : "Inactive"}
              </Badge>
                
            </TableCell>

            <TableCell>
                <Badge
                  variant={job.is_public ? "default" : "secondary"}
                >
                  {job.is_public ? "Public" : "Private"}
                </Badge>
            </TableCell>

            <TableCell>
                {job.created_at}
            </TableCell>

            <TableCell className="w-[80px] text-right">
              <JobAction
                job={job}
                onDelete ={onDelete}
              />
            </TableCell>
        </TableRow>
    )
 }