import AdminTable from "@/components/admins/AdminTable";
import { getAdmins } from "@/services/admins";
import { cookies } from "next/headers";

export default async function AdminsPage() {
  const cookie = ((await cookies()).toString());
  const admins = await getAdmins(cookie);

  return (
      <AdminTable admins = {admins} />
    
  )
}