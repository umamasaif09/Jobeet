import { Job, JobApi } from "@/types/job";
import { CategoryWithJobs, CategoryWithJobsApi } from "@/types/category-with-jobs";
import { CategoryJobsResponse, CategoryJobsResponseApi } from "@/types/category-jobs-response";
import { CategoryApi, Category } from "@/types/category";
import { JobFormData } from "@/types/job-form-data";
import { AffiliateApi } from "@/types/affiliate";
import { AffiliateFormData } from "@/types/affiliate-form-data";

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
        jobs: data.jobs.map(transformJob),
        totalItems: data.totalItems,
        totalPages: data.totalPages,
        page: data.page,
        perPage: data.perPage
    };
}

export function transformToJobForm(job: Job):JobFormData {
  return {
    category_id: job.category_id.toString(),
    type: job.type,
        company: job.company,
        url: job.url ?? "",
        logo: job.logo,
        position: job.position,
        location: job.location,
        email: job.email,
        description: job.description,
        how_to_apply: job.how_to_apply,
        is_public: job.is_public, 
  };
}

export function transformAffiliate(affiliate: AffiliateApi) : AffiliateFormData{
  return {
    affiliate_name: affiliate.name,
    affiliate_email: affiliate.email,
    affiliate_url: affiliate.site_url!,
    categories: affiliate.categories.map(String)
  };
}