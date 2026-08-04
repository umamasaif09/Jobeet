import Link from "next/link";
import paginationStyles from "./jobs.module.css";
import buttonStyles from "@/app/styles/jobeet.module.css";

type Props = {
  categoryId: number;
  page: number;
  totalPages: number;
}

export default function JobsPagination({categoryId, page, totalPages} : Props) {
  return(
    <div className={paginationStyles.pagination}>
          {page > 1 ? (
            <Link
            href={`/jobs/category?category=${categoryId}&page=${page - 1}`}
            className={buttonStyles.backButton}
          > ← Previous </Link> 
          ) : (
            <span/>
          )}
          
          <span className={paginationStyles.pageNumber}>
            Page {page} of {totalPages}
          </span>

          {page < totalPages ? (
            <Link
              href={`/jobs/category?category=${categoryId}&page=${page + 1}`}
              className={buttonStyles.backButton}
            > Next → </Link>
          ) : (
            <></>
          )}
    </div>
  );
}