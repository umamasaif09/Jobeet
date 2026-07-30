"use client";

import React, { useState } from "react";
import { forgotPassword } from "@/services/auth";
import { Card, CardContent, CardDescription, CardFooter, CardHeader, CardTitle } from "../ui/card";
import { Input } from "@/components/ui/input";
import { Button } from "../ui/button";
import { Label } from "../ui/label";
import { toast } from "sonner";


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
    <Card className="w-[300px] max-w-full">
      <CardHeader>
        <CardTitle>Forgot Password</CardTitle>
        <CardDescription>
          Enter your email below to get password reset email
        </CardDescription>
      </CardHeader>
      <CardContent>
        <form onSubmit={handleSubmit} id="forgot-form">
          
            <div className="grid gap-2">
              <Label htmlFor="email">Email</Label>
              <Input
                id="email"
                type="email"
                placeholder="m@example.com"
                value={email}
                onChange={(e) => setEmail(e.target.value)}
                required
              />
            </div>
        </form>
      </CardContent>
      <CardFooter className="flex-col gap-2">
        <Button
            type="submit"
            disabled = {loading}
            form="forgot-form"
          >
            {loading
              ? "Sending..."
              : "Send Reset Link"}
          </Button>
      </CardFooter>
    </Card>
    </div>
  );
}