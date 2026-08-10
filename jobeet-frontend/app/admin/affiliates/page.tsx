import { cookies } from "next/headers";
import AffiliateTable from "@/components/affiliates/AffiliateTable";
import { getAffiliates } from "@/services/affiliates";

export default async function affiliatesPage() {
  const cookie = (await cookies()).toString();
  const affiliates = await getAffiliates(cookie);
  return <AffiliateTable affiliates={affiliates} />;
}
