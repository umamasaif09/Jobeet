import { Category, CategoryApi } from "./category";
import { Job, JobApi } from "./job";

export interface CategoryJobsResponseApi {
    category: CategoryApi;
    jobs: JobApi[];
      page: number;
      totalPages: number;
      totalJobs: number;
      perPage: number;
}

export interface CategoryJobsResponse {
    category: Category;
    jobs: Job[];
      page: number;
      totalPages: number;
      totalJobs: number;
      perPage: number;
}