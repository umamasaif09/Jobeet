import { Category } from "@/types/category";
import { TableCell, TableRow } from "../ui/table";
import CategoryAction from "./CategoryAction";
import styles from "./categories.module.css";

type Props = {
  category: Category;
  onEdit: (category: Category) => void;
  onDelete: (category: Category) => void;
};

export default function CategoryRow({ category, onEdit, onDelete }: Props) {
  return (
    <TableRow className={styles.categoryTableBodyTr}>
      <TableCell
        className={`${styles.categoryTableIdColumn} ${styles.categoryTableBodyTd}`}
      >
        {category.id}
      </TableCell>

      <TableCell className={styles.categoryTableBodyTd}>
        {category.name}
      </TableCell>

      <TableCell className={styles.rowMenu}>
        <CategoryAction
          category={category}
          onEdit={onEdit}
          onDelete={onDelete}
        />
      </TableCell>
    </TableRow>
  );
}
