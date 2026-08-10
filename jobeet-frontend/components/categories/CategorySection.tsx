import Link from "next/link";

import { CategoryWithJobs } from "@/types/category-with-jobs";
import JobTable from "../jobs/JobTable";
import styles from "./categories.module.css";

interface CategorySectionProps {
  category: CategoryWithJobs;
}

export default function CategorySection({ category }: CategorySectionProps) {
  return (
    <div>
      <h2 className={styles.categoryHeading}>
        <Link href={`/jobs/category?category=${category.id}`}>
          {category.name}
        </Link>
      </h2>
      <JobTable jobs={category.jobs} />
    </div>
  );
}
