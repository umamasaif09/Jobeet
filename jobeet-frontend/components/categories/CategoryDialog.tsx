import { Category } from "@/types/category";
import { useEffect, useState } from "react";
import {
  Dialog,
  DialogContent,
  DialogFooter,
  DialogHeader,
  DialogTitle,
} from "../ui/dialog";
import { Label } from "../ui/label";
import { Input } from "../ui/input";
import { Button } from "../ui/button";
import { createCategory, updateCategory } from "@/services/categories";
import styles from "./categories.module.css";

interface Props {
  open: boolean;
  onOpenChange: (open: boolean) => void;
  onSuccess: () => void;
  category: Category | null;
}

export default function CategoryDialog({
  open,
  onOpenChange,
  category,
  onSuccess,
}: Props) {
  const [name, setName] = useState("");

  useEffect(() => {
    if (category) {
      setName(category.name);
    } else {
      setName("");
    }
  }, [category]);

  async function handleSubmit() {
    const data = { category_name: name };

    if (category) {
      await updateCategory(category.id, data);
    } else {
      await createCategory(data);
    }
    onSuccess();
    onOpenChange(false);
  }
  return (
    <>
      <Dialog open={open} onOpenChange={onOpenChange}>
        <DialogContent className={styles.dialogContent}>
          <div className={styles.dialogHeader}>
            <div className={styles.dialogHeaderH2}>
              {category ? "Edit Category" : "Create Category"}
            </div>
          </div>
          <div className={styles.dialogBody}>
            <form
              onSubmit={handleSubmit}
              id="category-form"
              className={styles.dialogForm}
            >
              <div className={styles.formGroup}>
                <Label className={styles.formGroupLabel}>Category Name</Label>

                <Input
                  value={name}
                  onChange={(e) => setName(e.target.value)}
                  className={styles.formGroupInput}
                  placeholder="Enter category name"
                  required
                />
              </div>

              <Button
                className={styles.dialogButton}
                type="submit"
                form="category-form"
              >
                {category ? "Update" : "Create"}
              </Button>
            </form>
          </div>
        </DialogContent>
      </Dialog>
    </>
  );
}
