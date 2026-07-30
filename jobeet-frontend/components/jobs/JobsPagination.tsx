import { Pagination, PaginationContent, PaginationItem, PaginationNext, PaginationPrevious } from "../ui/pagination";


type Props = {
  categoryId: number;
  page: number;
  totalPages: number;
}

export default function JobsPagination({categoryId, page, totalPages} : Props) {
  return(
    <Pagination>
      <PaginationContent>
        <PaginationItem>
          {page > 1 ? (
            <PaginationPrevious
            href={`/jobs/category?category=${categoryId}&page=${page - 1}`}
            aria-disabled= {page===1}
          />
          ) : (
            <PaginationPrevious
              className="pointer-events-none opacity-50"
          />
          )}
          
        </PaginationItem>

        <PaginationItem>
          <span>
            Page {page} of {totalPages}
          </span>
        </PaginationItem>

        <PaginationItem>
          {page < totalPages ? (
            <PaginationNext
              href={`/jobs/category?category=${categoryId}&page=${page + 1}`}
              aria-disabled= {page === totalPages}
            />
          ) : (
            <PaginationNext
              className="pointer-events-none opacity-50"
            />
          )}
          
        </PaginationItem>
      </PaginationContent>
    </Pagination>
  );
}