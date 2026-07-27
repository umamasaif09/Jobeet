"use client";

import { useState } from "react";
import JobForm from "./JobForm";
import Preview from "./Preview";
import { Category } from "@/types/category";
import { JobFormData } from "@/types/job-form-data";
import { uploadLogo } from "@/services/upload";
import { createJob, updateJob } from "@/services/jobs";
import { Card, CardContent } from "../ui/card";
import { Label } from "../ui/label";
import { Input } from "../ui/input";
import { Button } from "../ui/button";
import Link from "next/link";

type Props = {
    categories: Category[];
    initialJob: JobFormData;
    mode: "create" | "edit";
    jobId? : number;
    token?: string;
    isAdmin?: boolean;
};


export default function JobEditor({categories, initialJob, mode, jobId, token, isAdmin}: Props) { //TODO: handle admin and public requests differently

    const [preview, setPreview] = useState(false);

    const [job, setJob] = useState(initialJob);
    const [createdJob, setCreatedJob] = useState<{id: number; editLink: string } | null> (null);

    function updateField<K extends keyof JobFormData> (
        field: K,
        value: JobFormData[K] 
    ) {
        setJob((previous) => ({
            ...previous,
            [field]: value,
        }));
    }

    async function submitJob() {

      const categoryId = Number(job.category_id);

        if (!categoryId) {
                alert("Please select a category.");
                return;
            }

        if (!job.company.trim()) {
            alert("Please enter a company.");
            return;
        }

        if (!job.position.trim()) {
            alert("Please enter a position.");
            return;
        }
        try{
            let logoFileName="";
            if(job.logo instanceof File) {
                const upload = await uploadLogo(job.logo);

                logoFileName= upload.filename;
            }
            else {
              logoFileName = job.logo?? "";
            }

            const request = {
                ...job,
                logo: logoFileName,
                category_id: Number(job.category_id),
            };
            
            if(mode == "create") {
              const result = await createJob(request);
              setCreatedJob({
                id: result.job.id,
                editLink: `${window.location.origin}/jobs/edit/${result.job.id}/${result.token}`,
              });
              
            } 
            else {
              await updateJob(
                jobId!,
                token!,
                request
              );
            }
            
        } catch(error:any) {
            
            console.error(error.response?.data);
            alert(mode== "create" ? "Unable to create job." : "Unable to update job.");
        }
    }

    if(createdJob) {
      return (<div>
        <Card>
          <CardContent>
            <div>
              <h2>
                Job Created Successfully
              </h2>

              <p>
                Your job has been posted successfully.
              </p>
            </div>

            <div>
              <Label>Save this edit link</Label>

              <Input
                readOnly
                value={createdJob.editLink}
              />
            </div>

            <div>
              <Button onClick={()=> navigator.clipboard.writeText(createdJob.editLink)}>
                Copy Link
              </Button>
            </div>

            <div className="">
              <Button>
                <Link href={`/jobs/${createdJob.id}`}>
                  View Job
                </Link>
              </Button>  
            </div>
          </CardContent>
        </Card>
      </div>);
    }

    return(
        <>
            {preview ? (<Preview job = {job}
                categories={categories}
                onEdit={()=>setPreview(false)}
                onSubmit={submitJob}
            />) : 
            (<JobForm job={job}
              updateField = {updateField}
              categories={categories}
              onPreview={()=>setPreview(true)}
            />)}
        </>
    );
}
