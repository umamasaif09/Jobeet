"use client";

import { Job } from "@/types/job";
import { DropdownMenu, DropdownMenuContent, DropdownMenuItem, DropdownMenuTrigger } from "../ui/dropdown-menu";
import { MoreVertical } from "lucide-react";
import Link from "next/link";
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
          <MoreVertical />
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

        <DropdownMenuItem className="text-red-600" onClick={()=> onDelete(job)}>
          Delete
        </DropdownMenuItem>
      </DropdownMenuContent> 
    </DropdownMenu>
  </>
  );
}