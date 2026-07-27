import Link from "next/link";
import Logo from "./Logo";
import SearchBar from "./SearchBar";
import { Button } from "@/components/ui/button";

export default function NavBar() {
    return(
        <nav>
            <Logo/>
            <SearchBar/>


            <Link href="/jobs/create">
                <Button>Post a Job</Button>
            </Link>
        </nav>
    );
}