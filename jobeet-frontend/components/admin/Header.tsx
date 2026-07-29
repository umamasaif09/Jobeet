
import { Separator } from "../ui/separator";
import NavBar from "./NavBar";
import Container from "@/components/ui/Container"

export default function Header() {
    return (
        <header>
            <Container>
                <NavBar />
                <Separator/>
            </Container>
        </header>
    );
}