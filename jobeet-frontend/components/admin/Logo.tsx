import Link from "next/link";
import styles from "./layout.module.css";

export default function logo() {
    return (
        <Link href= "/" className={styles.logoText}>
            Jobeet
        </Link>
    );
}