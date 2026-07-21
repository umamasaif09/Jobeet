import Container from "./Container";
import NavBar from "./Navbar";

export default function Header() {
    return (
        <header className="border-b bg-background">
            <Container>
                <NavBar />
            </Container>
        </header>
    );
}