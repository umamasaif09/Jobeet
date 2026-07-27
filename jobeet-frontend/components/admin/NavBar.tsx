import Link from "next/link";
import Logo from "./Logo";

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
    return(
        <nav>
            <Logo/>

            <div>
                {navigation.map((item)=> (
                    <Link
                        key={item.href}
                        href={item.href}
                        
                        >
                            {item.label}
                        </Link>
                ))}
            </div>
        </nav>
    );
}