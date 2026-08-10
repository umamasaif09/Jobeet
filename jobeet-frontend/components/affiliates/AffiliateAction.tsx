"use client";

import { Affiliate } from "@/types/affiliate";
import { useRouter } from "next/navigation";
import {
  DropdownMenu,
  DropdownMenuTrigger,
  DropdownMenuItem,
  DropdownMenuContent,
} from "../ui/dropdown-menu";
import styles from "./affiliates.module.css";

type Props = {
  affiliate: Affiliate;
  onDelete: (affiliate: Affiliate) => void;
  onStatus: (affiliate: Affiliate) => void;
};
export default function AffiliateAction({
  affiliate,
  onDelete,
  onStatus,
}: Props) {
  const router = useRouter();
  return (
    <>
      <DropdownMenu>
        <DropdownMenuTrigger className={styles.menuToggle}>
          ⋮
        </DropdownMenuTrigger>

        <DropdownMenuContent>
          <DropdownMenuItem
            onClick={() =>
              router.push(`/admin/affiliates/edit/${affiliate.id}`)
            }
            className={styles.menuDropdownBtnWarning}
          >
            Edit
          </DropdownMenuItem>

          <DropdownMenuItem
            onClick={() => onStatus(affiliate)}
            className={
              affiliate.is_active == true
                ? styles.menuDropdownBtnWarning
                : styles.menuDropdownBtnSuccess
            }
          >
            {affiliate.is_active == true ? "Disable" : "Activate"}
          </DropdownMenuItem>

          <DropdownMenuItem
            onClick={() => {
              onDelete(affiliate);
            }}
            className={styles.menuDropdownBtnDanger}
          >
            Delete
          </DropdownMenuItem>
        </DropdownMenuContent>
      </DropdownMenu>
    </>
  );
}
