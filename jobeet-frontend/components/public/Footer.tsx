import Container from "./Container";

export default function Footer() {
    return (
        <footer className="border-t bg-background">
            <Container>
                <div className="flex items-center justify-between py-6">
                    <p className="text-sm text-muted-foreground">
                        © {new Date().getFullYear()} Jobeet. All rights reserved.
                    </p>
                </div>
            </Container>
        </footer>
    );
}