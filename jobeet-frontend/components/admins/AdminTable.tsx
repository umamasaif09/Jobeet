"use client";

import { Admin } from "@/types/admin";
import Link from "next/link";
import { Button } from "../ui/button";
import { Table, TableBody, TableHead, TableHeader, TableRow } from "../ui/table";
import { useState } from "react";
import { useRouter } from "next/navigation";
import AdminRow from "./AdminRow";
import EditAdminDialog from "./EditAdminDialog";
import pageStyles from "@/app/styles/jobeet.module.css";
import styles from "./admins.module.css";
import { activateAdmin, deleteAdmin, disableAdmin } from "@/services/admins";


type Props = {
  admins: Admin[];
}

export default function AdminTable({admins}: Props) {

  const [selectedAdmin, setSelectedAdmin] = useState<Admin | null>(null);
  const [editDialogOpen, setEditDialogOpen] = useState(false);
  const router = useRouter();

  return (
    <div className="space-y-6 my-[24px]">
      <div className="flex justify-between items-center">
        <h1  className={pageStyles.pageTitle}>
          Manage Admins
        </h1>
        <Link href={`/admin/admins/create`}>
          <Button className={styles.adminButton}>
            New Admin
          </Button>
        </Link>
    </div>  
    <div className={styles.adminsTableCard}> 
      <Table className={styles.adminsTable}>
        <TableHeader>
          <TableRow>
              <TableHead className={styles.adminsTableHeaderTh}>Admin ID</TableHead>
              <TableHead className={styles.adminsTableHeaderTh}>Admin Name</TableHead>
              <TableHead className={styles.adminsTableHeaderTh}>Admin Email</TableHead>
              <TableHead className={styles.adminsTableHeaderTh}>Active Status</TableHead>
              <TableHead className={styles.adminsTableHeaderTh}>Created At</TableHead>
              <TableHead className={styles.adminsTableHeaderTh}></TableHead>
          </TableRow>
        </TableHeader>

        <TableBody>
            
            {admins.map((admin) => (
                <AdminRow key={admin.id} admin={admin}

                onEdit = {(admin) => {
                  setSelectedAdmin(admin);
                  setEditDialogOpen(true);
                }}

                onDelete={async (admin) => {
                  const confirmed = window.confirm("Delete this admin?");
                  if(!confirmed) return;
                  await deleteAdmin(admin.id.toString());
                  router.refresh();
                }}
                onStatus = {async (admin) => {
                  if(!admin) return;
                  
                  if(admin.is_active== true) {
                    await disableAdmin(admin.id.toString());
                  }
                  else {
                    await activateAdmin(admin.id.toString());
                  }

                  router.refresh();
                }}/>
            ))}
        </TableBody>
      </Table>
    </div>
      

        <EditAdminDialog
          open= {editDialogOpen}
          onOpenChange = {setEditDialogOpen}
          admin= {selectedAdmin}
          onSuccess = {()=> router.refresh()}
        />
      </div>
  )
}