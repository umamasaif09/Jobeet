import { Category, CategoryApi } from "./category";
import { Job, JobApi } from "./job";

export interface CategoryJobsResponseApi {
    category: CategoryApi;
    jobs: JobApi[];
}

export interface CategoryJobsResponse {
    category: Category;
    jobs: Job[];
}