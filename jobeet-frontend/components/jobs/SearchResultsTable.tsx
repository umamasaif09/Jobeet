import {SearchResults} from "@/types/search-results";
import styles from "./jobs.module.css"
import {Table, TableBody, TableHead, TableHeader, TableRow} from "@/components/ui/table";
import SearchResultsRow from "./SearchResultsRow";

interface JobTableProps{
    jobs: SearchResults[];
}

export default function SearchResultsTable({jobs}: JobTableProps) {
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
                <TableRow className={styles.jobsTableBodyTr}>
                    <TableHead className={styles.jobsTableHeaderTh}>Position</TableHead>
                    <TableHead className={styles.jobsTableHeaderTh}>Location</TableHead>
                    <TableHead className={styles.jobsTableHeaderTh}>Company</TableHead>
                    <TableHead className={styles.jobsTableHeaderTh}>Category</TableHead>
                </TableRow>
            </TableHeader>

            <TableBody className={styles.jobsTableBodyTr}>
                
                {jobs.map((job) => (
                    <SearchResultsRow key={job.id} job={job}/>
                ))}
            </TableBody>
        </Table>
      </div>
    );
}