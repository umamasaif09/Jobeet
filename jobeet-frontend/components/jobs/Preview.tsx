import { JobFormData } from "@/types/job-form-data";
import { Category } from "@/types/category";
import { getCategories } from "@/services/categories";
import { Card, CardContent } from "../ui/card";
import { Button } from "../ui/button";

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
        <Card className="max-w-4xl mx-auto">
            <CardContent className="space-y-6 p-8">
                <div>
                    <h2 className="text-2xl font-bold">
                        {job.position}
                    </h2>

                    <p className="text-muted-foreground">
                        {job.company}
                    </p>    
                    <p><strong>Category</strong> {category?.name}</p>
                    <p><strong>Type</strong>{job.type}</p>
                    <p><strong>Location</strong>{job.location}</p>
                    <p><strong>Website</strong>{job.url}</p>
                    <p><strong>Email</strong>{job.email}</p>

                </div>

                <div>
                    <h3 className="font-semibold mb-2">
                        Description
                    </h3>

                    <p className="whitespace-pre-wrap">
                        {job.description}
                    </p>
                </div>

                <div>
                    <h3 className="font-semibold mb-2">
                        How to Apply?
                    </h3>

                    <p className="whitespace-pre-wrap">
                        {job.how_to_apply}
                    </p>
                </div>

                <div>
                  {job.logo && (
                    job.logo instanceof File ? (
                        <img src={URL.createObjectURL(job.logo)}
                        alt="Logo"
                        className="h-24 rounded"/>
                    ) : (
                        <img src={`${process.env.NEXT_PUBLIC_UPLOAD_URL}/${job.logo}`}
                        alt="Logo"
                        className="h-24 rounded"
                      />
                    )
                  )}
                </div>
                <p>

                    <strong>Public:</strong>

                    {job.is_public ? "Yes" : "No"}

                </p>

                <div className="flex justify-end gap-3">
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
            </CardContent>

        </Card>
    );
}