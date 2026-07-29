"use client";

import StatCard from "@/components/admin/StatCard";
import { getDashboardStats } from "@/services/admins";
import { useEffect, useState } from "react";

type DashboardStats = {
  categories: number;
  jobs:number;
  affiliates:number;
  admins:number;
}

export default function HomePage() {
  const [stats, setStats] = useState<DashboardStats | null>(null);
 
  useEffect(()=> {
    async function load() {
      const data= await getDashboardStats();
      setStats(data);
    }
    load();
  }, []);

  if(!stats) {
    return (
      <div>Loading...</div>
    )
  }

  return (
    <div className="space-y-6">
       <h1 className="font-heading text-xl font-semibold tracking-tight primary-text">
        Dashboard
      </h1>

      <div className="grid gap-4 md:grid-cols-2 lg:grid-cols-4">
        <StatCard
          title="Categories"
          value={stats.categories}
        />

        <StatCard
          title="Jobs"
          value={stats.jobs}
        />

        <StatCard
          title="Affiliates"
          value={stats.affiliates}
        />

        <StatCard
          title="Admins"
          value={stats.admins}
        />
      </div>
    </div>
   
      
  );
}
