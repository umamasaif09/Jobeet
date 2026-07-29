"use client";

import React, { useState } from "react";
import { forgotPassword } from "@/services/auth";
import { Card, CardContent, CardHeader, CardTitle } from "../ui/card";
import { Input } from "@base-ui/react";
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
    <Card>
      <CardHeader>
        <CardTitle>Forgot Password</CardTitle>
      </CardHeader>

      <CardContent>
        <form onSubmit={handleSubmit}>
          <div>
            <Label>Email</Label>
            <Input
              type="email"
              value={email}
              onChange={(e) => setEmail(e.target.value)}
              placeholder="Enter your email"
            />
          </div>

          <Button
            type="submit"
            disabled = {loading}
          >
            {loading
              ? "Sending..."
              : "Sent Reset Link"}
          </Button>
        </form>
      </CardContent>

    </Card>
  )
}