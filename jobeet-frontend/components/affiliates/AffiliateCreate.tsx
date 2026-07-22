"use client";

import { useState } from "react";
import { Category } from "@/types/category";
import { Affiliate } from "@/types/affiliate";
import { AffiliateFormData } from "@/types/affiliate_form_data";
import { applyAffiliate } from "@/services/affiliates";
import AffiliateForm from "./AffiliateForm";

type Props = {
    categories: Category[];
};


export default function AffiliateCreate({categories}: Props) {

    const [affiliate, setAffiliate] = useState<AffiliateFormData>({
      affiliate_name: "",
      affiliate_email: "",
      affiliate_url: "",
      categories: []

    });

    function updateField<K extends keyof AffiliateFormData> (
        field: K,
        value: AffiliateFormData[K] 
    ) {
        setAffiliate((previous) => ({
            ...previous,
            [field]: value,
        }));
    }

    async function submitAffiliateRequest() {
        if (affiliate.categories.length === 0) {
                alert("Please select atleast one category.");
                return;
            }
        try{

            await applyAffiliate(affiliate);

            alert("Affiliate application submitted successfully!");
        } catch(error:any) {
            
            console.error(error.response?.data);
            alert("Unable to create job.");
        }
    }

    return(
        <>
            {
            <AffiliateForm affiliate={affiliate}
              updateField = {updateField}
              categories={categories}
              onSubmit={submitAffiliateRequest}
            />
            }
        </>
    );
}
