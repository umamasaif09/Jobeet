import Link from "next/link";

import { CategoryWithJobs } from "@/types/category-with-jobs";
import JobTable from "../jobs/JobTable";
import { Separator } from "@/components/ui/separator";

interface CategorySectionProps{
    category: CategoryWithJobs;
}

export default function CategorySection({category,}: CategorySectionProps) {
    return (
        <section>
            <div>
                <h2>
                    <Link href={`/jobs/category?category=${category.id}`}>
                        {category.name}
                    </Link> 
                </h2>
            </div>

            <Separator />
                <JobTable jobs={category.jobs}/>
        </section>
    );
}
