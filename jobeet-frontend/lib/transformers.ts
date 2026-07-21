import { Job, JobApi } from "@/types/job";
import { CategoryWithJobs, CategoryWithJobsApi } from "@/types/category-with-jobs";

export function transformJob(job: JobApi): Job {
    return {
        ...job,
        id: Number(job.id),
        category_id: Number(job.category_id),
        is_active: job.is_active === "1",
        is_public: job.is_public === "1",
    };
}

export function transformCategoryWithJobs(category: CategoryWithJobsApi): CategoryWithJobs {
    return {
        ...category,
        id: Number(category.id),
        name: category.name,
        jobs: category.jobs.map(transformJob),
    };
}