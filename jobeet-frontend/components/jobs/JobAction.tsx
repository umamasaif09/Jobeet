"use client";

import { Job } from "@/types/job";
import { DropdownMenu, DropdownMenuContent, DropdownMenuItem, DropdownMenuTrigger } from "../ui/dropdown-menu";
import { MoreVertical } from "lucide-react";
import Link from "next/link";
import { useRouter } from "next/navigation";


interface Props{
  job: Job;
  onDelete: (job: Job) =>void;
}

export default function JobAction({job, onDelete}: Props) {
  const router= useRouter();
  return(
  <>
    <DropdownMenu>
      <DropdownMenuTrigger>
          <MoreVertical className="h-4 w-4" />
      </DropdownMenuTrigger>
    
      <DropdownMenuContent align="end">
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

        <DropdownMenuItem className="text-red-600" onClick={()=> onDelete(job)}>
          Delete
        </DropdownMenuItem>
      </DropdownMenuContent> 
    </DropdownMenu>
  </>
  );
}