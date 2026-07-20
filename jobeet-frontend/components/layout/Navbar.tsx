import Link from "next/link";
import Logo from "./Logo";

const navigation = [
    {
        label: "Home",
        href: "./",
    },
    {
        label: "Jobs",
        href: "/jobs",
    },
    {
        label: "Categories",
        href: "categories",
    },
    {
        label: "Login",
        href: "/login",
    },
];

export default function NavBar() {
    return(
        <nav className="flex items-center justify-between py-4">
            <Logo/>

            <div className="flex gap-6">
                {navigation.map((item)=> (
                    <Link
                        key={item.href}
                        href={item.href}
                        className="text-sm font-medium hover:text-blue-600 transition-colors"
                        >
                            {item.label}
                        </Link>
                ))}
            </div>
        </nav>
    );
}