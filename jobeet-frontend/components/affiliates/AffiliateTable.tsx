"use client";

import { Affiliate } from "@/types/affiliate"
import { Button } from "@/components/ui/button";
import { Table } from "@/components/ui/table";
import Link from "next/link";
import { useRouter } from "next/navigation";
import { TableHeader, TableRow, TableHead, TableBody } from "../ui/table";
import { useState } from "react";
import AffiliateRow from "./AffiliateRow";
import DeleteAffiliateDialog from "./DeleteAffiliateDialog";
import AffiliateStatusDialog from "./AffiliateStatusDialog";

type Props = {
  affiliates: Affiliate[];
}

export default function AffiliateTable({affiliates} : Props) {
  const [selectedAffiliate, setSelectedAffiliate] = useState<Affiliate | null>(null);
  const [deleteDialogOpen, setDeleteDialogOpen] = useState(false);
  const [statusDialogOpen, setStatusDialogOpen] = useState(false);
  const router = useRouter();

  return(
    <div className="space-y-6">
      <div className="flex justify-between items-center">
        <h1 className="font-heading text-xl font-semibold tracking-tight primary-text">
          Manage Affiliates
        </h1>
        <Link href={`/admin/affiliates/create`}>
          <Button>
            New Affiliate
          </Button>
        </Link>
      </div>
      
      <div className="rounded-md border ">
        <Table>
            <TableHeader>
                <TableRow>
                    <TableHead className="w-[100px]">Affiliate ID</TableHead>
                    <TableHead>Affiliate Name</TableHead>
                    <TableHead>Affiliate Email</TableHead>
                    <TableHead>Affiliate Website</TableHead>
                    <TableHead>Active Status</TableHead>
                    <TableHead>Affiliate Token</TableHead>
                    <TableHead className="w-[80px]"></TableHead>
                </TableRow>
            </TableHeader>

            <TableBody>
                
                {affiliates.map((affiliate) => (
                    <AffiliateRow key={affiliate.id} affiliate={affiliate}
                    onDelete={(affiliate) => {
                      setSelectedAffiliate(affiliate);
                      setDeleteDialogOpen(true);
                    }}
                    onStatus = {(affiliate) => {
                      setSelectedAffiliate(affiliate);
                      setStatusDialogOpen(true);
                    }}/>
                ))}
            </TableBody>
        </Table>
      </div>
      

        <DeleteAffiliateDialog
          open={deleteDialogOpen}
          onOpenChange={setDeleteDialogOpen}
          affiliate= {selectedAffiliate}
          onSuccess= {()=> router.refresh()}
        />

        <AffiliateStatusDialog
          open = {statusDialogOpen}
          onOpenChange = {setStatusDialogOpen}
          affiliate = {selectedAffiliate}
          onSuccess ={()=> router.refresh()}
        />
      </div>
  )
}