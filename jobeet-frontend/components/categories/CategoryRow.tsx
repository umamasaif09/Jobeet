import { Category } from "@/types/category";
import { TableCell, TableRow } from "../ui/table";
import CategoryAction from "./CategoryAction";


type Props = {
  category: Category;
  onEdit: (category: Category) => void;
  onDelete: (category: Category) =>void;
}

export default function CategoryRow({category, onEdit, onDelete}: Props){
  return(
    <TableRow>
      <TableCell className="text-center">
        {category.id}
      </TableCell>

      <TableCell>
        {category.name}
      </TableCell>

      <TableCell className="w-[80px] text-right">
        <CategoryAction
          category={category}
          onEdit={onEdit}
          onDelete={onDelete}
        />
      </TableCell>
    </TableRow>
  )
}