import api from "@/lib/api";
import { Job, JobApi } from "@/types/job";
import { CategoryWithJobs, CategoryWithJobsApi } from "@/types/category-with-jobs";
import { transformCategoryJobsResponse, transformJob } from "@/lib/transformers";
import { transformCategoryWithJobs } from "@/lib/transformers";
import { Category } from "@/types/category";
import { CategoryJobsResponse, CategoryJobsResponseApi } from "@/types/category-jobs-response";
import { JobFormData } from "@/types/job-form-data";
import { CreateJobRequest } from "@/types/create-job-request";


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

export async function getJobsByKeyword(keyword: string) {
    const response = await api.get<JobApi[]>(
        "/jobs/search",
        {
            params: {
                keyword,
            },
        }
    );

    return response.data.map(job => transformJob(job));
}

export async function createJob(job: CreateJobRequest) {
    const response = await api.post("/jobs/create", job);

    return response.data;
}