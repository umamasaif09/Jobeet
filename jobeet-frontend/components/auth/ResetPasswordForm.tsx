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
    <Card className="w-full max-w-md">
      <CardHeader>
        <CardTitle>Reset Password</CardTitle>
      </CardHeader>

      <CardContent>
        <form onSubmit={handleSubmit} className="space-y-4">
          <div className="space-y-2">
            <Label>New Passowrd</Label>
            <Input
              type="password"
              value={password}
              onChange={(e) => setPassword(e.target.value)}
              placeholder="Enter new password"
            />
          </div>

          <div className="space-y-2">
            <Label>Confirm Passowrd</Label>
            <Input
              type="password"
              value={confirmPassword}
              onChange={(e) => setConfirmPassword(e.target.value)}
              placeholder="Confirm new password"
            />
          </div>
          {message && (
            <p className="text-sm text-green-600">{message}</p>
          )}

          {error && (
            <p className="text-sm text-red-600">{error}</p>
          )}

          <Button
            type="submit"
            className="w-full"
            disabled={loading}
          >
           {loading ? "Updating..." : "Update Password"}
          </Button>
        </form>
      </CardContent>

    </Card>
  )
}