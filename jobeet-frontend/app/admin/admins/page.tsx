import AdminTable from "@/components/admins/AdminTable";
import Container from "@/components/ui/Container";
import { getAdmins } from "@/services/admins";
import { cookies } from "next/headers";

export default async function AdminsPage() {
  const cookie = ((await cookies()).toString());
  const admins = await getAdmins(cookie);

  return (
    <Container>
      <AdminTable admins = {admins} />
    </Container>
    
  )
}