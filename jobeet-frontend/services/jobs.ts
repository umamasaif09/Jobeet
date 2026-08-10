import api from "@/lib/api";
import { Job, JobApi } from "@/types/job";
import {
  CategoryWithJobs,
  CategoryWithJobsApi,
} from "@/types/category-with-jobs";
import {
  transformCategoryJobsResponse,
  transformCategoryWithJobs,
  transformJob,
  transformJobWithCategory,
} from "@/lib/transformers";
import {
  CategoryJobsResponse,
  CategoryJobsResponseApi,
} from "@/types/category-jobs-response";
import { CreateJobRequest } from "@/types/create-job-request";
import { SearchResults } from "@/types/search-results";

export async function getJobs(): Promise<Job[]> {
  const response = await api.get<JobApi[]>("/jobs");

  return response.data.map(transformJob);
}

export async function getLatestJobs(): Promise<CategoryWithJobs[]> {
  const response = await api.get<CategoryWithJobsApi[]>("/jobs/latest");

  return response.data.map(transformCategoryWithJobs);
}

export async function getJob(id: number): Promise<Job> {
  const response = await api.get<JobApi>(`/jobs/detail/${id}`);
  return transformJob(response.data);
}

export async function getJobsByCategory(
  categoryId: number,
  page: number = 1,
): Promise<CategoryJobsResponse> {
  const response = await api.get<CategoryJobsResponseApi>(
    `jobs/category?category=${categoryId}&page=${page}`,
  );

  return transformCategoryJobsResponse(response.data);
}

export async function getJobsByKeyword(keyword: string) {
  const response = await api.get<SearchResults[]>("/jobs/search", {
    params: {
      keyword,
    },
  });

  return response.data.map((job) => transformJobWithCategory(job));
}

export async function createJob(job: CreateJobRequest) {
  const response = await api.post("/jobs/create", job);

  return response.data;
}

export async function updateJob(
  id: number,
  token: string,
  job: CreateJobRequest,
) {
  const response = await api.put(`/jobs/update/${id}/${token}`, job);
  return response.data;
}

export async function adminUpdateJob(id: number, job: CreateJobRequest) {
  const response = await api.put(`/jobs/adminUpdate/${id}`, job);
  return response.data;
}

export async function deleteJob(id: number) {
  const response = await api.delete(`/jobs/delete/${id}`);
  return response.data;
}
