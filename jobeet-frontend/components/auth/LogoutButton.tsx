"use client";

import { logout } from "@/services/auth";
import { useRouter } from "next/navigation";
import { Button } from "../ui/button";
import navStyles from "@/components/admin/layout.module.css";
import styles from "./auth.module.css";

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
    <button onClick={handleLogout} className={`${navStyles.navItem} cursor-pointer`}>
      Logout
    </button>
  );
}