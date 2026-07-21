import api from "@/lib/api";
import { Job, JobApi } from "@/types/job";
import { CategoryWithJobs, CategoryWithJobsApi } from "@/types/category-with-jobs";
import { transformCategoryJobsResponse, transformJob } from "@/lib/transformers";
import { transformCategoryWithJobs } from "@/lib/transformers";
import { Category } from "@/types/category";
import { CategoryJobsResponse, CategoryJobsResponseApi } from "@/types/category-jobs-response";


export async function getJobs(): Promise<Job[]> {
    const response = await api.get<JobApi[]>("/jobs");

    return response.data.map(transformJob);
}

export async function getLatestJobs(): Promise<CategoryWithJobs[]> {
    const response = await api.get<CategoryWithJobsApi[]>("/jobs/latest");
    
    return Object.entries(response.data).map(([id, category]) => ({
        id: Number(id),
        name: category.name,
        jobs: category.jobs.map(transformJob)
    }));
}

export async function getJob(id: number): Promise<Job> {
    const response = await api.get<JobApi>(`/jobs/detail/${id}`);
    return transformJob(response.data);
}

export async function getJobsByCategory(categoryId: number, page:number=1): Promise<CategoryJobsResponse> {
    const response = await api.get<CategoryJobsResponseApi>(`jobs/category?category=${categoryId}&page=${page}`);
    
    return transformCategoryJobsResponse(response.data);
}