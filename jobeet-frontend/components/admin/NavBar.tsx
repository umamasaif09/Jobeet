import Link from "next/link";
import Logo from "./Logo";
import LogoutButton from "../auth/LogoutButton";
import { usePathname } from "next/navigation";

const navigation = [
     {
        label: "Dashboard",
        href: "/admin",
    },
    {
        label: "Categories",
        href: "/admin/categories",
    },
    {
        label: "Jobs",
        href: "/admin/jobs",
    },
    {
        label: "Affiliates",
        href: "/admin/affiliates",
    },
    {
        label: "Admins",
        href: "/admin/admins",
    },
];

export default function NavBar() {
  const pathname= usePathname();
    return(
        <nav className="flex justify-between items-center border-b py-4">
            <Logo/>

            <div className="flex items-center gap-2 ">
                {navigation.map((item)=> (
                    <Link className={`text-sm font-medium px-2.5 py-1.5 transition-colors rounded-md ${
                      pathname === item.href ? "bg-accent text-accent-foreground" : "hover:bg-accent hover:text-accent-foreground"
                    }`}
                        key={item.href}
                        href={item.href}
                        
                        >
                            {item.label}
                        </Link>
                ))}
                <LogoutButton/>
            </div>
        </nav>
    );
}