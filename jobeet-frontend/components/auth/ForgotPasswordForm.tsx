"use client";

import React, { useState } from "react";
import { forgotPassword } from "@/services/auth";
import { Card, CardContent, CardHeader, CardTitle } from "../ui/card";
import { Input } from "@base-ui/react";
import { Button } from "../ui/button";
import { Label } from "../ui/label";


export default function ForgotPasswordForm() {
  const [email, setEmail] =useState("");
  const [message, setMessage] =useState("");
  const [error, setError] = useState("");
  const [loading, setLoading] = useState(false);

  async function handleSubmit(e: React.FormEvent<HTMLFormElement>) {
    e.preventDefault();

    setLoading(true);
    setError("");
    setMessage("");

    try{
      const response = await forgotPassword(email);
      setMessage(response.message);
      console.log(response.message);
    } catch (error:any) {
      setError(
        error.response?.data?.message ?? "Unable to send reset email."
      );
    } finally {
      setLoading(false);
    }
  }

  return (
    <Card className="w-full max-w-md">
      <CardHeader>
        <CardTitle>Forgot Password</CardTitle>
      </CardHeader>

      <CardContent>
        <form onSubmit={handleSubmit} className="space-y-4">
          <div className="space-y-2">
            <Label>Email</Label>
            <Input
              type="email"
              value={email}
              onChange={(e) => setEmail(e.target.value)}
              placeholder="Enter your email"
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