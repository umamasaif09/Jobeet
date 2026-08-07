"use client";

import React, { useState } from "react";
import { resetPassword } from "@/services/auth";
import { Input } from "@/components/ui/input";
import { Button } from "../ui/button";
import { Label } from "../ui/label";
import { useRouter } from "next/navigation";
import { useSearchParams } from "next/navigation";
import { toast } from "sonner";
import styles from "./auth.module.css";


export default function ResetPasswordForm() {
  const router = useRouter();

  const searchParams = useSearchParams();
  const token = searchParams.get("token");

  const [password, setPassword] =useState("");
  const [confirmPassword, setConfirmPassword] = useState("");
  const [loading, setLoading] = useState(false);

  async function handleSubmit(e: React.FormEvent<HTMLFormElement>) {
    e.preventDefault();

    if(!token) {
      toast.error("Invalid reset link.");
      return;

    }

    if(password != confirmPassword) {
      toast.error("Passwords do not match.")
      return;
    }

    setLoading(true);

    try{
      const response = await resetPassword({token, password});
      toast.message(response.message);

      setTimeout(()=> {
        router.replace("/auth/login");
      }, 1500)
    } catch (error:any) {
      toast.error(
        error.response?.data?.message ?? "Unable to reset password."
      );
    } finally {
      setLoading(false);
    }
  }

  return (

    <div className="flex min-h-screen justify-center items-center">
    
        <form onSubmit={handleSubmit} id="reset-form" className={styles.authForm}>
          <h2 className={styles.authFormH2}>Reset Password</h2>
          
            <div className={styles.formGroup}>
              <Label htmlFor="password" className={styles.formGroupLabel}>New Password</Label>
              <Input
                id="password"
                type="password"
                placeholder="Enter new password"
                value={password}
                onChange={(e) => setPassword(e.target.value)}
                className={styles.authFormInput}
                required
              />
            </div>
            <div className={styles.formGroup}>
                <Label htmlFor="confirm-password" className={styles.formGroupLabel}>Confirm Password</Label>
                <Input id="confirm-password" type="password" required value={confirmPassword}
                onChange={(e) => setConfirmPassword(e.target.value)}
                placeholder="Confirm new password"
                className={styles.authFormInput}
                />
                
              </div>
         

          <Button
            type="submit"
            disabled={loading}
            className={styles.authFormButton}
            form="reset-form"
          >
           {loading ? "Updating..." : "Update Password"}
          </Button>
        </form>
    </div>
  )
}