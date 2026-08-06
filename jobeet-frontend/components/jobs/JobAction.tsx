"use client";

import { Job } from "@/types/job";
import { DropdownMenu, DropdownMenuContent, DropdownMenuItem, DropdownMenuTrigger } from "../ui/dropdown-menu";
import { MoreVertical } from "lucide-react";
import { useRouter } from "next/navigation";
import styles from "./jobs.module.css";

type Props = {
  job: Job;
  onDelete: (job: Job) =>void;
}

export default function JobAction({job, onDelete}: Props) {
  const router= useRouter();
  return(
  <>
    <DropdownMenu>
      <DropdownMenuTrigger className={styles.menuToggle}>
        ⋮
      </DropdownMenuTrigger>
    
      <DropdownMenuContent>
        <DropdownMenuItem
          onClick={()=> router.push(`/admin/jobs/${job.id}`)}
          className={styles.menuDropdownBtnWarning}
        >
          View
        </DropdownMenuItem>

        <DropdownMenuItem
          onClick={()=> router.push(`/admin/jobs/edit/${job.id}`)}
          className={styles.menuDropdownBtnWarning}
        >
          Edit
        </DropdownMenuItem>

        <DropdownMenuItem onClick={() => {onDelete(job)}}
            className={styles.menuDropdownBtnDanger}
          >
          Delete
        </DropdownMenuItem>
      </DropdownMenuContent> 
    </DropdownMenu>
  </>
  );
}