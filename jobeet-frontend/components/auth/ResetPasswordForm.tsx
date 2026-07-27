"use client";

import React, { useState } from "react";
import { forgotPassword, resetPassword } from "@/services/auth";
import { Card, CardContent, CardHeader, CardTitle } from "../ui/card";
import { Input } from "@base-ui/react";
import { Button } from "../ui/button";
import { Label } from "../ui/label";
import { useRouter } from "next/navigation";
import { useSearchParams } from "next/navigation";


export default function ResetPasswordForm() {
  const router = useRouter();

  const searchParams = useSearchParams();
  const token = searchParams.get("token");

  const [password, setPassword] =useState("");
  const [confirmPassword, setConfirmPassword] = useState("");

  const [message, setMessage] =useState("");
  const [error, setError] = useState("");
  const [loading, setLoading] = useState(false);

  async function handleSubmit(e: React.FormEvent<HTMLFormElement>) {
    e.preventDefault();
    setError("");
    setMessage("");

    if(!token) {
      setError("Invalid reset link.");
      return;

    }

    if(password != confirmPassword) {
      setError("Passwords do not match.")
    }

    setLoading(true);

    try{
      const response = await resetPassword({token, password});
      setMessage(response.message);

      setTimeout(()=> {
        router.push("/auth/login");
      }, 1500)
    } catch (error:any) {
      setError(
        error.response?.data?.message ?? "Unable to reset password."
      );
    } finally {
      setLoading(false);
    }
  }

  return (
    <Card>
      <CardHeader>
        <CardTitle>Reset Password</CardTitle>
      </CardHeader>

      <CardContent>
        <form onSubmit={handleSubmit} >
          <div>
            <Label>New Passowrd</Label>
            <Input
              type="password"
              value={password}
              onChange={(e) => setPassword(e.target.value)}
              placeholder="Enter new password"
            />
          </div>

          <div>
            <Label>Confirm Passowrd</Label>
            <Input
              type="password"
              value={confirmPassword}
              onChange={(e) => setConfirmPassword(e.target.value)}
              placeholder="Confirm new password"
            />
          </div>
          {message && (
            <p>{message}</p>
          )}

          {error && (
            <p>{error}</p>
          )}

          <Button
            type="submit"
            disabled={loading}
          >
           {loading ? "Updating..." : "Update Password"}
          </Button>
        </form>
      </CardContent>

    </Card>
  )
}