"use client";

import React, { useState } from "react";
import { resetPassword } from "@/services/auth";
import { Card, CardContent, CardDescription, CardFooter, CardHeader, CardTitle } from "../ui/card";
import { Input } from "@/components/ui/input";
import { Button } from "../ui/button";
import { Label } from "../ui/label";
import { useRouter } from "next/navigation";
import { useSearchParams } from "next/navigation";
import { toast } from "sonner";


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
    <Card className="w-[300px] max-w-full">
      <CardHeader>
        <CardTitle>Reset Password</CardTitle>
        <CardDescription>
          Change your password to access your account
        </CardDescription>
      </CardHeader>
      <CardContent>
        <form onSubmit={handleSubmit} id="reset-form">
          <div className="flex flex-col gap-6">
            <div className="grid gap-2">
              <Label htmlFor="password">New Password</Label>
              <Input
                id="password"
                type="password"
                placeholder="Enter new password"
                value={password}
                onChange={(e) => setPassword(e.target.value)}
                required
              />
            </div>
            <div className="grid gap-2">
                <Label htmlFor="confirm-password">Confirm Password</Label>
                <Input id="confirm-password" type="password" required value={confirmPassword}
                onChange={(e) => setConfirmPassword(e.target.value)}
                placeholder="Confirm new password"/>
              </div>
          </div>
        </form>
      </CardContent>
      <CardFooter className="flex-col gap-2">
        <Button
            type="submit"
            disabled={loading}
            form="reset-form"
          >
           {loading ? "Updating..." : "Update Password"}
          </Button>
      </CardFooter>
    </Card>
    </div>
  )
}