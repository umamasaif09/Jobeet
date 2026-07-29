"use client";

import { Input } from "../ui/input";
import { Category } from "@/types/category";
import { Label } from "../ui/label";
import { Button } from "../ui/button";
import { Checkbox } from "../ui/checkbox";
import {Card, CardContent} from "@/components/ui/card";
import { AffiliateFormData } from "@/types/affiliate-form-data";
import BackButton from "../ui/BackButton";

type Props = {
    affiliate:AffiliateFormData;
    categories: Category[];

    updateField: <K extends keyof AffiliateFormData> (
        field: K,
        value: AffiliateFormData[K]
    ) => void;

    onSubmit: () => void;

    mode: "create" | "edit";

    userType: "admin" | "public";
};

export default function AffiliateForm({affiliate, updateField, categories, onSubmit, mode, userType}: Props) {

    return (
      <div className="flex items-baseline gap-4">
        <BackButton/>
          <div className="flex-1">
            <div className="max-w-5xl space-y-6">
            <h1 className="font-heading text-xl font-semibold tracking-tight primary-text">
              {mode == "create" ? "Create Affiliate" : "Edit Affiliate"}
            </h1>

              <div className="space-y-4">
                <div className="space-y-2">
                    <Label>Name</Label>
                    <Input
                        placeholder="Name"
                        value={affiliate.affiliate_name}
                        onChange={(e) => updateField("affiliate_name", e.target.value)}
                    />
                </div>
                
                <div className="space-y-2">
                    <Label>Email</Label>
                    <Input
                        type="email"
                        placeholder="email"
                        value={affiliate.affiliate_email}
                        onChange={(e) => updateField("affiliate_email", e.target.value)}
                    />
                </div>

                <div className="space-y-2">
                    <Label>Website</Label>
                    <Input
                        placeholder="url"
                        value={affiliate.affiliate_url}
                        onChange={(e) => updateField("affiliate_url", e.target.value)}
                    />
                </div>

                <div className="space-y-2">
                    <Label>Categories</Label>
                    {categories.map(category => (
                      <div key={category.id}
                        className="flex items-center gap-2"
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
                        />
                        <Label htmlFor={`category-${category.id}`}>{category.name}</Label>
                      </div>
                    ))}
                </div>
                
                <div className="flex justify-end">
                    <Button
                        type="button"
                        onClick={onSubmit}
                        >
                        {mode == "create" && userType== "public" ? "Apply" : mode== "create" && userType == "admin" ? "Create" : "Update"}
                    </Button>
                </div>
              </div>
                

        </div>
      </div>
    </div>
    );
}

