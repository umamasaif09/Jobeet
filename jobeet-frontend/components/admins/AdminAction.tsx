"use client";

import { Admin } from "@/types/admin";
import { useRouter } from "next/navigation";
import { DropdownMenu, DropdownMenuContent, DropdownMenuItem, DropdownMenuTrigger } from "../ui/dropdown-menu";
import { MoreVertical } from "lucide-react";
import styles from "./admins.module.css";

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
      <DropdownMenuTrigger className={styles.menuToggle}>
        ⋮
      </DropdownMenuTrigger>

      <DropdownMenuContent>
        <DropdownMenuItem onClick={() => {onEdit(admin)}}
          className={styles.menuDropdownBtnWarning}
          >
          Edit
        </DropdownMenuItem>

        <DropdownMenuItem onClick={()=> {onStatus(admin)}}
          className={admin.is_active == true? styles.menuDropdownBtnWarning : styles.menuDropdownBtnSuccess}
          >
          {admin.is_active == true ? "Disable" : "Activate"}
        </DropdownMenuItem>

        <DropdownMenuItem onClick={() => onDelete(admin)}
          className={styles.menuDropdownBtnDanger}>
          Delete
        </DropdownMenuItem>
      </DropdownMenuContent>
    </DropdownMenu>
  )
}