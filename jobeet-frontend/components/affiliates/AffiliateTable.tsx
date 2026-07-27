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
    <>
      <Link href={`/admin/affiliates/create`}>
        <Button>
          New Affiliate
        </Button>
      </Link>
      
      <Table>
            <TableHeader>
                <TableRow>
                    <TableHead>Affiliate ID</TableHead>
                    <TableHead>Affiliate Name</TableHead>
                    <TableHead>Affiliate Email</TableHead>
                    <TableHead>Affiliate Website</TableHead>
                    <TableHead>Active Status</TableHead>
                    <TableHead>Affiliate Token</TableHead>
                    <TableHead></TableHead>
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
      </>
  )
}