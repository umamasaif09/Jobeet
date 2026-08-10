import AffiliateEditor from "@/components/affiliates/AffiliateEditor";
import { transformAffiliate } from "@/lib/transformers";
import { getAffiliate } from "@/services/affiliates";
import { getCategories } from "@/services/categories";
import { cookies } from "next/headers";

type Props = {
  params: Promise<{
    id: string;
  }>;
};

export default async function editAffiliatePage({ params }: Props) {
  const cookie = (await cookies()).toString();
  const { id } = await params;

  const affiliate = await getAffiliate(id, cookie);

  const categories = await getCategories();

  return (
    <AffiliateEditor
      categories={categories}
      mode="edit"
      userType="admin"
      initialAffiliate={transformAffiliate(affiliate)}
      affiliateId={affiliate.id}
    />
  );
}
