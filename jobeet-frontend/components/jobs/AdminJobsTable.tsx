"use client";

import { Job } from "@/types/job";

import {
  Table,
  TableBody,
  TableHead,
  TableHeader,
  TableRow,
} from "@/components/ui/table";
import { useRouter } from "next/navigation";
import Link from "next/link";
import { Button } from "../ui/button";
import AdminJobRow from "./AdminJobRow";
import pageStyles from "@/app/styles/jobeet.module.css";
import styles from "./jobs.module.css";
import { deleteJob } from "@/services/jobs";

interface JobTableProps {
  jobs: Job[];
}

export default function JobTable({ jobs }: JobTableProps) {
  const router = useRouter();

  if (jobs.length === 0) {
    return <p className="text-muted-foreground">No Jobs Available.</p>;
  }

  return (
    <div className="space-y-6 my-[24px]">
      <div className="flex justify-between items-center">
        <h1 className={pageStyles.pageTitle}>Manage Jobs</h1>

        <Link href={`/admin/jobs/create`}>
          <Button className={styles.jobButton}>New Job</Button>
        </Link>
      </div>

      <div className={styles.adminJobsTableCard}>
        <Table className={styles.adminJobsTable}>
          <TableHeader>
            <TableRow>
              <TableHead className={styles.adminJobsTableHeaderTh}>
                Job ID
              </TableHead>
              <TableHead className={styles.adminJobsTableHeaderTh}>
                Position
              </TableHead>
              <TableHead className={styles.adminJobsTableHeaderTh}>
                Company Name
              </TableHead>
              <TableHead className={styles.adminJobsTableHeaderTh}>
                Job Type
              </TableHead>
              <TableHead className={styles.adminJobsTableHeaderTh}>
                Location
              </TableHead>
              <TableHead className={styles.adminJobsTableHeaderTh}>
                Active Status
              </TableHead>
              <TableHead className={styles.adminJobsTableHeaderTh}>
                Public Status
              </TableHead>
              <TableHead className={styles.adminJobsTableHeaderTh}>
                Expires At
              </TableHead>
              <TableHead className={styles.adminJobsTableHeaderTh}></TableHead>
            </TableRow>
          </TableHeader>

          <TableBody>
            {jobs.map((job) => (
              <AdminJobRow
                key={job.id}
                job={job}
                onDelete={async (job) => {
                  if (!window.confirm("Delete this job?")) return;
                  if (!job) return;
                  await deleteJob(job.id);
                  router.refresh();
                }}
              />
            ))}
          </TableBody>
        </Table>
      </div>
    </div>
  );
}
