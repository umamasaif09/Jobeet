"use client";

import { Admin } from "@/types/admin";
import { useRouter } from "next/navigation";
import { DropdownMenu, DropdownMenuContent, DropdownMenuItem, DropdownMenuTrigger } from "../ui/dropdown-menu";
import { MoreVertical } from "lucide-react";


type Props = {
  admin: Admin;
  onEdit: (admin: Admin) => void;
  onDelete: (admin: Admin) => void;
  onStatus: (admin: Admin) => void;
}

export default function AdminAction({admin, onEdit, onDelete, onStatus}: Props) {
  const router = useRouter();

  return(
    <DropdownMenu>
      <DropdownMenuTrigger>
        <MoreVertical />
      </DropdownMenuTrigger>

      <DropdownMenuContent>
        <DropdownMenuItem onClick={() => {onEdit(admin)}}>
          Edit
        </DropdownMenuItem>

        <DropdownMenuItem onClick={()=> {onStatus(admin)}}>
          {admin.is_active == true ? "Disable" : "Activate"}
        </DropdownMenuItem>

        <DropdownMenuItem onClick={() => {onDelete(admin)}}>
          Delete
        </DropdownMenuItem>
      </DropdownMenuContent>
    </DropdownMenu>
  )
}