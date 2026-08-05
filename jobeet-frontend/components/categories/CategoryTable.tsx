"use client";

import CategoryRow from "@/components/categories/CategoryRow";
import { Table, TableBody, TableHead, TableHeader, TableRow } from "@/components/ui/table";
import { Category } from "@/types/category";
import { Button } from "../ui/button";
import { useState } from "react";
import CategoryDialog from "./CategoryDialog";
import DeleteCategoryDialog from "./DeleteCategoryDialog";
import { useRouter } from "next/navigation";
import pageStyles from "@/app/styles/jobeet.module.css";
import styles from "./categories.module.css";


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
    <div className="space-y-6 my-[24px]">
      <div className="flex justify-between items-center">
        <h1 className={pageStyles.pageTitle}>
          Manage Categories
        </h1>
          <Button onClick={()=> {
            setSelectedCategory(null);
            setCategoryDialogOpen(true);
          }}
          className={styles.categoryButton}>
            New Category
        </Button>
      </div>
      
      <div className={styles.categoryTableCard}>
        <Table className={styles.categoryTable}>
          <TableHeader>
            <TableRow>
              <TableHead className={styles.categoryTableHeaderTh}>Category ID</TableHead>
              <TableHead className={styles.categoryTableHeaderTh}>Category Name</TableHead>
              <TableHead className={styles.categoryTableHeaderTh}></TableHead>
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