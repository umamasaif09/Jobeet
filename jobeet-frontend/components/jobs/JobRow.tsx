import Link from "next/link";
import { Job } from "@/types/job";
import { TableCell, TableRow } from "../ui/table";
import styles from "./jobs.module.css";

interface JobRowProps {
  job: Job;
}

export default function JobRow({ job }: JobRowProps) {
  return (
    <TableRow className={styles.jobsTableBodyTr}>
      <TableCell className={styles.jobsTableBodyTd}>
        <Link href={`/jobs/${job.id}`} className={styles.jobTitle}>
          {job.position}
        </Link>
      </TableCell>

      <TableCell className={styles.jobsTableBodyTd}>{job.location}</TableCell>

      <TableCell className={styles.jobsTableBodyTd}>{job.company}</TableCell>
    </TableRow>
  );
}
