import Container from "../ui/Container";
import Link from "next/link";

export default function Footer() {
    return (
        <footer>
            <Container>
                <div>
                    <p>
                        © {new Date().getFullYear()} Jobeet. All rights reserved.
                    </p>

                    <div>
                        <Link href="/about"
                        >
                            About Jobeet
                        </Link>

                        <Link
                            href="/rss"
                            
                        >
                            Full RSS Feed
                        </Link>

                        <Link
                            href="/api"
                            
                        >
                            Jobeet API
                        </Link>

                        <Link
                            href="/affiliates"
                            
                        >
                            Affiliates
                        </Link>
                    </div>
                </div>
            </Container>
        </footer>
    );
}