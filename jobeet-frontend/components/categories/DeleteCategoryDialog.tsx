import { deleteCategory } from "@/services/categories";
import { Category } from "@/types/category";
import { AlertDialog, AlertDialogAction, AlertDialogCancel, AlertDialogContent, AlertDialogDescription, AlertDialogFooter, AlertDialogHeader, AlertDialogTitle } from "../ui/alert-dialog";
import { open } from "node:inspector/promises";

interface Props{
  open: boolean;
  onOpenChange: (open:boolean) => void;
  onSuccess: () => void;
  category: Category | null;
}

export default function DeleteCategoryDialog({open, onOpenChange,category, onSuccess}: Props) {
  async function handleDelete() {
    if(!category) return;

    await deleteCategory(category.id);
    onSuccess();
    onOpenChange(false);
  }

  return (
    <AlertDialog open = {open} onOpenChange={onOpenChange}>
      <AlertDialogContent>
        <AlertDialogHeader>
          <AlertDialogTitle>
            Delete Category
          </AlertDialogTitle>

          <AlertDialogDescription>
            Are you sure you want to delete{" "}
            <strong>{category?.name}</strong>?
            <br />
          </AlertDialogDescription>
        </AlertDialogHeader>

        <AlertDialogFooter>
          <AlertDialogCancel>
              Cancel
          </AlertDialogCancel>

          <AlertDialogAction onClick={handleDelete}>
            Delete
          </AlertDialogAction>
        </AlertDialogFooter>
        
      </AlertDialogContent>
    </AlertDialog>
  );
}