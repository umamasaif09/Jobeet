"use client";

import { useRouter } from "next/navigation";
import { Button } from "./button";
import styles from "@/app/styles/jobeet.module.css";

export default function BackButton() {
  const router = useRouter();

  return (
    <Button className={styles.backButton} onClick={() => router.back()}>
      ← Back
    </Button>
  );
}
