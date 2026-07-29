"use client";

import {Job} from "@/types/job";

import {Table, TableBody, TableHead, TableHeader, TableRow} from "@/components/ui/table";
import { useState } from "react";
import { useRouter } from "next/navigation";
import Link from "next/link";
import { Button } from "../ui/button";
import AdminJobRow from "./AdminJobRow";
import DeleteJobDialog from "./DeleteJobDialog";

interface JobTableProps{
    jobs: Job[];
}

export default function JobTable({jobs}: JobTableProps) {
    const [selectedJob, setSelectedJob] =useState<Job | null>(null);

    const [deleteDialogOpen, setDeleteDialogOpen] = useState(false);

    const router = useRouter();

    if(jobs.length === 0) {
      return(
         <p className="text-muted-foreground">
            No Jobs Available.
          </p>
      );
    }

    return(
      <div className="space-y-6">
        <div className="flex justify-between items-center">
          <h1 className="font-heading text-xl font-semibold tracking-tight primary-text">
            Manage Jobs
          </h1>

          <Link href={`/admin/jobs/create`}>
            <Button>
              New Job
            </Button>
        </Link>
        </div>
      
      <div className="rounded-md border ">
        <Table>
            <TableHeader>
                <TableRow>
                    <TableHead className="w-[100px]">Job ID</TableHead>
                    <TableHead>Position</TableHead>
                    <TableHead>Company Name</TableHead>
                    <TableHead>Job Type</TableHead>
                    <TableHead>Location</TableHead>
                    <TableHead>Active Status</TableHead>
                    <TableHead>Public Status</TableHead>
                    <TableHead>Created At</TableHead>
                    <TableHead className="w-[80px]"></TableHead>
                </TableRow>
            </TableHeader>

            <TableBody>
                
                {jobs.map((job) => (
                    <AdminJobRow key={job.id} job={job}
                    onDelete={(job) => {
                      setSelectedJob(job);
                      setDeleteDialogOpen(true);
                    }}/>
                ))}
            </TableBody>
        </Table>
      </div>
      

        <DeleteJobDialog
          open={deleteDialogOpen}
          onOpenChange={setDeleteDialogOpen}
          job= {selectedJob}
          onSuccess= {()=> router.refresh()}
        />
      </div>
    );
}