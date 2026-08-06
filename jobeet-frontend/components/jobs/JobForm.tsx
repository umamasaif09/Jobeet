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
import BackButton from "../ui/BackButton";
import pageStyles from "@/app/styles/jobeet.module.css";
import styles from "./jobs.module.css";

type Props = {
    job: JobFormData;
    categories: Category[];

    updateField: <K extends keyof JobFormData> (
        field: K,
        value: JobFormData[K]
    ) => void;

    onPreview: () => void;
    userType: "admin" | "public";
    onSubmit: () => void;
    mode: "create" | "edit";
};

export default function JobForm({job, updateField, categories, onPreview, userType, onSubmit, mode}: Props) {

    function handleSubmit(e: React.FormEvent<HTMLFormElement>) {
      e.preventDefault();

      if (userType === "public") {
        if (mode === "create") {
          onPreview();
        } else {
          onSubmit();
        }
      } else {
        onSubmit();
      }
    }

    return (
      <div className="flex items-baseline gap-4">
        <BackButton/>
        <div className="flex-1">
          <div className="max-w-5xl space-y-6 my-[24px]">
            <h1 className={pageStyles.pageTitle}>
              {mode == "create" ? "Create Job" : "Edit Job"}
            </h1>
              <form onSubmit={handleSubmit} className={styles.form}>
                  <div className="flex flex-col gap-[8px]">
                      <Label className={styles.formLabel}>Category</Label>
                        <Select 
                            value={job.category_id ?? ""}
                            onValueChange={(value) => {
                                if(value !== null){
                                    updateField("category_id", value)}
                                }
                              }
                              required
                              
                        >

                        <SelectTrigger className={styles.formTextInput}>
                            {categories.find(c => c.id.toString() === job.category_id)?.name ?? "Select Category"}
                        </SelectTrigger>

                        <SelectContent >
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

                    <div className="flex flex-col gap-[8px]">
                        <Label className={styles.formLabel}>Job Type</Label>
                        <RadioGroup value={job.type}
                            onValueChange={(value) => updateField("type", value)} required
                        >
                          <div className="flex gap-4">
                            <div className="flex gap-2">
                                <RadioGroupItem value="Full-time" id="full"/>
                                <Label htmlFor="full" className={styles.radioLabel}>Full Time</Label>
                            </div>
                            <div className="flex gap-2">
                                <RadioGroupItem value="Part-time" id="part"/>
                                <Label htmlFor="part" className={styles.radioLabel}>Part Time</Label>
                            </div>
                            <div className="flex gap-2">
                                <RadioGroupItem value="Freelance" id="free"/>
                                <Label htmlFor="free" className={styles.radioLabel}>Freelance</Label>
                            </div>
                          </div>
                            
                        </RadioGroup>
                    </div>

                    
                        <div className="flex flex-col gap-[8px]">
                          <Label className={styles.formLabel}>Company Name</Label>
                          <Input
                              placeholder="Enter company name"
                              value={job.company}
                              onChange={(e) => updateField("company", e.target.value)} required
                              className={styles.formTextInput}
                          />
                        </div>

                        <div className="flex flex-col gap-[8px]">
                        <Label className={styles.formLabel}>Upload Logo</Label>
                            <div className="flex flex-col items-start gap-[8px]">
                              {job.logo && (
                                    <img
                                      src={job.logo instanceof File ? URL.createObjectURL(job.logo)
                                        : `${process.env.NEXT_PUBLIC_UPLOAD_URL}/${job.logo}`
                                      }
                                      alt="Company logo"
                                      className="h-20 w-20 rounded-[10px] border-2 border-[#ddd] object-contain"
                                  />
                                  
                                  )}

                                  <Label 
                                  htmlFor="logo-upload"
                                  className={styles.fileButton}>
                                   Choose File
                                  </Label>
                            </div>
                          
                        <Input
                            id="logo-upload"
                            type="file"
                            accept="image/*"
                            onChange={(e) => {
                                const file = e.target.files?.[0] ?? null;
                                console.log("Selected", file);
                                updateField("logo", file)}}
                            className="hidden"
                        />

                    <div className="flex flex-col gap-[8px]">
                          <Label className={styles.formLabel}>Website Url</Label>
                          <Input
                              type="url"
                              placeholder="Enter website url"
                              value={job.url}
                              onChange={(e) => updateField("url", e.target.value)} 
                              className={styles.formTextInput}
                          />
                      </div>

                        <div className="flex flex-col gap-[8px]">
                          <Label className={styles.formLabel}>Position</Label>
                          <Input
                              placeholder="Enter position"
                              value={job.position}
                              onChange={(e) => updateField("position", e.target.value)} required
                              className={styles.formTextInput}
                          />
                      </div>

                      <div className="flex flex-col gap-[8px]">
                          <Label className={styles.formLabel}>Location</Label>
                          <Input
                              placeholder="Enter location"
                              value={job.location}
                              onChange={(e) => updateField("location", e.target.value)} required
                              className={styles.formTextInput}
                          />
                      </div>

                      <div className="flex flex-col gap-[8px]">
                          <Label className={styles.formLabel}>Company Email</Label>
                          <Input
                              type="email"
                              placeholder="Enter company email"
                              value={job.email}
                              onChange={(e) => updateField("email", e.target.value)} required
                              className={styles.formTextInput}
                          />
                      </div> 
                    </div>
                    
                    <div className="flex flex-col gap-[8px]">
                        <Label className={styles.formLabel}>Description</Label>
                        <Textarea
                            rows={6}
                            value={job.description}
                            placeholder="Enter job description here"
                            onChange={(e)=>
                                updateField("description",e.target.value)
                            }
                            className={styles.formTextArea}
                        />
                    </div>
                    <div className="flex flex-col gap-[8px]">
                        <Label className={styles.formLabel}>How to Apply</Label>
                            <Textarea
                                rows={5}
                                value={job.how_to_apply}
                                placeholder="Enter how to apply here"
                                onChange={(e)=>
                                    updateField("how_to_apply",e.target.value)
                                }
                                className={styles.formTextArea}
                            />
                    </div>

                    <div className="flex items-center gap-2">
                        <Checkbox
                            id="checked"
                            checked={job.is_public}
                            onCheckedChange={(checked)=>
                                updateField(
                                    "is_public",
                                    Boolean(checked)
                                )
                            }
                        />

                        <Label htmlFor="checked" className={styles.checkboxLabel}>Public Job Listing</Label>
                    </div>
                    
                    <div className="flex justify-end">
                        <Button
                            type="submit"
                            className={styles.jobButton}
                            >
                          {mode == "create" && userType=="admin" ? "Create" :mode=="create" && userType=="public"? "Preview" : "Update"}
                        </Button>
   
                    </div>

              </form>
                
           </div>
        </div>
        
      </div>

    );
}

