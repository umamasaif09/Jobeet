import { Separator } from "../ui/separator";
import NavBar from "./NavBar";
import Container from "@/components/ui/Container";
import styles from "./layout.module.css";

export default function Header() {
  return (
    <header>
      <Container>
        <div className={styles.adminHeader}>
          <NavBar />
          <Separator />
        </div>
      </Container>
    </header>
  );
}
