"use client";

import { Card, CardContent, CardHeader, CardTitle } from "@/components/ui/card";
import Container from "@/components/ui/Container";
import { Label } from "@/components/ui/label";
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
    <Container>
      <Card>
        <CardHeader>
          <CardTitle>Admin Dashboard</CardTitle>
        </CardHeader>

        <CardContent>
          <Label>Total Categories</Label>
          {stats.categories}

          <Label>Total Jobs</Label>
          {stats.jobs}
          
          <Label>Total Affiliates</Label>
          {stats.affiliates}

          <Label>Total Admins</Label>
          {stats.admins}
        </CardContent>
      </Card>
    </Container>
  );
}
