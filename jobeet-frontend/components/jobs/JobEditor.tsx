"use client";

import { useState } from "react";
import JobForm from "./JobForm";
import Preview from "./Preview";
import { Category } from "@/types/category";
import { JobFormData } from "@/types/job-form-data";
import { uploadLogo } from "@/services/upload";
import { adminUpdateJob, createJob, updateJob } from "@/services/jobs";
import { Card, CardContent } from "../ui/card";
import { Label } from "../ui/label";
import { Input } from "../ui/input";
import { Button } from "../ui/button";
import Link from "next/link";
import { useRouter } from "next/navigation";
import { toast } from "sonner";
import BackButton from "../ui/BackButton";

type Props = {
    categories: Category[];
    initialJob: JobFormData;
    mode: "create" | "edit";
    jobId? : number;
    token?: string;
    userType: "admin" | "public";
};


export default function JobEditor({categories, initialJob, mode, jobId, token, userType}: Props) {

    const [preview, setPreview] = useState(false);

    const [job, setJob] = useState(initialJob);
    const [createdJob, setCreatedJob] = useState<{id: number; editLink: string } | null> (null);

    const router = useRouter();

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
                toast.warning("Please select a category.");
                return;
            }

        if (!job.company.trim()) {
            toast.warning("Please enter a company.");
            return;
        }

        if (!job.position.trim()) {
            toast.warning("Please enter a position.");
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
              if(userType == "public") {
                const result = await createJob(request);
                setCreatedJob({
                  id: result.job.id,
                  editLink: `${window.location.origin}/jobs/edit/${result.job.id}/${result.token}`,
                });
                toast.success("Job posted successfully")
              }
              else {
                await createJob(request);
                toast.success("Job post created successfully")
                router.replace("/admin/jobs");
              }
            } 
            else{
              if(userType == "public") {
                  await updateJob(
                  jobId!,
                  token!,
                  request
                );
                toast.success("Job updated successfully");
                router.replace("/");
              }
              else {
                await adminUpdateJob(
                  jobId!,
                  request
                );
                toast.success("Job updated successfully");
                router.replace("/admin/jobs");
              }
              
            }
            
        } catch(error:any) {
            
            console.error(error.response?.data);
            toast.warning(mode== "create" ? "Unable to create job." : "Unable to update job.");
        }
    }

    if(createdJob) {
      return (
      <div className="flex items-baseline gap-4">
          <BackButton/>
          <div className="flex-1">
          <div className="max-w-5xl space-y-6">
            <h1 className="font-heading text-xl font-semibold tracking-tight primary-text">
              Job Created
            </h1>
        
          <Card>
            <CardContent>
              <div className="space-y-4">
                <p>
                  Your job has been posted successfully.
                </p>

                <div className="space-y-2">
                  <Label>Save this link to edit job post later</Label>
                <Link href={createdJob.editLink} className="cursor-pointer">
                  {createdJob.editLink}
                  </Link>
                </div>

                <div className="">
                  <Button>
                    <Link href={`/jobs/${createdJob.id}`}>
                      View Job
                    </Link>
                  </Button>  
                </div>
              </div>

              

              
            </CardContent>
          </Card>
        </div>
      </div>
      </div>
      );
    }

    return(
        <>
            {userType == "public" && preview ? (<Preview job = {job}
                categories={categories}
                onEdit={()=>setPreview(false)}
                onSubmit={submitJob}
            />) : 
            (<JobForm job={job}
              updateField = {updateField}
              categories={categories}
              onPreview={()=>setPreview(true)}
              onSubmit = {submitJob}
              userType = {userType}
              mode = {mode}
            />)}
        </>
    );
}
