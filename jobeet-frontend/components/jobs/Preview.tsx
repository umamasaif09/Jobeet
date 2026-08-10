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

export default function Preview({ job, categories, onEdit, onSubmit }: Props) {
  const category = categories.find((c) => c.id === Number(job.category_id));

  return (
    <div className="flex flex-col">
      <div className="flex items-baseline gap-4 my-[24px] ">
        <BackButton />
        <h1 className={pageStyles.pageTitle}>Preview Job</h1>
      </div>
      <Card className="bg-white rounded-[10px] border-[#ececec] shadow-[0_2px_8px_rgba(0,0,0,0.08)]">
        <CardContent className="py-[9px] px-[24px]">
          <table className={styles.previewTable}>
            <tbody>
              <tr>
                <td>
                  <strong>Category</strong>
                </td>
                <td>{category?.name}</td>
              </tr>
              <tr>
                <td>
                  <strong>Type</strong>
                </td>
                <td>{job.type}</td>
              </tr>
              <tr>
                <td>
                  <strong>Company</strong>
                </td>
                <td>{job.company}</td>
              </tr>
              {job.logo && (
                <tr>
                  <td>
                    <strong>Logo</strong>
                  </td>
                  <td>
                    <Image
                      src={
                        job.logo instanceof File
                          ? URL.createObjectURL(job.logo)
                          : `${process.env.NEXT_PUBLIC_UPLOAD_URL}/${job.logo}`
                      }
                      alt="Logo"
                      width={80}
                      height={80}
                      unoptimized
                      className={styles.logo}
                    />
                  </td>
                </tr>
              )}
              <tr>
                <td>
                  <strong>Webiste</strong>
                </td>
                <td>
                  <Link
                    className="text-[#3498db] hover:underline cursor-pointer"
                    href={job.url}
                  >
                    {job.url}
                  </Link>
                </td>
              </tr>
              <tr>
                <td>
                  <strong>Position</strong>
                </td>
                <td>{job.position}</td>
              </tr>
              <tr>
                <td>
                  <strong>Location</strong>
                </td>
                <td>{job.location}</td>
              </tr>
              <tr>
                <td>
                  <strong>Email</strong>
                </td>
                <td>
                  <Link
                    href={`mailto:${job.email}`}
                    className="text-[#3498db] hover:underline cursor-pointer"
                  >
                    {job.email}
                  </Link>
                </td>
              </tr>
              <tr>
                <td>
                  <strong>Description</strong>
                </td>
                <td>{job.description}</td>
              </tr>
              <tr>
                <td>
                  <strong>How to Apply</strong>
                </td>
                <td>{job.how_to_apply}</td>
              </tr>
              <tr>
                <td>
                  <strong>Public</strong>
                </td>
                <td>{job.is_public ? "Yes" : "No"}</td>
              </tr>
            </tbody>
          </table>
        </CardContent>
      </Card>

      <div className="flex justify-end gap-4 mt-[12px]">
        <Button onClick={onSubmit} className={styles.jobButton}>
          Create Job Post
        </Button>
      </div>
    </div>
  );
}
