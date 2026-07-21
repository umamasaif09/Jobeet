"use client";

import { useState } from "react";
import JobForm from "./JobForm";
import Preview from "./Preview";
import { Category } from "@/types/category";
import { JobFormData } from "@/types/job-form-data";
import { uploadLogo } from "@/services/upload";
import { createJob } from "@/services/jobs";

type Props = {
    categories: Category[];
};


export default function JobCreate({categories}: Props) {

    const [preview, setPreview] = useState(false);

    const [job, setJob] = useState<JobFormData>({
        category_id: "",

        type: "Full-time",

        company: "",

        url: "",

        logo: null as File | null,

        position: "",

        location: "",

        email: "",

        description: "",

        how_to_apply: "",

        is_public: true
    });

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
        if (!job.category_id) {
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
            if(job.logo) {
                const upload = await uploadLogo(job.logo);

                logoFileName= upload.filename;
            }

            const request = {
                ...job,
                logo: logoFileName,
                category_id: Number(job.category_id),
            };
            

            await createJob(request);

            alert("Job created successfully!");
        } catch(error) {
            console.error(error);
            alert("Unable to create job.");
        }
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
