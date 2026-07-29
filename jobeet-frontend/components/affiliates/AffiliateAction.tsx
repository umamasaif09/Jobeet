"use client";

import { Affiliate } from "@/types/affiliate"
import { MoreVertical } from "lucide-react";
import { useRouter } from "next/navigation";
import { DropdownMenu, DropdownMenuTrigger, DropdownMenuItem, DropdownMenuContent } from "../ui/dropdown-menu";


type Props = {
  affiliate: Affiliate;
  onDelete: (affiliate: Affiliate)=> void;
  onStatus: (affiliate: Affiliate) => void;

}
export default function AffiliateAction({affiliate, onDelete, onStatus}: Props) {
  const router = useRouter();
  return (
    <>
    <DropdownMenu>
      <DropdownMenuTrigger>
          <MoreVertical className="cursor-pointer" />
      </DropdownMenuTrigger>

      <DropdownMenuContent>
        <DropdownMenuItem
          onClick={()=> router.push(`/admin/affiliates/edit/${affiliate.id}`)}
        >
          Edit
        </DropdownMenuItem>

        <DropdownMenuItem onClick= {()=> onStatus(affiliate)}>
          {affiliate.is_active == true? "Disable" : "Activate"}
        </DropdownMenuItem>

        <DropdownMenuItem onClick={()=> onDelete(affiliate)}>
          Delete
        </DropdownMenuItem>

      </DropdownMenuContent> 
    </DropdownMenu>
  </>
  )
}