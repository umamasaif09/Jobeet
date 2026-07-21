import Link from "next/link";

import { CategoryWithJobs } from "@/types/category-with-jobs";
import JobTable from "../jobs/JobTable";

import {Button} from "@/components/ui/button";
import { Separator } from "@/components/ui/separator";

interface CategorySectionProps{
    category: CategoryWithJobs;
}

export default function CategorySection({category,}: CategorySectionProps) {
    return (
        <section className="space-y-4">
            <div className="flex items-center justify-between">
                <h2 className="text-2xl font-bold">
                    <Link href={`/categories/${category.id}`}>
                        {category.name}
                    </Link> 
                </h2>
            </div>

            <Separator />
                <JobTable jobs={category.jobs}/>
        </section>
    );
}
