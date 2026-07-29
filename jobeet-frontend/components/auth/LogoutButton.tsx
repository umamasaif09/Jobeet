"use client";

import { logout } from "@/services/auth";
import { useRouter } from "next/navigation";
import { Button } from "../ui/button";

export default function LogoutButton() {
  const router = useRouter();

  async function handleLogout() {
    try{
      await logout();
    } finally {
      router.replace("/auth/login");
    }
  }
  return (
    <Button onClick={handleLogout} variant={"ghost"}>
      Logout
    </Button>
  );
}