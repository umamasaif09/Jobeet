import { JobFormData } from "@/types/job-form-data";
import { Category } from "@/types/category";
import { Card, CardContent } from "../ui/card";
import { Button } from "../ui/button";
import BackButton from "../ui/BackButton";
import Image from "next/image";
import pageStyles from "@/app/styles/jobeet.module.css";
import styles from "./jobs.module.css";
import Link from "next/link";


type Props = {
    job: JobFormData;
    categories: Category[];
    onEdit: () => void;
    onSubmit: () => void;
};

export default function Preview({job, categories, onEdit, onSubmit}: Props) {
    const category= categories.find(
        (c) => c.id=== Number(job.category_id)
    );

    return(

      <div className="flex flex-col">
        <div className="flex items-baseline gap-4 my-[24px] ">     
          <BackButton/>
          <h1 className={pageStyles.pageTitle}>
            Preview Job
          </h1>
        </div>
        <Card className="bg-white rounded-[10px] border-[#ececec] shadow-[0_2px_8px_rgba(0,0,0,0.08)]">
            <CardContent className="py-[9px] px-[24px]">
                <div className="space-y-2.5">

                  <p className="text-[16px]"><strong className="font-[700] text-[16px]">Category: </strong>{category?.name}</p>
                  <p className="text-[16px]"><strong className="font-[700] text-[16px]">Type: </strong>{job.type}</p>
                  <p className="text-[16px]"><strong className="font-[700] text-[16px]">Category: </strong>{job.company}</p>

                  <div>
                    {job.logo && (
                      <>
                        <p className="text-[16px]"><strong className="font-[700] text-[16px]">Logo: </strong></p>
                        <Image src={job.logo instanceof File ? 
                          URL.createObjectURL(job.logo) :
                        `${process.env.NEXT_PUBLIC_UPLOAD_URL}/${job.logo}`}
                        alt="Logo"
                        width={80}
                        height={80}
                        unoptimized
                        className="rounded-md border object-contain"
                        />
                      </>
                    )}
                  </div>

                  <p className="text-[16px]"><strong className="font-[700] text-[16px]">Website: </strong><Link
                    className="text-[#3498db] hover:underline cursor-pointer"
                    href={job.url}
                  >
                    {job.url}
                  </Link></p>
                  <p className="text-[16px]"><strong className="font-[700] text-[16px]">Position: </strong>{job.position}</p>
                  <p className="text-[16px]"><strong className="font-[700] text-[16px]">Location: </strong>{job.location}</p>
                  <p className="text-[16px]"><strong className="font-[700] text-[16px]">Email: </strong><Link href={`mailto:${job.email}`} className="text-[#3498db] hover:underline cursor-pointer">{job.email}</Link></p>
                  <p className="text-[16px]"><strong className="font-[700] text-[16px]">Description: </strong></p>
                  <p className="text-[16px]">{job.description}</p>
                  <p className="text-[16px]"><strong className="font-[700] text-[16px]">How To Apply: </strong></p>
                  <p className="text-[16px]">{job.how_to_apply}</p>
                  <p className="text-[16px]"><strong className="font-[700] text-[16px]">Public: </strong>{job.is_public ? "Yes" : "No"}</p>

                </div>
            </CardContent>

        </Card>

        <div className="flex justify-end gap-4 mt-[12px]">

                    <Button
                        onClick={onSubmit}
                        className={styles.jobButton}
                    >
                        Create Job Post
                    </Button>
                  </div>

      </div>
      
    );
}