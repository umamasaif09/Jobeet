import { Category } from "@/types/category";
import { Button } from "../ui/button";
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
          <MoreVertical className="h-4 w-4" />
      </DropdownMenuTrigger>

      <DropdownMenuContent align="end">
        <DropdownMenuItem onClick={()=> onEdit(category)}>
          Edit
        </DropdownMenuItem>

        <DropdownMenuItem className="text-red-600" onClick={()=> onDelete(category)}>
          Delete
        </DropdownMenuItem>
      </DropdownMenuContent> 
    </DropdownMenu>
  </>
  );
}