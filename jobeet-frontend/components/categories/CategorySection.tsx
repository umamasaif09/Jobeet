import Link from "next/link";

import { CategoryWithJobs } from "@/types/category-with-jobs";
import JobTable from "../jobs/JobTable";

interface CategorySectionProps{
    category: CategoryWithJobs;
}

export default function CategorySection({category,}: CategorySectionProps) {
    return (
            <div>
                <h2 className="font-heading text-xl font-semibold tracking-tight primary-text">
                    <Link href={`/jobs/category?category=${category.id}`}>
                        {category.name}
                    </Link> 
                </h2>
                <JobTable jobs={category.jobs}/>
            </div>
    );
}
