"use client";

import { JobFormData } from "@/types/job-form-data";
import { Input } from "../ui/input";
import { Category } from "@/types/category";
import { Label } from "../ui/label";
import { Textarea } from "../ui/textarea";
import { Button } from "../ui/button";
import {Select, SelectContent, SelectItem, SelectTrigger, SelectValue} from "@/components/ui/select"; 
import { RadioGroup, RadioGroupItem } from "../ui/radio-group";
import { Checkbox } from "../ui/checkbox";
import {Card, CardContent} from "@/components/ui/card";

type Props = {
    job: JobFormData;
    categories: Category[];

    updateField: <K extends keyof JobFormData> (
        field: K,
        value: JobFormData[K]
    ) => void;

    onPreview: () => void;
};

export default function JobForm({job, updateField, categories, onPreview}: Props) {

    

    return (

        <Card className="max-w-4xl mx-auto">
            <CardContent className="space-y-6 p-8">

                <div className="space-y-2">
                    <Label>Category</Label>
                    <Select
                        value={job.category_id ?? ""}
                        onValueChange={(value) => {
                            if(value !== null){
                                 updateField("category_id", value)}
                            }
                           }
                    >

                    <SelectTrigger>
                        <SelectValue placeholder="Select Category" />
                    </SelectTrigger>

                    <SelectContent>
                        {categories.map(category => 
                            <SelectItem
                                key={category.id}
                                value={category.id.toString()}
                            >
                                {category.name}
                            </SelectItem>
                        )}
                    </SelectContent>
                </Select>
                </div>

                <div className="space-y-3">
                    <Label>Job Type</Label>
                    <RadioGroup value={job.type}
                        onValueChange={(value) => updateField("type", value)}
                    >
                        <div className="flex items-center gap-2">
                            <RadioGroupItem value="Full-time" id="full"/>
                            <Label htmlFor="full">Full Time</Label>
                        </div>
                        <div className="flex items-center gap-2">
                            <RadioGroupItem value="Part-time" id="part"/>
                            <Label htmlFor="part">Part Time</Label>
                        </div>
                        <div className="flex items-center gap-2">
                            <RadioGroupItem value="Freelance" id="free"/>
                            <Label htmlFor="free">Freelance</Label>
                        </div>
                    </RadioGroup>
                </div>

                <div className="sapce-y-2">
                    <Label>Company</Label>
                    <Input
                        placeholder="Company"
                        value={job.company}
                        onChange={(e) => updateField("company", e.target.value)}
                    />
                </div>

                <div className="space-y-2">
                    <Label>Company Logo</Label>

                    <Input
                        type="file"
                        accept="image"
                        onChange={(e) => updateField("logo", e.target.files?.[0] ?? null)}
                    />
    
                </div>

                <div className="sapce-y-2">
                    <Label>Position</Label>
                    <Input
                        placeholder="position"
                        value={job.position}
                        onChange={(e) => updateField("position", e.target.value)}
                    />
                </div>

                <div className="sapce-y-2">
                    <Label>Website</Label>
                    <Input
                        placeholder="url"
                        value={job.url}
                        onChange={(e) => updateField("url", e.target.value)}
                    />
                </div>

                <div className="sapce-y-2">
                    <Label>Email</Label>
                    <Input
                        placeholder="email"
                        value={job.email}
                        onChange={(e) => updateField("email", e.target.value)}
                    />
                </div>

                <div className="sapce-y-2">
                    <Label>Location</Label>
                    <Input
                        placeholder="location"
                        value={job.location}
                        onChange={(e) => updateField("location", e.target.value)}
                    />
                </div>

                <div className="space-y-2">
                    <Label>Description</Label>
                    <Textarea
                        rows={6}
                        value={job.description}
                        onChange={(e)=>
                            updateField("description",e.target.value)
                        }
                    />
                </div>
                <div className="space-y-2">
                     <Label>How to Apply</Label>
                        <Textarea
                            rows={5}
                            value={job.how_to_apply}
                            onChange={(e)=>
                                updateField("how_to_apply",e.target.value)
                            }
                        />
                </div>

                <div className="flex items-center gap-3">
                    <Checkbox
                        checked={job.is_public}
                        onCheckedChange={(checked)=>
                            updateField(
                                "is_public",
                                Boolean(checked)
                            )
                        }
                    />

                    <Label>Publish publicly</Label>
                </div>
                
                <div className="flex justify-end">
                    <Button
                        type="button"
                        onClick={onPreview}
                        >
                        Preview Job
                    </Button>
                </div>
            </CardContent>
        </Card>

        
    );
}

