
import { Job } from "@/types/job";
import Image from "next/image";
import BackButton from "../ui/BackButton";
import pageStyles from "@/app/styles/jobeet.module.css";
import styles from "./jobs.module.css";

interface JobCardProps{
    job: Job;
}

export default function JobCard({job}: JobCardProps) {
    return (
      <div className="space-y-6">
        <div className="flex gap-4 items-center my-[24px]">
          <BackButton/>
          <h1 className={pageStyles.pageTitle}>
            Job Detail
          </h1>
        </div>
        <div>
          <div className={styles.jobDetails}>
            <div>
              <h2 className={styles.jobDetailsH2}>{job.position}</h2>
              <h3 className={styles.jobDetailsH3}>{job.company}</h3>
              <h4 className={styles.jobDetailsH4}>{job.location}</h4>
            </div>

              {job.logo && (
                <Image src={`${process.env.NEXT_PUBLIC_UPLOAD_URL}/${job.logo}`}
                  alt = "Company Logo"
                  width={80}
                  height={80}
                  unoptimized
                  className={styles.logo}
                />
              )}
          </div>

              <hr className={styles.hr}/>

            <div>
              <strong>Descrption</strong>
              <p className={styles.jobDetailsP}>{job.description}</p>
            </div>
            <div>
              <strong>How to Apply</strong>
              <p className={styles.jobDetailsP}>{job.how_to_apply}</p>
            </div>

        </div>
              
            </div>
        
    )
}