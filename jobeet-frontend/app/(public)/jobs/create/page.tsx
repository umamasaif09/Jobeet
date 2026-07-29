import { getCategories } from "@/services/categories";
import JobEditor from "@/components/jobs/JobEditor";

export default async function CreateJobPage() {
    const categories = await getCategories();

    return (
        <JobEditor
            mode="create"
            userType="public"
            categories={categories}
            initialJob={{
              category_id: "",
              type: "Full-time",
              company: "",
              url: "",
              logo: null,
              position: "",
              location: "",
              email: "",
              description: "",
              how_to_apply: "",
              is_public: true,
            }}
        />
        
    );
}