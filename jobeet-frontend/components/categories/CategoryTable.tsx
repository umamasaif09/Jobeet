"use client";

import CategoryRow from "@/components/categories/CategoryRow";
import { Table, TableBody, TableHead, TableHeader, TableRow } from "@/components/ui/table";
import { Category } from "@/types/category";
import { Button } from "../ui/button";
import { useState } from "react";
import CategoryDialog from "./CategoryDialog";
import DeleteCategoryDialog from "./DeleteCategoryDialog";
import { useRouter } from "next/navigation";


interface Props{

  categories: Category[];
}

export default function CategoryTable({categories}: Props) {
  const [selectedCategory, setSelectedCategory] = useState<Category | null>(null);

  const [categoryDialogOpen, setCategoryDialogOpen] = useState(false);
  const [deleteDialogOpen, setDeleteDialogOpen] = useState(false);

  const router= useRouter();

  if(categories.length === 0) {
    return (
      <p>
        No Categories Available.
      </p>
    );
  }
  return(
    <>
      <Button onClick={()=> {
        setSelectedCategory(null);
        setCategoryDialogOpen(true);
      }}>
        New Category
      </Button>
      
      <Table>
      <TableHeader>
        <TableRow>
          <TableHead>Category ID</TableHead>
          <TableHead>Category Name</TableHead>
          <TableHead></TableHead>
        </TableRow>
      </TableHeader>

      <TableBody>
        {categories.map((category) => (
          <CategoryRow key={category.id} category={category} 
            onEdit={(category) => {
              setSelectedCategory(category);
              setCategoryDialogOpen(true);
            }}
            onDelete={(category) => {
              setSelectedCategory(category);
              setDeleteDialogOpen(true);
            }}
          />
        ))}
      </TableBody>
    </Table>

    <CategoryDialog 
        open={categoryDialogOpen}
        onOpenChange={setCategoryDialogOpen}
        category={selectedCategory}
        onSuccess= {()=> router.refresh()}
      />

      <DeleteCategoryDialog
        open={deleteDialogOpen}
        onOpenChange={setDeleteDialogOpen}
        category={selectedCategory}
        onSuccess= {()=> router.refresh()}
      />
    </>
  );
}