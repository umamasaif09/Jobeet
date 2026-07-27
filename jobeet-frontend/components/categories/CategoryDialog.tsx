import { Category } from "@/types/category";
import { useEffect, useState } from "react";
import { Dialog, DialogContent, DialogFooter, DialogHeader, DialogTitle } from "../ui/dialog";
import { Label } from "../ui/label";
import { Input } from "../ui/input";
import { Button } from "../ui/button";
import { createCategory, updateCategory } from "@/services/categories";

interface Props{
  open: boolean;
  onOpenChange: (open:boolean) => void;
  onSuccess: () => void;
  category: Category | null;
}

export default function CategoryDialog({open, onOpenChange, category, onSuccess}: Props) {
  const [name, setName] = useState("");
  
  useEffect(() => {
    if(category) {
      setName(category.name);
    }
    else {
      setName("");
    }
  }, [category]);

  async function handleSubmit() {

    const data = {category_name: name};

    if(category) {
      await updateCategory(category.id, data);
    } else {
      await createCategory(data);
    }
    onSuccess();
    onOpenChange(false);
  }
  return (
    <>
    <Dialog open = {open} onOpenChange={onOpenChange}>
      <DialogContent>
        <DialogHeader>
          <DialogTitle>
            {category ? "Edit Category" : "Create Category"}
          </DialogTitle>
        </DialogHeader>

        <div>
          <Label>Name</Label>

          <Input value={name} onChange = {(e) => setName(e.target.value)}/>

        </div>

        <DialogFooter>
          <Button variant = "outline"
            onClick={()=>onOpenChange(false)}>
            Cancel
          </Button>

          <Button
            onClick={handleSubmit}
          >
            {category? "Update" : "Create"}
          </Button>
        </DialogFooter>

      </DialogContent>
    </Dialog>
    </>
  );
}