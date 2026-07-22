import { getCategories } from "@/services/categories";
import AffiliateCreate from "@/components/affiliates/AffiliateCreate";

export default async function ApplyAffiliatePage() {
    const categories = await getCategories();

    return (
        <AffiliateCreate
            categories={categories}
        />
    );
}