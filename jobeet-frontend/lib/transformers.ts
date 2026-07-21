import { Job, JobApi } from "@/types/job";
import { CategoryWithJobs, CategoryWithJobsApi } from "@/types/category-with-jobs";
import { CategoryJobsResponse, CategoryJobsResponseApi } from "@/types/category-jobs-response";
import { CategoryApi, Category } from "@/types/category";

export function transformJob(job: JobApi): Job {
    return {
        ...job,
        id: Number(job.id),
        category_id: Number(job.category_id),
        is_active: job.is_active === "1",
        is_public: job.is_public === "1",
    };
}

export function transformCategoryWithJobs(api: CategoryWithJobsApi): CategoryWithJobs {
    return {
        id: Number(api.id),
        name: api.name,
        jobs: api.jobs.map(transformJob),
    };
}

export function transformCategory(api: CategoryApi): Category {
    return {
        id: Number(api.id),
        name: api.name
    };
}

export function transformCategoryJobsResponse(data: CategoryJobsResponseApi): CategoryJobsResponse {
    return {
        category: transformCategory(data.category),
        jobs: data.jobs.map(transformJob)
    };
}