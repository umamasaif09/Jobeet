"use client";

import { useState } from "react";
import JobForm from "./JobForm";
import Preview from "./Preview";
import { Category } from "@/types/category";
import { JobFormData } from "@/types/job-form-data";
import { uploadLogo } from "@/services/upload";
import { adminUpdateJob, createJob, updateJob } from "@/services/jobs";
import { Card, CardContent } from "../ui/card";
import Link from "next/link";
import { useRouter } from "next/navigation";
import { toast } from "sonner";
import BackButton from "../ui/BackButton";
import pageStyles from "@/app/styles/jobeet.module.css";
import styles from "./jobs.module.css";

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
                router.replace(`/jobs/${jobId}`);
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
        <>
          <div className="flex items-baseline gap-4 my-[24px]">
          <BackButton/>
            <h1 className={pageStyles.pageTitle}>
              Job Created
            </h1>
        </div>
          <Card className="bg-white rounded-[10px] border-0 shadow-[0_2px_8px_rgba(0,0,0,0.08)]">
            <CardContent className="py-[9px] px-[24px]">
              <div className="space-y-4">

                <h3 className={styles.h3}>Job Created Successfully</h3>

                <p className="text-[16px]">Save this link to edit your job later: </p>

                <Link href={createdJob.editLink} className="text-[#3498db] hover:underline cursor-pointer text-[16px]">
                  {createdJob.editLink}
                  </Link>
                
              </div>
            </CardContent>
          </Card>
        </>
      

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
