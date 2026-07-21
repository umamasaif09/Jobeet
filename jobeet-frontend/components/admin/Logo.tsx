import Link from "next/link";

export default function logo() {
    return (
        <Link href= "/"
        className="text-2xl font-bold text-blue-600">
            Jobeet
        </Link>
    );
}