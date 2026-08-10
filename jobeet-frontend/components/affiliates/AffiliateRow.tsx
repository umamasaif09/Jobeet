import { Affiliate } from "@/types/affiliate";
import { TableRow, TableCell } from "../ui/table";
import AffiliateAction from "./AffiliateAction";
import styles from "./affiliates.module.css";

type Props = {
  affiliate: Affiliate;
  onDelete: (affiliate: Affiliate) => void;
  onStatus: (affiliate: Affiliate) => void;
};

export default function AffiliateRow({ affiliate, onDelete, onStatus }: Props) {
  return (
    <TableRow className={styles.affiliatesTableBodyTr}>
      <TableCell
        className={`${styles.affiliatesTableIdColumn} ${styles.affiliatesTableBodyTd}`}
      >
        {affiliate.id}
      </TableCell>

      <TableCell
        className={`${styles.affiliatesJobTitle} ${styles.affiliatesTableBodyTd}`}
      >
        {affiliate.name}
      </TableCell>

      <TableCell
        className={`${styles.affiliatesJobMeta} ${styles.affiliatesTableBodyTd}`}
      >
        {affiliate.email}
      </TableCell>

      <TableCell
        className={`${styles.affiliatesJobMeta} ${styles.affiliatesTableBodyTd}`}
      >
        {affiliate.site_url}
      </TableCell>

      <TableCell className={styles.adminJobsTableBodyTd}>
        <span
          className={
            affiliate.is_active == true
              ? styles.badgeActive
              : styles.badgeInactive
          }
        >
          {affiliate.is_active == true ? "Active" : "Inactive"}
        </span>
      </TableCell>

      <TableCell
        className={`${styles.affiliatesJobMeta} ${styles.affiliatesTableBodyTd}`}
      >
        {affiliate.token}
      </TableCell>

      <TableCell className={styles.rowMenu}>
        <AffiliateAction
          affiliate={affiliate}
          onDelete={onDelete}
          onStatus={onStatus}
        />
      </TableCell>
    </TableRow>
  );
}
