import api from "@/lib/api";
import { Job, JobApi } from "@/types/job";
import { CategoryWithJobs, CategoryWithJobsApi } from "@/types/category-with-jobs";
import { transformJob } from "@/lib/transformers";
import { transformCategoryWithJobs } from "@/lib/transformers";


export async function getJobs(): Promise<Job[]> {
    const response = await api.get<JobApi[]>("/jobs");

    return response.data.map(transformJob);
}

export async function getLatestJobs(): Promise<CategoryWithJobs[]> {
    const response = await api.get<CategoryWithJobsApi[]>("/jobs/latest");

    return Object.values(response.data).map(transformCategoryWithJobs);
}

export async function getJob(id: number): Promise<Job> {
    const response = await api.get<JobApi>(`/jobs/detail/${id}`);
    return transformJob(response.data);
}