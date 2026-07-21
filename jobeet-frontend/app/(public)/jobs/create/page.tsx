import { getCategories } from "@/services/categories";
import JobCreate from "@/components/jobs/JobCreate";

export default async function CreateJobPage() {
    const categories = await getCategories();

    return (
        <JobCreate
            categories={categories}
        />
    );
}