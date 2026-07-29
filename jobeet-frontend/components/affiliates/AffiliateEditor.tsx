"use client";

import { useState } from "react";
import { Category } from "@/types/category";
import { AffiliateFormData } from "@/types/affiliate-form-data";
import { applyAffiliate, createAffiliate, updateAffiliate } from "@/services/affiliates";
import AffiliateForm from "./AffiliateForm";
import { useRouter } from "next/navigation";
import { toast } from "sonner";

type Props = {
    categories: Category[];
    mode: "create" | "edit";
    userType: "admin" | "public";
    affiliateId? : number;
    initialAffiliate: AffiliateFormData;
};


export default function AffiliateEditor({categories, mode, userType, initialAffiliate, affiliateId}: Props) {


    const [affiliate, setAffiliate] = useState(initialAffiliate);
    const router = useRouter();

    function updateField<K extends keyof AffiliateFormData> (
        field: K,
        value: AffiliateFormData[K] 
    ) {
        setAffiliate((previous) => ({
            ...previous,
            [field]: value,
        }));
    }

    async function handleSubmit() {
      console.log("Affiliate state:", affiliate);

        if (affiliate.categories.length === 0) {
          toast.error("Please select atleast one category.")
          return;
        }

        try{
          if(mode=="create") {
            if(userType == "admin") {
              await createAffiliate(affiliate);
              toast.success("Affiliate created successfully")
              router.replace("/admin/affiliates");

            }
            else if(userType == "public") {
              await applyAffiliate(affiliate);
              toast.success("Affiliate application submitted successfully");
              router.replace("/");
            }
          }
          else {
              await updateAffiliate(affiliateId!, affiliate);
              toast.success("Affiliate updated successfully");
              router.replace("/admin/affiliates");
            }
        } catch(error: any) {
          console.error(error.response?.data);
          toast.error("Unable to save affiliate");
        }
        
    }

    return(
        <>
            {
            <AffiliateForm affiliate={affiliate}
              updateField = {updateField}
              categories={categories}
              onSubmit={handleSubmit}
              mode= {mode}
              userType={userType}
            />
            }
        </>
    );
}
