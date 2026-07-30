"use client";

import { Job } from "@/types/job";
import { DropdownMenu, DropdownMenuContent, DropdownMenuItem, DropdownMenuTrigger } from "../ui/dropdown-menu";
import { MoreVertical } from "lucide-react";
import { useRouter } from "next/navigation";


type Props = {
  job: Job;
  onDelete: (job: Job) =>void;
}

export default function JobAction({job, onDelete}: Props) {
  const router= useRouter();
  return(
  <>
    <DropdownMenu>
      <DropdownMenuTrigger>
          <MoreVertical className="cursor-pointer"/>
      </DropdownMenuTrigger>
    
      <DropdownMenuContent>
        <DropdownMenuItem
          onClick={()=> router.push(`/admin/jobs/${job.id}`)}
        >
          View
        </DropdownMenuItem>

        <DropdownMenuItem
          onClick={()=> router.push(`/admin/jobs/edit/${job.id}`)}
        >
          Edit
        </DropdownMenuItem>

        <DropdownMenuItem onClick={()=> onDelete(job)}>
          Delete
        </DropdownMenuItem>
      </DropdownMenuContent> 
    </DropdownMenu>
  </>
  );
}