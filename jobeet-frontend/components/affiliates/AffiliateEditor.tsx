"use client";

import { useState } from "react";
import { Category } from "@/types/category";
import { AffiliateFormData } from "@/types/affiliate-form-data";
import { applyAffiliate, createAffiliate, updateAffiliate } from "@/services/affiliates";
import AffiliateForm from "./AffiliateForm";
import { useRouter } from "next/navigation";
import { toast } from "sonner";
import BackButton from "../ui/BackButton";
import { Card, CardContent } from "../ui/card";
import pageStyles from "@/app/styles/jobeet.module.css";
import styles from "./affiliates.module.css";

type Props = {
    categories: Category[];
    mode: "create" | "edit" | "apply";
    userType: "admin" | "public";
    affiliateId? : number;
    initialAffiliate: AffiliateFormData;
};


export default function AffiliateEditor({categories, mode, userType, initialAffiliate, affiliateId}: Props) {


    const [affiliate, setAffiliate] = useState(initialAffiliate);
    const router = useRouter();
    const [affiliateApplied, setAffiliateApplied] = useState<AffiliateFormData | null>(null);

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
            
          }
          else if(mode == "apply") {
              await applyAffiliate(affiliate);
              setAffiliateApplied(affiliate);
              toast.success("Affiliate application submitted successfully");
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

    if(affiliateApplied) {
      return(
        <>
           <div className="flex items-baseline gap-4 my-[24px]">
          <BackButton/>
            <h1 className={pageStyles.pageTitle}>
              Affiliation Request Submitted
            </h1>
        </div>

          <Card className="bg-white rounded-[10px] border-[#ececec] shadow-[0_2px_8px_rgba(0,0,0,0.08)]">
            <CardContent className="py-[9px] px-[24px]">
              <div className="space-y-4">

                <h4 className={styles.h4}>
                    {`Thank you, ${affiliateApplied.affiliate_name}`}
                </h4>

                <p className="text-[rgb(51, 51, 51)]">Your affiliate application has been submitted.</p>

                <p className="text-[rgb(51, 51, 51)]">Your account will be activated by an administrator.</p>
               
              </div>
            </CardContent>
          </Card>
        </>
       
       
      );
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
