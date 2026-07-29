"use client";

import { Admin } from "@/types/admin";
import Link from "next/link";
import { Button } from "../ui/button";
import { Table, TableBody, TableHead, TableHeader, TableRow } from "../ui/table";
import { useState } from "react";
import { useRouter } from "next/navigation";
import AdminRow from "./AdminRow";
import EditAdminDialog from "./EditAdminDialog";
import DeleteAdminDialog from "./DeleteAdminDialog";
import AdminStatusDialog from "./AdminStatusDialog";


type Props = {
  admins: Admin[];
}

export default function AdminTable({admins}: Props) {

  const [selectedAdmin, setSelectedAdmin] = useState<Admin | null>(null);
  const [deleteDialogOpen, setDeleteDialogOpen] = useState(false);
  const [statusDialogOpen, setStatusDialogOpen] = useState(false);
  const [editDialogOpen, setEditDialogOpen] = useState(false);
  const router = useRouter();

  return (
    <div className="space-y-6">
      <div className="flex justify-between items-center">
        <h1 className="font-heading text-xl font-semibold tracking-tight primary-text">
          Manage Admins
        </h1>
        <Link href={`/admin/admins/create`}>
          <Button>
            New Admin
          </Button>
        </Link>
    </div>  
    <div className="rounded-md border "> 
      <Table>
        <TableHeader>
          <TableRow>
              <TableHead className="w-[100px]">Admin ID</TableHead>
              <TableHead>Admin Name</TableHead>
              <TableHead>Admin Email</TableHead>
              <TableHead>Active Status</TableHead>
              <TableHead>Created At</TableHead>
              <TableHead className="w-[80px]"></TableHead>
          </TableRow>
        </TableHeader>

        <TableBody>
            
            {admins.map((admin) => (
                <AdminRow key={admin.id} admin={admin}

                onEdit = {(admin) => {
                  setSelectedAdmin(admin);
                  setEditDialogOpen(true);
                }}

                onDelete={(admin) => {
                  setSelectedAdmin(admin);
                  setDeleteDialogOpen(true);
                }}
                onStatus = {(admin) => {
                  setSelectedAdmin(admin);
                  setStatusDialogOpen(true);
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

        <DeleteAdminDialog
          open={deleteDialogOpen}
          onOpenChange={setDeleteDialogOpen}
          admin= {selectedAdmin}
          onSuccess= {()=> router.refresh()}
        />

        <AdminStatusDialog
          open = {statusDialogOpen}
          onOpenChange = {setStatusDialogOpen}
          admin = {selectedAdmin}
          onSuccess ={()=> router.refresh()}
        />
      </div>
  )
}