import Container from "../ui/Container";
import Link from "next/link";

export default function Footer() {
    return (
        <footer className="border-t bg-background">
            <Container>
                <div className="flex items-center justify-between gap-4 py-6 text-sm mdLflex-row">
                    <p className="text-muted-foreground">
                        © {new Date().getFullYear()} Jobeet. All rights reserved.
                    </p>

                    <div className="flex flex-wrap items-center gap-6">
                        <Link href="/about"
                        className="text-muted-foreground hover:text-foreground transition-colors">
                            About Jobeet
                        </Link>

                        <Link
                            href="/rss"
                            className="text-muted-foreground hover:text-foreground transition-colors"
                        >
                            Full RSS Feed
                        </Link>

                        <Link
                            href="/api"
                            className="text-muted-foreground hover:text-foreground transition-colors"
                        >
                            Jobeet API
                        </Link>

                        <Link
                            href="/affiliates"
                            className="text-muted-foreground hover:text-foreground transition-colors"
                        >
                            Affiliates
                        </Link>
                    </div>
                </div>
            </Container>
        </footer>
    );
}