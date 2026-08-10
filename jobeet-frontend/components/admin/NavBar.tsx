import Link from "next/link";
import Logo from "./Logo";
import LogoutButton from "../auth/LogoutButton";
import { usePathname } from "next/navigation";
import styles from "./layout.module.css";

const navigation = [
  {
    label: "Dashboard",
    href: "/admin",
  },
  {
    label: "Manage Categories",
    href: "/admin/categories",
  },
  {
    label: "Manage Jobs",
    href: "/admin/jobs",
  },
  {
    label: "Manage Affiliates",
    href: "/admin/affiliates",
  },
  {
    label: "Manage Admins",
    href: "/admin/admins",
  },
];

export default function NavBar() {
  const pathname = usePathname();
  return (
    <nav className={styles.adminNav}>
      <Logo />

      <div className={styles.adminNav}>
        {navigation.map((item) => (
          <Link
            className={`${styles.navItem} ${
              pathname === item.href ? styles.navActiveItem : ""
            }`}
            key={item.href}
            href={item.href}
          >
            {item.label}
          </Link>
        ))}
        <LogoutButton />
      </div>
    </nav>
  );
}
