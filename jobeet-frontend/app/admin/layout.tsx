// app/admin/layout.tsx

import Header from "@/components/admin/Header";

export default function AdminLayout({
    children,
}: {
    children: React.ReactNode;
}) {
    return (
        <>

          <Header />  
          <main className="flex-1">
            {children}
            </main>
        </>
    );
}