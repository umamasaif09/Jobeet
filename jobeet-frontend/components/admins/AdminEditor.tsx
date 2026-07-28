"use client";

import { createAdmin } from "@/services/admins";
import { AdminFormData } from "@/types/admin-form-data";
import { AdminRegisterData } from "@/types/register-admin-data";
import { useState } from "react";
import AdminForm from "./AdminForm";

export default function AdminEditor() {
  const [admin, setAdmin] = useState<AdminFormData>({
    name: "",
    email: "",
    password: "",
    confirmPassword: ""
  });
  const [error, setError] = useState("");

  function updateField<K extends keyof AdminFormData>(field: K, value: AdminFormData[K]) {
    
    setAdmin(previous=> {
      if(!previous) return previous;

      return { ...previous,
      [field]: value,};
      
      
    });
  }

  async function hanleSubmit(){

    if(admin.password !== admin.confirmPassword) {
      setError("Passwords do not match");
      return;
    }

    const data: AdminRegisterData= {
      admin_name: admin.name,
      admin_email: admin.email,
      admin_password: admin.password
    }

    await createAdmin(data);
  }

  return(
    <AdminForm 
      admin= {admin}
      onSubmit={hanleSubmit}
      updateField= {updateField}
    />
  )
}