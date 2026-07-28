"use client";

import { useState } from "react";
import { Category } from "@/types/category";
import { AffiliateFormData } from "@/types/affiliate-form-data";
import { applyAffiliate, createAffiliate, updateAffiliate } from "@/services/affiliates";
import AffiliateForm from "./AffiliateForm";

type Props = {
    categories: Category[];
    mode: "create" | "edit";
    userType: "admin" | "public";
    affiliateId? : number;
    initialAffiliate: AffiliateFormData;
};


export default function AffiliateEditor({categories, mode, userType, initialAffiliate, affiliateId}: Props) {


    const [affiliate, setAffiliate] = useState(initialAffiliate);

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
          alert("Please select atleast one category.");
          return;
        }

        try{
          if(mode=="create") {
            if(userType == "admin") {
              await createAffiliate(affiliate);
            }
            else if(userType == "public") {
              await applyAffiliate(affiliate);
              alert("Affiliate application submitted successfully!");
            }
          }
          else {
              await updateAffiliate(affiliateId!, affiliate);
            }
        } catch(error: any) {
          console.error(error.response?.data);
          alert("Unable to save affiliate.");
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
