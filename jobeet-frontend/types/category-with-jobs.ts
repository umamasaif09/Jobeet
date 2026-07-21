import {Job, JobApi} from "./job";

export interface CategoryWithJobsApi{
    id: string;
    name: string;
    jobs: JobApi[];
}

export interface CategoryWithJobs {
    id: number;
    name: string;
    jobs: Job[];
}

