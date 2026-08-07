
import { Job } from "@/types/job";
import { TableCell
    , TableRow
 } from "../ui/table";
import JobAction from "./JobAction";
import styles from "./jobs.module.css";

type JobRowProps = {
    job: Job;
    onDelete: (job: Job) =>void;
 }

 export default function JobRow({job, onDelete}: JobRowProps) {
    return (
        <TableRow className={styles.adminJobsTableBodyTr}>
            <TableCell className={`${styles.adminJobsTableIdColumn} ${styles.adminTableBodyTd}`}>
                {job.id}
            </TableCell>

            <TableCell className={`${styles.adminJobTitle} ${styles.adminJobsTableBodyTd}`}>
                    {job.position}
            </TableCell>

            <TableCell className={`${styles.companyName} ${styles.adminJobsTableBodyTd}`}>
                {job.company}
            </TableCell>

            <TableCell className={` ${styles.adminJobsTableBodyTd}`}>
                <span className={styles.typeBadge}>{job.type}</span>
            </TableCell>

            <TableCell className={`${styles.locationText} ${styles.adminJobsTableBodyTd}`}>
                {job.location}
            </TableCell>

            <TableCell className={`${styles.adminJobsTableBodyTd}`}>
                <span className={job.is_active ? styles.badgeActive : styles.badgeInactive}>{job.is_active ? "Active" : "Inactive"}</span>                
            </TableCell >

            <TableCell className={` ${styles.adminJobsTableBodyTd}`}>
                  <span className={job.is_public ? styles.badgePublic : styles.badgePrivate}>{job.is_public ? "Public" : "Private"}</span>
                  
            </TableCell>

            <TableCell className={`${styles.expiryDate} ${styles.adminJobsTableBodyTd}`}>
                {new Date(job.expires_at).toLocaleDateString("en-GB",{
                  day: "2-digit",
                  month: "short",
                  year: "numeric"
                } )}
            </TableCell>

            <TableCell className={styles.rowMenu}>
              <JobAction
                job={job}
                onDelete ={onDelete}
              />
            </TableCell>
        </TableRow>
    )
 }