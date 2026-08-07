"use client";

import { useState } from "react";
import { useRouter } from "next/navigation";
import {login} from "@/services/auth";
import { Label } from "../ui/label";
import { Input } from "../ui/input";
import { Button } from "../ui/button";
import { toast } from "sonner";
import styles from "./auth.module.css";


export default function LoginForm() {
  const router = useRouter();

  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");


  async function handleSubmit(e: React.FormEvent<HTMLFormElement>) {
    e.preventDefault();

    try{
      await login({
        email, password,
      });

      router.push("/admin");
    } catch(error:any) {

        toast.error(error.response?.data?.message ?? "Something went wrong.");

    }
  }
  return (
    <div className="flex min-h-screen justify-center items-center">
    
        <form onSubmit={handleSubmit} id="login-form" className={styles.authForm}>
          <h2 className={styles.authFormH2}>Administrator Login</h2>
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
            <div className={styles.formGroup}>
                <Label htmlFor="password" className={styles.formGroupLabel}>Password</Label>
                <Input id="password" type="password" required value={password}
                onChange={(e) => setPassword(e.target.value)}
                placeholder="Enter your password"
                className={styles.authFormInput}
                />
              </div>
                <a
                  href="/auth/forgot-password"
                  className={styles.authFormLink}
                >
                  Forgot your password?
                </a>

                 <Button type="submit" className={styles.authFormButton} form="login-form">
                  Login
                </Button>
        </form>
    </div>
    
  );
}