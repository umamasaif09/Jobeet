import {Job} from "@/types/job";
import JobRow from "./JobRow";
import styles from "./jobs.module.css"
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
      <div className={styles.jobsTableCard}> 
        <Table className={styles.jobsTable}>
            <TableHeader >
                <TableRow >
                    <TableHead className={styles.jobsTableHeaderTh}>Position</TableHead>
                    <TableHead className={styles.jobsTableHeaderTh}>Location</TableHead>
                    <TableHead className={styles.jobsTableHeaderTh}>Company</TableHead>
                    
                </TableRow>
            </TableHeader>

            <TableBody>
                
                {jobs.map((job) => (
                    <JobRow key={job.id} job={job} />
                ))}
            </TableBody>
        </Table>
      </div>
    );
}