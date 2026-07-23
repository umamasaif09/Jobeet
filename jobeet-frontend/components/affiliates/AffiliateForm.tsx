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
};

export default function AffiliateForm({affiliate, updateField, categories, onSubmit}: Props) {

    return (

        <Card className="max-w-4xl mx-auto">
            <CardContent className="space-y-6 p-8">

                <div className="sapce-y-2">
                    <Label>Name</Label>
                    <Input
                        placeholder="Name"
                        value={affiliate.affiliate_name}
                        onChange={(e) => updateField("affiliate_name", e.target.value)}
                    />
                </div>
                
                <div className="sapce-y-2">
                    <Label>Email</Label>
                    <Input
                        placeholder="email"
                        value={affiliate.affiliate_email}
                        onChange={(e) => updateField("affiliate_email", e.target.value)}
                    />
                </div>

                <div className="sapce-y-2">
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
                
                <div className="flex justify-end">
                    <Button
                        type="button"
                        onClick={onSubmit}
                        >
                        Apply
                    </Button>
                </div>
            </CardContent>
        </Card>

        
    );
}

