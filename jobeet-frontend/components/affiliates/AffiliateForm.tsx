"use client";

import { Input } from "../ui/input";
import { Category } from "@/types/category";
import { Label } from "../ui/label";
import { Button } from "../ui/button";
import { Checkbox } from "../ui/checkbox";
import {Card, CardContent} from "@/components/ui/card";
import { AffiliateFormData } from "@/types/affiliate-form-data";

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

        <Card>
            <CardContent>

                <div>
                    <Label>Name</Label>
                    <Input
                        placeholder="Name"
                        value={affiliate.affiliate_name}
                        onChange={(e) => updateField("affiliate_name", e.target.value)}
                    />
                </div>
                
                <div>
                    <Label>Email</Label>
                    <Input
                        placeholder="email"
                        value={affiliate.affiliate_email}
                        onChange={(e) => updateField("affiliate_email", e.target.value)}
                    />
                </div>

                <div>
                    <Label>Website</Label>
                    <Input
                        placeholder="url"
                        value={affiliate.affiliate_url}
                        onChange={(e) => updateField("affiliate_url", e.target.value)}
                    />
                </div>

                <div>
                    <Label>Categories</Label>
                    {categories.map(category => (
                      <div key={category.id}
                        className="flex items-center gap-2"
                      >
                        <Checkbox
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
                        <Label>{category.name}</Label>
                      </div>
                    ))}
                </div>
                
                <div>
                    <Button
                        type="button"
                        onClick={onSubmit}
                        >
                        {mode == "create" && userType== "public" ? "Apply" : mode== "create" && userType == "admin" ? "Create" : "Update"}
                    </Button>
                </div>
            </CardContent>
        </Card>

        
    );
}

