import Link from "next/link";
import Logo from "./Logo";
import SearchBar from "./SearchBar";
import { Button } from "@/components/ui/button";

export default function NavBar() {
    return(
        <nav className="flex justify-between items-center border-b py-4">
            <Logo/>

            <div className="flex items-center gap-2 ">
              <SearchBar/>

              <Link href="/jobs/create">
                  <Button>Post a Job</Button>
              </Link>
            </div>
           
        </nav>
    );
}