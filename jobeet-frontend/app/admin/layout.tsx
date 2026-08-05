"use client";

import Header from "@/components/admin/Header";
import Container from "@/components/ui/Container";
import { getCurrentAdmin } from "@/services/auth";
import { redirect, useRouter } from "next/navigation";
import { useEffect, useState } from "react";
import { Toaster } from "sonner";

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
        return;
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
    <div className="min-h-screen flex flex-col">
        <Header />
        <Toaster />
            <main className="flex-1 text-[#333]">
              <Container>
                {children}
              </Container>
            </main>

    </div>
  );
}