import Container from "../ui/Container";
import Link from "next/link";

export default function Footer() {
    return (
        <footer>
            <Container>

                    <div className="flex justify-center items-center gap-2 border-t py-4">
                        <Link href="/about"
                              className="text-sm font-medium px-2.5 py-1.5"
                        >
                            About Jobeet
                        </Link>

                        <Link
                            href="/rss"
                            className="text-sm font-medium px-2.5 py-1.5"
                        >
                            Full RSS Feed
                        </Link>

                        <Link
                          className="text-sm font-medium px-2.5 py-1.5"
                          href="/api"
                            
                        >
                            Jobeet API
                        </Link>

                        <Link
                            href="/affiliates"
                            className="text-sm font-medium px-2.5 py-1.5"
                            
                        >
                            Affiliates
                        </Link>
                    </div>

            </Container>
        </footer>
    );
}