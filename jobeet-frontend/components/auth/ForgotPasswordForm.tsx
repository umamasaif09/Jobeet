"use client";

import React, { useState } from "react";
import { forgotPassword } from "@/services/auth";
import { Card, CardContent, CardDescription, CardFooter, CardHeader, CardTitle } from "../ui/card";
import { Input } from "@/components/ui/input";
import { Button } from "../ui/button";
import { Label } from "../ui/label";
import { toast } from "sonner";
import styles from "./auth.module.css";


export default function ForgotPasswordForm() {
  const [email, setEmail] =useState("");
  const [loading, setLoading] = useState(false);

  async function handleSubmit(e: React.FormEvent<HTMLFormElement>) {
    e.preventDefault();

    setLoading(true);

    try{
      const response = await forgotPassword(email);
      toast.message(response.message);
    } catch (error:any) {
      toast.error(error.response?.data?.message ?? "Unable to send reset email");
    } finally {
      setLoading(false);
    }
  }

  return (
    <div className="flex min-h-screen justify-center items-center">
    
        <form onSubmit={handleSubmit} id="forgot-form" className={styles.authForm}>
          <h2 className={styles.authFormH2}>Reset Password</h2>
            <div className={styles.formGroup}>
              <Label htmlFor="email" className={styles.formGroupLabel}>Email</Label>
              <Input
                id="email"
                type="email"
                placeholder="Enter your email"
                value={email}
                onChange={(e) => setEmail(e.target.value)}
                className={styles.authFormInput}
                required
              />
            </div>

            <Button
            type="submit"
            disabled = {loading}
            form="forgot-form"
            className={styles.authFormButton}
          >
            {loading
              ? "Sending..."
              : "Send Password Reset Link"}
          </Button>
        </form>
    </div>
  );
}