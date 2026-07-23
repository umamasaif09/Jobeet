"use client";

import Header from "@/components/admin/Header";
import { getCurrentAdmin } from "@/services/auth";
import { redirect, useRouter } from "next/navigation";
import { useEffect, useState } from "react";

export default function AdminLayout({
  children,
}: {
  children: React.ReactNode;
}) {
  const router = useRouter();
  const [loading, setLoading] = useState(true);

  useEffect(()=> {
    async function checkAuth() {
      try {
        await getCurrentAdmin();
        setLoading(false);
      }
      catch{
        router.replace("/auth/login");
      }
    }
    checkAuth();
  }, [router]);

  if(loading) {
    return (
      <div>Loading...</div>
    );
  }

  return(
    <>
        <Header />

            <main className="flex-1">
            {children}
            </main>

    </>
  );
}