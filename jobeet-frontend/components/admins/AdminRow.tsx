import { Admin } from "@/types/admin";
import { TableCell, TableRow } from "../ui/table";
import { Badge } from "../ui/badge";
import AdminAction from "./AdminAction";


type Props = {
  admin: Admin;
  onEdit: (admin: Admin) => void;
  onDelete: (admin: Admin) => void;
  onStatus: (admin: Admin) => void;
}

export default function AdminRow({admin, onEdit, onDelete, onStatus}: Props) {
  return (
    <TableRow>
      <TableCell>
        {admin.id}
      </TableCell>

      <TableCell>
        {admin.name}
      </TableCell>

      <TableCell>
        {admin.email}
      </TableCell>

      <TableCell>
        <Badge
          variant= {admin.is_active == true? "default" : "secondary"}
        >
          {admin.is_active == true? "Acive" : "Inactive"}
        </Badge>
      </TableCell>

      <TableCell>
        {admin.created_at}
      </TableCell>

      <TableCell>
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