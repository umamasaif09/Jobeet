import { deleteAdmin } from "@/services/admins";
import { Admin } from "@/types/admin";
import { AlertDialog, AlertDialogAction, AlertDialogCancel, AlertDialogContent, AlertDialogDescription, AlertDialogFooter, AlertDialogHeader, AlertDialogTitle } from "../ui/alert-dialog";


type Props = {
  open: boolean;
  onOpenChange: (open: boolean)=> void;
  onSuccess: () => void;
  admin: Admin | null;
}

export default function DeleteAdminDialog({open, onOpenChange, onSuccess, admin}: Props) {
  async function handleDelete() {
    if(!admin) return;

    await deleteAdmin(admin.id.toString());
    onSuccess();
    onOpenChange(false);
  }

  return(
    <AlertDialog open={open} onOpenChange={onOpenChange}>
      <AlertDialogContent>
        <AlertDialogHeader>
          <AlertDialogTitle>
            Delete Admin
          </AlertDialogTitle>

          <AlertDialogDescription>
            Are you sure you want to delete{" "}
            <strong>{admin?.name}</strong>?
            <br />
          </AlertDialogDescription>
        </AlertDialogHeader>

        <AlertDialogFooter>
          <AlertDialogCancel>
            Cancel
          </AlertDialogCancel>

          <AlertDialogAction onClick={handleDelete}>
            Delete
          </AlertDialogAction>
        </AlertDialogFooter>
      </AlertDialogContent>
    </AlertDialog>
  )
}