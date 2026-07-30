"use client";

import { useRouter } from "next/navigation";
import { useState } from "react";
import { Input } from "@/components/ui/input";
import { Button } from "@/components/ui/button";

export default function SearchBar() {
    const router = useRouter();
    const [keyword, setKeyword] = useState("");

    function handleSubmit(e: React.FormEvent) {
        e.preventDefault();

        router.push(
            `/jobs/search?keyword=${keyword}`
        );
    }
    return (
        
        <form onSubmit={handleSubmit}>
          <div className="flex items-center">
            <Input
                type="text"
                placeholder="Search jobs..."
                value={keyword}
                onChange={(e) => setKeyword(e.target.value)}
                className="rounded-r-none"
              />
              <Button type="submit"
                className="rounded-l-none">
                  Search
              </Button>
          </div>
            
        </form>
        
    );
}