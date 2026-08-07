"use client";

import { usePathname, useRouter } from "next/navigation";
import { useEffect, useRef, useState } from "react";
import { Input } from "@/components/ui/input";
import { Button } from "@/components/ui/button";
import styles from "./layout.module.css"

export default function SearchBar() {
    const router = useRouter();
    const [keyword, setKeyword] = useState("");
    const inputRef = useRef<HTMLInputElement>(null);
    const pathName= usePathname();

    useEffect(()=> {
      if(pathName!== "/jobs/search") {
        setKeyword("");
      }
    }, [pathName]);

    function handleSubmit(e: React.FormEvent) {
        e.preventDefault();
        inputRef.current?.blur();
        router.push(
            `/jobs/search?keyword=${keyword}`
        );
    }
    return (
        
        <form onSubmit={handleSubmit} className={styles.searchForm}>
          
            <Input
                ref={inputRef}
                type="text"
                placeholder="Live Search"
                value={keyword}
                onChange={(e) => setKeyword(e.target.value)}
                className={styles.searchFormInput}
                required
              />
              <Button type="submit"
                className={styles.searchBtn}>
                  Search
              </Button>
         
            
        </form>
        
    );
}