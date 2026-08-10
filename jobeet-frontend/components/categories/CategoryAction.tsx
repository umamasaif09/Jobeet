import { Category } from "@/types/category";
import {
  DropdownMenu,
  DropdownMenuContent,
  DropdownMenuItem,
  DropdownMenuTrigger,
} from "../ui/dropdown-menu";
import styles from "./categories.module.css";

interface Props {
  category: Category;

  onEdit: (category: Category) => void;
  onDelete: (category: Category) => void;
}

export default function CategoryAction({ category, onEdit, onDelete }: Props) {
  return (
    <>
      <DropdownMenu>
        <DropdownMenuTrigger className={styles.menuToggle}>
          ⋮
        </DropdownMenuTrigger>

        <DropdownMenuContent>
          <DropdownMenuItem
            onClick={() => onEdit(category)}
            className={styles.menuDropdownBtnWarning}
          >
            Edit
          </DropdownMenuItem>

          <DropdownMenuItem
            className={styles.menuDropdownBtnDanger}
            onClick={() => {
              onDelete(category);
            }}
          >
            Delete
          </DropdownMenuItem>
        </DropdownMenuContent>
      </DropdownMenu>
    </>
  );
}
