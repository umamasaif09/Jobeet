import { Admin } from "@/types/admin";
import { TableCell, TableRow } from "../ui/table";
import { Badge } from "../ui/badge";
import AdminAction from "./AdminAction";
import styles from "./admins.module.css";

type Props = {
  admin: Admin;
  onEdit: (admin: Admin) => void;
  onDelete: (admin: Admin) => void;
  onStatus: (admin: Admin) => void;
}

export default function AdminRow({admin, onEdit, onDelete, onStatus}: Props) {
  return (
    <TableRow className={styles.adminsTableBodyTr}>
      <TableCell  className={`${styles.adminsTableIdColumn} ${styles.adminsTableBodyTd}`}>
        {admin.id}
      </TableCell>

      <TableCell className={`${styles.adminsJobTitle} ${styles.adminsTableBodyTd}`}>
        {admin.name}
      </TableCell>

      <TableCell className={`${styles.adminsJobMeta} ${styles.adminsTableBodyTd}`}>
        {admin.email}
      </TableCell>

      <TableCell className={styles.adminsTableBodyTd}>
          <span className={admin.is_active == true ? styles.badgeActive : styles.badgeInactive}>{admin.is_active == true? "Acive" : "Inactive"}</span>
      </TableCell>

      <TableCell className={`${styles.expiryDate} ${styles.adminsTableBodyTd}`}>
        {new Date(admin.created_at).toLocaleDateString("en-GB",{
          day: "2-digit",
          month: "short",
          year: "numeric"
        } )}
        
      </TableCell>

      <TableCell className={styles.rowMenu}>
        <AdminAction
          admin = {admin}
          onEdit = {onEdit}
          onDelete = {onDelete}
          onStatus = {onStatus}
        />
      </TableCell>

    </TableRow>
  )
}