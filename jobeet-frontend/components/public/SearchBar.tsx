"use client";

import { useRouter } from "next/navigation";
import { useState } from "react";
import { Search } from "lucide-react";
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
            <Input
                type="text"
                placeholder="Search jobs..."
                className="p1-10"
                value={keyword}
                onChange={(e) => setKeyword(e.target.value)}
            />
            <Button type="submit">
                Search
            </Button>
        </form>
        
    );
}