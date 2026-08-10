import AffiliateEditor from "@/components/affiliates/AffiliateEditor";
import { getCategories } from "@/services/categories";

export default async function CreateAffiliatePage() {
  const categories = await getCategories();

  return (
    <AffiliateEditor
      categories={categories}
      mode="create"
      userType="admin"
      initialAffiliate={{
        affiliate_name: "",
        affiliate_email: "",
        affiliate_url: "",
        categories: [],
      }}
    />
  );
}
