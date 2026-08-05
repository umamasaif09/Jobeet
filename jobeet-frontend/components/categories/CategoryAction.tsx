import { Category } from "@/types/category";
import { DropdownMenu, DropdownMenuContent, DropdownMenuItem, DropdownMenuTrigger, } from "../ui/dropdown-menu";
import { MoreVertical } from "lucide-react";
import styles from "./categories.module.css";

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
          <MoreVertical className="cursor-pointer"/>
      </DropdownMenuTrigger>

      <DropdownMenuContent>
        <DropdownMenuItem onClick={()=> onEdit(category)}
          className={styles.menuDropdownBtnWarning}
          >
          Edit
        </DropdownMenuItem>

        <DropdownMenuItem
          className={styles.menuDropdownBtnDanger}
          onClick={() => {
            if (window.confirm("Delete this category?")) {
              onDelete(category);
            }
          }}
          >
          Delete
        </DropdownMenuItem>
      </DropdownMenuContent> 
    </DropdownMenu>
  </>
  );
}