import Header from "@/components/public/Header";
import Footer from "@/components/public/Footer";
import { Toaster } from "sonner";
import Container from "@/components/ui/Container";

export default function PublicLayout({
  children,
}: {
  children: React.ReactNode;
}) {
  return(
     <div className="min-h-screen flex flex-col">
        <Header />
        <Toaster />
            <main className="flex-1 text-[#333]">
              <Container>
                {children}
              </Container>
            </main>

        <Footer/>
    </div>
  );
}