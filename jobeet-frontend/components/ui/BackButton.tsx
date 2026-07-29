"use client";

import { useRouter } from "next/navigation";
import { Button } from "./button";
import { ArrowLeft, Ghost } from "lucide-react";


export default function BackButton() {
  const router = useRouter();

  return(
    <Button
      variant="ghost"
      className="bg-accent"
      onClick={()=> router.back()}
    >
      <ArrowLeft />
      Back
    </Button>
  );
}