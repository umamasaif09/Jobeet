import Link from "next/link";
import {SearchResults } from "@/types/search-results";
import { TableCell
    , TableRow
 } from "../ui/table";
 import styles from "./jobs.module.css"

 interface JobRowProps{
    job: SearchResults;
 }

 export default function SearchResultsRow({job}: JobRowProps) {
    return (
    <TableRow className={styles.jobsTableBodyTr}>
      <TableCell className={`${styles.jobsTableBodyTd} ${styles.jobTitle}`}>
        <Link href={`/jobs/${job.id}`}>
            {job.position}
        </Link>
    </TableCell>
            
    <TableCell className={styles.jobsTableBodyTd}>
        {job.location}
    </TableCell>

    <TableCell className={styles.jobsTableBodyTd}>
        {job.company}
    </TableCell>
    <TableCell className={styles.jobsTableBodyTd}>
        {job.name}
    </TableCell>
        </TableRow>
    )
 }