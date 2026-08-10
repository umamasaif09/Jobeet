"use client";

import { Affiliate } from "@/types/affiliate";
import { Button } from "@/components/ui/button";
import { Table } from "@/components/ui/table";
import Link from "next/link";
import { useRouter } from "next/navigation";
import { TableHeader, TableRow, TableHead, TableBody } from "../ui/table";
import AffiliateRow from "./AffiliateRow";
import pageStyles from "@/app/styles/jobeet.module.css";
import styles from "./affiliates.module.css";
import {
  activateAffiliate,
  deleteAffiliate,
  disableAffiliate,
} from "@/services/affiliates";

type Props = {
  affiliates: Affiliate[];
};

export default function AffiliateTable({ affiliates }: Props) {
  const router = useRouter();

  return (
    <div className="space-y-6 my-[24px]">
      <div className="flex justify-between items-center">
        <h1 className={pageStyles.pageTitle}>Manage Affiliates</h1>
        <Link href={`/admin/affiliates/create`}>
          <Button className={styles.applyButton}>New Affiliate</Button>
        </Link>
      </div>

      <div className={styles.affiliatesTableCard}>
        <Table className={styles.affiliatesTable}>
          <TableHeader>
            <TableRow>
              <TableHead className={styles.affiliatesTableHeaderTh}>
                Affiliate ID
              </TableHead>
              <TableHead className={styles.affiliatesTableHeaderTh}>
                Affiliate Name
              </TableHead>
              <TableHead className={styles.affiliatesTableHeaderTh}>
                Affiliate Email
              </TableHead>
              <TableHead className={styles.affiliatesTableHeaderTh}>
                Affiliate Website
              </TableHead>
              <TableHead className={styles.affiliatesTableHeaderTh}>
                Status
              </TableHead>
              <TableHead className={styles.affiliatesTableHeaderTh}>
                Affiliate Token
              </TableHead>
              <TableHead className={styles.affiliatesTableHeaderTh}></TableHead>
            </TableRow>
          </TableHeader>

          <TableBody>
            {affiliates.map((affiliate) => (
              <AffiliateRow
                key={affiliate.id}
                affiliate={affiliate}
                onDelete={async (affiliate) => {
                  const confirmed = window.confirm("Delete this affiliate?");
                  if (!confirmed) return;
                  if (!affiliate) return;
                  await deleteAffiliate(affiliate.id);
                  router.refresh();
                }}
                onStatus={async (affiliate) => {
                  if (!affiliate) return;

                  if (affiliate.is_active == true) {
                    await disableAffiliate(affiliate.id);
                  } else {
                    await activateAffiliate(affiliate.id);
                  }
                  router.refresh();
                }}
              />
            ))}
          </TableBody>
        </Table>
      </div>
    </div>
  );
}
