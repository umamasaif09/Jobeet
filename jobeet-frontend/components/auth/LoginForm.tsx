"use client";

import { useState } from "react";
import { useRouter } from "next/navigation";
import {login} from "@/services/auth";
import { Card, CardContent } from "../ui/card";
import { Label } from "../ui/label";
import { Input } from "../ui/input";
import { Button } from "../ui/button";
import Link from "next/link";
import { toast } from "sonner";


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
    <Card>
      <CardContent>
        <form onSubmit={handleSubmit}>
          <div>
            <Label>Email</Label>
            <Input
                type="email"
                placeholder="Email"
                value={email}
                onChange={(e) => setEmail(e.target.value)}
            />
          </div>

          <div>
            <Label>Password</Label>
            <Input
                type="password"
                placeholder="Password"
                value={password}
                onChange={(e) => setPassword(e.target.value)}
            />
          </div>

          <div>
            <Link
                href="/auth/forgot-password"
            >
                Forgot password?
            </Link>
        </div>
          
          <Button type="submit">
            Login
          </Button>
        </form>
      </CardContent>
    </Card>
  );
}