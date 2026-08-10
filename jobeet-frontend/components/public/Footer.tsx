import Container from "../ui/Container";
import Link from "next/link";
import styles from "./layout.module.css";

export default function Footer() {
  return (
    <footer>
      <Container>
        <div className={styles.footer}>
          <Link href="/about" className={styles.footerText}>
            About Jobeet
          </Link>

          <Link href="/rss" className={styles.footerText}>
            Full RSS Feed
          </Link>

          <Link className={styles.footerText} href="/api">
            Jobeet API
          </Link>

          <Link href="/affiliates" className={styles.footerText}>
            Affiliates
          </Link>
        </div>
      </Container>
    </footer>
  );
}
