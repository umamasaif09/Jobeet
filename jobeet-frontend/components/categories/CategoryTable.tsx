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
    <div className="space-y-6">
      <div className="flex justify-between items-center">
        <h1 className="font-heading text-xl font-semibold tracking-tight primary-text">
          Manage Categories
        </h1>
          <Button onClick={()=> {
            setSelectedCategory(null);
            setCategoryDialogOpen(true);
          }}>
            New Category
        </Button>
      </div>
      
      <div className="rounded-md border ">
        <Table>
          <TableHeader>
            <TableRow>
              <TableHead className="w-[100px]">Category ID</TableHead>
              <TableHead>Category Name</TableHead>
              <TableHead className="w-[80px]"></TableHead>
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
      </div>
      

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
    </div>
  );
}