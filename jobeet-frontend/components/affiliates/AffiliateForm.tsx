"use client";

import { Input } from "../ui/input";
import { Category } from "@/types/category";
import { Label } from "../ui/label";
import { Button } from "../ui/button";
import { Checkbox } from "../ui/checkbox";
import { AffiliateFormData } from "@/types/affiliate-form-data";
import BackButton from "../ui/BackButton";
import pageStyles from "@/app/styles/jobeet.module.css";
import styles from "./affiliates.module.css";

type Props = {
    affiliate:AffiliateFormData;
    categories: Category[];

    updateField: <K extends keyof AffiliateFormData> (
        field: K,
        value: AffiliateFormData[K]
    ) => void;

    onSubmit: () => void;

    mode: "create" | "edit" | "apply";

    userType: "admin" | "public";
};

export default function AffiliateForm({affiliate, updateField, categories, onSubmit, mode, userType}: Props) {

    function handleSubmit(e: React.FormEvent<HTMLFormElement>) {
      e.preventDefault();

      onSubmit();
    }

    return (
      <div className="flex items-baseline gap-4 my-[24px]">
        <BackButton/>
          <div className="flex-1">
            <div className="max-w-5xl space-y-6">
              <h1 className={pageStyles.pageTitle}>
                {mode == "create" ? "Create Affiliate" : mode == "edit" ? "Edit Affiliate" : "Affiliate Application"}
              </h1>
            <form onSubmit={handleSubmit} className={styles.form}>
              <div className="flex flex-col gap-[12px]">
                <div className="flex flex-col gap-0">
                    <Label className={styles.formLabel}>Name</Label>
                    <Input
                        placeholder="Enter affiliate name"
                        value={affiliate.affiliate_name}
                        onChange={(e) => updateField("affiliate_name", e.target.value)}
                        required
                        className={styles.formTextInput}
                    />
                </div>
                
                <div className="flex flex-col gap-[8px]">
                    <Label className={styles.formLabel}>Email</Label>
                    <Input
                        type="email"
                        placeholder="Enter affiliate email"
                        value={affiliate.affiliate_email}
                        onChange={(e) => updateField("affiliate_email", e.target.value)}
                        required
                        className={styles.formTextInput}
                    />
                </div>

                <div className="flex flex-col gap-[8px]">
                    <Label className={styles.formLabel}>Website</Label>
                    <Input
                        type="url"
                        placeholder="Enter affiliate website url"
                        value={affiliate.affiliate_url}
                        onChange={(e) => updateField("affiliate_url", e.target.value)}
                        required
                        className={styles.formTextInput}
                    />
                </div>

                <div className="flex flex-col gap-[8px]">
                    <Label className={styles.formLabel}>Categories</Label>
                    {categories.map(category => (
                      <div key={category.id}
                        className="flex items-center gap-[8px]"
                      >
                        <Checkbox
                          id={`category-${category.id}`}
                          checked={affiliate.categories.includes(
                            category.id.toString()
                          )}

                          onCheckedChange={(checked) => {
                            if(checked) {
                              updateField("categories", [
                                ...affiliate.categories,
                                category.id.toString(),
                              ]);
                            } else {
                              updateField(
                                "categories",
                                affiliate.categories.filter(
                                  id => id !== category.id.toString()
                                )
                              );
                            }
                          }}
                          className={styles.checkboxInput}
                        />
                        <Label htmlFor={`category-${category.id}`}
                          className={styles.checkboxLabel}
                        >{category.name}</Label>
                      </div>
                    ))}
                </div>
                
                <div className="flex justify-end">
                    <Button
                        type="submit"
                        className={styles.applyButton}
                        >
                        {mode == "apply" && userType== "public" ? "Apply" : mode== "create" && userType == "admin" ? "Create" : "Update"}
                    </Button>
                </div>
              </div>
            </form>

        </div>
      </div>
    </div>
    );
}

