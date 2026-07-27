import { Category } from "@/types/category";
import { DropdownMenu, DropdownMenuContent, DropdownMenuItem, DropdownMenuTrigger, } from "../ui/dropdown-menu";
import { MoreVertical } from "lucide-react";

interface Props{
  category: Category;

  onEdit: (category: Category) => void;
  onDelete: (category: Category) =>void;
}

export default function CategoryAction({category, onEdit, onDelete}: Props) {
  return(
  <>
    <DropdownMenu>
      <DropdownMenuTrigger>
          <MoreVertical />
      </DropdownMenuTrigger>

      <DropdownMenuContent>
        <DropdownMenuItem onClick={()=> onEdit(category)}>
          Edit
        </DropdownMenuItem>

        <DropdownMenuItem onClick={()=> onDelete(category)}>
          Delete
        </DropdownMenuItem>
      </DropdownMenuContent> 
    </DropdownMenu>
  </>
  );
}