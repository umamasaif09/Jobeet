import LogoutButton from "../auth/LogoutButton";
import NavBar from "./NavBar";
import Container from "@/components/ui/Container"

export default function Header() {
    return (
        <header>
            <Container>
                <NavBar />
                <LogoutButton/>
            </Container>
        </header>
    );
}