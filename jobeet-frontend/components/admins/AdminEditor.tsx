"use client";

import { createAdmin } from "@/services/admins";
import { AdminFormData } from "@/types/admin-form-data";
import { AdminRegisterData } from "@/types/register-admin-data";
import { useState } from "react";
import AdminForm from "./AdminForm";
import { useRouter } from "next/navigation";
import { toast } from "sonner";


export default function AdminEditor() {
  const [admin, setAdmin] = useState<AdminFormData>({
    name: "",
    email: "",
    password: "",
    confirmPassword: ""
  });
  const [error, setError] = useState("");
  const router = useRouter();

  function updateField<K extends keyof AdminFormData>(field: K, value: AdminFormData[K]) {
    
    setAdmin(previous=> {
      if(!previous) return previous;

      return { ...previous,
      [field]: value,};
      
      
    });
  }

  async function hanleSubmit(){

    if(admin.password !== admin.confirmPassword) {
      toast.error("Passwords do not match")
      return;
    }

    const data: AdminRegisterData= {
      admin_name: admin.name,
      admin_email: admin.email,
      admin_password: admin.password
    }

    await createAdmin(data);
    toast.success("Admin regsitered")
    router.replace("/admin/admins");
  }

  return(
    <AdminForm 
      admin= {admin}
      onSubmit={hanleSubmit}
      updateField= {updateField}
    />
  )
}