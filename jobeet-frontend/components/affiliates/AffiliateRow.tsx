import { Affiliate } from "@/types/affiliate"
import { Badge } from "@/components/ui/badge";
import { TableRow, TableCell } from "../ui/table";
import AffiliateAction from "./AffiliateAction";


type Props = {
  affiliate: Affiliate;
  onDelete: (affiliate: Affiliate) => void;
  onStatus: (affiliate: Affiliate) => void;
}

export default function AffiliateRow({affiliate, onDelete, onStatus} : Props) {
 return (
  <TableRow>
    <TableCell>
        {affiliate.id}
    </TableCell>

    <TableCell>
        {affiliate.name}
    </TableCell>

    <TableCell>
        {affiliate.email}
    </TableCell>

    <TableCell>
        {affiliate.site_url}
    </TableCell>

    <TableCell>
      <Badge
        variant={affiliate.is_active == true ? "default": "secondary"}
      >
        {affiliate.is_active == true ? "Active" : "Inactive"}
      </Badge>
        
    </TableCell>

    <TableCell>
        {affiliate.token}
    </TableCell>

    <TableCell>
      <AffiliateAction
        affiliate={affiliate}
        onDelete ={onDelete}
        onStatus = {onStatus}
      />
    </TableCell>
</TableRow>
 ) 
}