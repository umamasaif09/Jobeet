import Link from "next/link";
import Logo from "./Logo";
import SearchBar from "./SearchBar";
import { Button } from "@/components/ui/button";
import styles from "./layout.module.css"

export default function NavBar() {
    return(
        <nav className="flex justify-between items-center border-b py-[12px] px-[6px]">
            <Logo/>

            <div className="flex items-center gap-[12px] flex-1 justify-end ">
              <SearchBar/>

              <Link href="/jobs/create">
                  <Button className={styles.postJobBtn}>Post a Job</Button>
              </Link>
            </div>
           
        </nav>
    );
}