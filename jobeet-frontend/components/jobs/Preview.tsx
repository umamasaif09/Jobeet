import { JobFormData } from "@/types/job-form-data";
import { Category } from "@/types/category";
import { getCategories } from "@/services/categories";
import { Card, CardContent } from "../ui/card";
import { Button } from "../ui/button";
import BackButton from "../ui/BackButton";

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

      <div className="flex items-baseline gap-4">
        
          <BackButton/>
          <div className="flex-1">
            <div className="max-w-5xl space-y-6">

            
          <h1 className="font-heading text-xl font-semibold tracking-tight primary-text">
            Preview
          </h1>
        
        <Card>
            <CardContent>
                <div className="space-y-4">
                  <div>
                    <h3 className="font-semibold">Position</h3>
                    <p className="text-sm">{job.position}</p>
                  </div>
                   
                  <div>
                    <h3 className="font-semibold">Company</h3>
                    <p className="text-sm">{job.company}</p>
                  </div>

                  <div>
                    {job.logo && (
                      <>
                        <h3 className="font-semibold">Company Logo</h3>
                        <img src={job.logo instanceof File ? 
                          URL.createObjectURL(job.logo) :
                        `${process.env.NEXT_PUBLIC_UPLOAD_URL}/${job.logo}`}
                        alt="Logo"
                        />
                      </>
                    )}
                  </div>

                  <div>
                    <h3 className="font-semibold">Location</h3>
                    <p className="text-sm">{job.location}</p>
                  </div>

                  <div>
                    <h3 className="font-semibold">Email</h3>
                    <p className="text-sm">{job.email}</p>
                  </div>

                  <div>
                    <h3 className="font-semibold">Website</h3>
                    <p className="text-sm">{job.url}</p>
                  </div>

                  <div>
                    <h3 className="font-semibold">Category</h3>
                    <p className="text-sm">{category?.name}</p>
                  </div>

                  <div>
                    <h3 className="font-semibold">Job Type</h3>
                    <p className="text-sm">{job.type}</p>
                  </div>

                  <div>
                    <h3 className="font-semibold">Description</h3>
                    <p className="text-sm">{job.description}</p>
                  </div>

                  <div>
                    <h3 className="font-semibold">How to Apply</h3>
                    <p className="text-sm">{job.how_to_apply}</p>
                  </div>

                  <div>
                    <h3 className="font-semibold">Public</h3>
                    <p className="text-sm">{job.is_public ? "Yes" : "No"}</p>
                  </div>


                  <div className="flex justify-end gap-4">
                    <Button
                        variant="outline"
                        onClick={onEdit}
                    >
                        Edit
                    </Button>

                    <Button
                        onClick={onSubmit}
                    >
                        Post Job
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