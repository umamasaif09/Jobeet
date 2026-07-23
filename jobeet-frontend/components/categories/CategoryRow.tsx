import { Category } from "@/types/category";
import { TableCell, TableRow } from "../ui/table";
import CategoryAction from "./CategoryAction";


interface Props {
  category: Category;
  onEdit: (category: Category) => void;
  onDelete: (category: Category) =>void;
}

export default function CategoryRow({category, onEdit, onDelete}: Props){
  return(
    <TableRow className="hover:bg-muted/50">
      <TableCell>
        {category.id}
      </TableCell>

      <TableCell>
        {category.name}
      </TableCell>

      <TableCell className="w-0 text-right">
        <CategoryAction
          category={category}
          onEdit={onEdit}
          onDelete={onDelete}
        />
      </TableCell>
    </TableRow>
  )
}