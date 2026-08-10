import AffiliateEditor from "@/components/affiliates/AffiliateEditor";
import { getCategories } from "@/services/categories";

export default async function ApplyAffiliatePage() {
  const categories = await getCategories();

  return (
    <AffiliateEditor
      categories={categories}
      mode="apply"
      userType="public"
      initialAffiliate={{
        affiliate_name: "",
        affiliate_email: "",
        affiliate_url: "",
        categories: [],
      }}
    />
  );
}
